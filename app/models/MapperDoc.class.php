<?php

abstract class MapperDoc extends DB\Couch\Mapper {

	public static function getFieldsAndType() { return []; }

	function __construct() {
  	parent::__construct(DBManager::getDB());
		$this->initializeDoc();
	}

	public function getId() {
		return $this->get('_id');
	}

	public function setId($id) {
		$prefix = strtoupper($this->get('type'));
		$this->set('_id', "$prefix-$id");
	}

	private function initializeDoc() {
		$fields = $this->getFieldsAndType();
		$this->set('type', get_called_class());
		foreach ($fields as $field => $type) {
			if ($field == 'id') {
				$field = '_id';
			}
			$this->set($field, null);
		}
	}

}
