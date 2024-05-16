<?php

class DBManager {
    static $db = null;
    static $mapper = null;

    static function setDB($db) {
        self::$db = $db;
    }
    static function getDB() {
        return self::$db;
    }

    public static function getMapper()
    {
        return self::$mapper;
    }

    static function createDB($pdo, $dbname = null, $user = null, $pass = null) {
        self::parseDSN($pdo);
        self::setDB(new self::$db($pdo, $user, $pass));
    }

    private static function parseDSN($dsn)
    {
        $scheme = strtok($dsn, ':');
        switch ($scheme) {
            case 'couchdb':
                self::$db = "DB\\Couch";
                self::$mapper = "DB\\Couch";
                break;
            case 'sqlite':
                self::$db = "DB\\SQL";
                self::$mapper = "DB\\SQL\\Mapper";
                break;
            default:
                throw new LogicException('Pas de config pour ce type de connexion');
                break;
        }
    }
}
