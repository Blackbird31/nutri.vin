<?php

class MapperDoc extends DB\Couch\Mapper {

	function __construct() {
        parent::__construct(DBManager::getDB());
	}

}
