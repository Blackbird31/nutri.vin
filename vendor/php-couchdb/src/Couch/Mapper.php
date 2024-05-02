<?php

namespace DB\Couch;

class Mapper extends \DB\Cursor {

	protected $db;
	protected $fields;
	protected $document = [];

	function __construct(\DB\Couch $db) {
		$this->db = $db;
	}

	function dbtype() {
		return 'Couch';
	}

	function exists($key) {
		return array_key_exists($key, $this->document);
	}

	function set($key, $val) {
		return $this->document[$key] = $val;
	}

	function &get($key) {
		if ($this->exists($key)) {
			return $this->document[$key];
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
		//a implementer
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
		$this->db->saveDoc($this->document);
		$pkey = ['_id' => $result->getinsertedid()];
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

}
