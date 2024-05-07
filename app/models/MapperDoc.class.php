<?php

abstract class MapperDoc extends DB\Couch\Mapper {

	public static function getFieldsAndType() { return []; }

	function __construct() {
        parent::__construct(DBManager::getDB());
	}

}
