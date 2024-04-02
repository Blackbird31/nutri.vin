<?php

class MapperTable extends DB\SQL\Mapper {

	function __construct() {
		$table_name = strtolower(get_called_class());
        parent::__construct(DBManager::getDB(), $table_name);
	}

	function values() {
		$v = [];
		foreach($this->fields() as $f) {
			$v[] = $this->get($f);
		}
		return $v;
	}

	function set($key, $v) {
		$methodkey = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
		if (method_exists($this, $methodkey)) {
			$v = $this->$methodkey($v);
		}
		return parent::set($key, $v);
	}

	static function findById($id) {
		$class = get_called_class();
		$e = new $class();
		$e->load(array('id=?',$id));
		return $e;
	}

	function copyFrom($arg, $func = null) {
		if ($this->authorization_key && $arg == 'POST' && (!isset($_POST['authorization_key'])  || ($_POST['authorization_key'] != $this->authorization_key)) ) {
			throw new Exception('Not authorized to edit this object');
		}
		return parent::copyFrom($arg, get_called_class().'::filterCopyFrom');
	}

	static $copy_field_filter = null;

	static function filterCopyFrom($fields) {
		return array_intersect_key(
			$fields,
			self::$copy_field_filter
		);
	}

	static function getFieldsAndType() {
		return array();
	}

	static function createTable() {
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
			$t = $this->getFieldsAndType();
			return count($t) && $this->exists(array_keys($t)[0]);
		}catch(Exception $e) {
			return false;
		}
	}

}
