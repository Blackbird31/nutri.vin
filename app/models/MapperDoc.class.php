<?php

abstract class MapperDoc extends DB\Couch\Mapper {

	public static function getFieldsAndType() { return []; }

	function __construct() {
        parent::__construct(DBManager::getDB());
	}

	public function getId() {
		return $this->get('_id');
	}

	public function setId($id) {
		$prefix = strtoupper($this->get('type'));
		$this->set('_id', "$prefix-$id");
	}
}
