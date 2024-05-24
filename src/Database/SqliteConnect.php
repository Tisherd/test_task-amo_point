<?php

namespace Src\Database;

use SQLite3;

class SqliteConnect
{
    private static $connect;

    public static function connect() {
        if (self::$connect == null) {
            if (!file_exists(ENV['sqlite_db_path'])) {
                new SQLite3(ENV['sqlite_db_path']);
            }
            self::$connect = new \PDO(dsn: "sqlite:" . ENV['sqlite_db_path']);
            self::$connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$connect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return self::$connect;
    }
}