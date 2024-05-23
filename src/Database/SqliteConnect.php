<?php

namespace Src\Database;

class SqliteConnect
{
    private static $connect;

    public static function connect() {
        if (self::$connect == null) {
            self::$connect = new \PDO(dsn: "sqlite:" . ENV['sqlite_db_path']);
            self::$connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$connect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return self::$connect;
    }
}