<?php

require_once('DBManager.class.php');

abstract class Mapper
{
    private $mapper;

    public function __construct()
    {
        $this->mapper = new \DB\SQL\Mapper(DBManager::getDB(), strtolower(get_called_class()));
    }

	public function getId() {
		return $this->mapper->get('id');
	}

	public function setId($id) {
		$this->mapper->set('id', $id);
	}

	public function toArray() {
		$v = [];
		foreach($this->mapper->fields() as $f) {
			$v[$f] = $this->mapper->get($f);
		}
		return $v;
	}

	public static function findById($id) {
		$class = get_called_class();
        $e = new $class();
		$e->mapper->load(array('id=?',$id));
		if (!$e->id) {
			return null;
		}
		return $e;
	}

	public static function findByUserid($userid) {
		$class = get_called_class();
        $e = new $class();
		return $e->mapper->find(array('user_id=?',$userid));
	}

	public function copyFrom($arg, $func = null) {
		if ($this->authorization_key && $arg == 'POST' && (!isset($_POST['authorization_key'])  || ($_POST['authorization_key'] != $this->authorization_key)) ) {
			throw new Exception('Not authorized to edit this object');
		}
		return $this->mapper->copyFrom($arg, get_called_class().'::filterCopyFrom');
	}

	public static function filterCopyFrom($fields) {
		return array_intersect_key(
			$fields,
			get_called_class()::$copy_field_filter
		);
	}

	public static function createTable() {
		$create_fields_sql = '';
		foreach(get_called_class()::getFieldsAndType() as $field => $type) {
			$create_fields_sql .= ($create_fields_sql) ? ",\n" : '';
			$create_fields_sql .= "$field $type";
		}
		$sql = "CREATE TABLE ".strtolower(get_called_class())." (".$create_fields_sql.");";
		return DBManager::getDB()->exec($sql);
	}

	public function tableExists() {
		try {
			$t = get_called_class()::getFieldsAndType();
			return count($t) && $this->mapper->exists(array_keys($t)[0]);
		}catch(Exception $e) {
			return false;
		}
	}

    public function __isset($key)
    {
        return !empty($this->mapper->$key);
    }

    public function __set($key, $value)
    {
        $this->mapper->$key = $value;
    }

    public function __get($key)
    {
        if ($key === "mapper") {
            return $this->mapper;
        }
        return $this->mapper->$key;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->mapper, $name)) {
            return $this->mapper->$name(implode(',', $arguments));
        }
    }

    public function __debug() {
        return $this->toArray();
    }

}
