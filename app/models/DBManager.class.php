<?php

class DBManager {
    static $db = null;
    static function setDB($db) {
        self::$db = $db;
    }
    static function getDB() {
        return self::$db;
    }
    static function createDB($pdo, $db = null, $user = null, $pass = null) {
        //self::setDB(new DB\Couch($pdo, $db));
        self::setDB(new DB\SQL($pdo, $user, $pass));
    }
}
