<?php

namespace DB\Couch;

class Mapper extends \DB\Cursor {

	protected $db;
	protected $fields;
	protected $document = [];
	protected $props = [];

	function __construct(\DB\Couch $db, $class) {
		$this->db = $db;
        $this->document = [self::getPrimaryKey() => 'VARCHAR(255) PRIMARY KEY'] + $class::$getFieldsAndType;
        array_walk($this->document, function (&$v) { $v = null; });
	}

    public static function getPrimaryKey()
    {
        return '_id';
    }

	function dbtype() {
		return 'Couch';
	}

	function exists($key) {
		return array_key_exists($key, $this->document);
	}

	function set($key, $val) {
		$this->props[$key] = $val;
		return $this->document[$key] = $val;
	}

	function &get($key) {
		if ($this->exists($key)) {
			return $this->document[$key];
		} elseif (array_key_exists($key, $this->props)) {
			return $this->props[$key];
		}
		user_error(sprintf(self::E_Field, $key), E_USER_ERROR);
	}

	function clear($key) {
		unset($this->document[$key]);
	}

	function fields() {
		return array_keys($this->document);
	}

	function cast($obj = null) {
		if (!$obj) {
			$obj = $this;
		}
		return $obj->document;
	}

	function find($filter = null, array $options = null, $ttl = 0) {
		return $this->select($this->fields, $filter, $options, $ttl);
	}

	function select($fields=NULL,$filter=NULL,array $options=NULL,$ttl=0) {
		if($filter && isset($filter[0]) && isset($filter[1]) && strpos($filter[0], '_id') === 0) {
			return [$this->db->getDoc($filter[1])];
		}
		if($filter && isset($filter['_id'])) {
			return [$this->db->getDoc($filter['_id'])];
		}
		trigger_error('select function can only query on _id field', E_USER_ERROR);
	}

	function count($filter = null, array $options = null, $ttl = 0) {
		//a implementer
	}

	function insert() {
		if (isset($this->document['_rev'])) {
			return $this->update();
		}
		if (isset($this->trigger['beforeinsert']) && \Base::instance()->call($this->trigger['beforeinsert'], [$this, ['_id' => $this->document['_id']]]) === false) {
			return $this->document;
		}
		$result = $this->db->saveDoc($this->document);
		$pkey = ['_id' => $result->id];
		if (isset($this->trigger['afterinsert'])) {
			\Base::instance()->call($this->trigger['afterinsert'], [$this, $pkey]);
		}
		$this->load($pkey);
		return $this->document;
	}

	function update() {
		$pkey=['_id' => $this->document['_id']];
		if (isset($this->trigger['beforeupdate']) && \Base::instance()->call($this->trigger['beforeupdate'], [$this, $pkey]) === false) {
			return $this->document;
		}
		$this->db->saveDoc($this->document);
		if (isset($this->trigger['afterupdate'])) {
			\Base::instance()->call($this->trigger['afterupdate'], [$this, $pkey]);
		}
		return $this->document;
	}

	function copyfrom($var, $func = null) {
		if (is_string($var)) {
			$var = \Base::instance()->$var;
		}
		if ($func) {
			$var = call_user_func($func, $var);
		}
		foreach ($var as $key => $val) {
			$this->set($key,$val);
		}
	}

	function copyto($key) {
		$var= &\Base::instance()->ref($key);
		foreach ($this->document as $key => $field) {
			$var[$key] = $field;
		}
	}

	function getiterator() {
		return new \ArrayIterator($this->cast());
	}

	function __call($func,$args) {
		$callable = (array_key_exists($func,$this->props) ? $this->props[$func] : $this->$func);
		return $callable ? call_user_func_array($callable,$args) : null;
	}

}
