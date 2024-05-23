<?php

namespace Src\Database;

class UserAnalytics
{
    private $dbConnect;

    private $tableName = 'user_analytics';

    public function __construct()
    {
        $this->dbConnect = SqliteConnect::connect();
    }

    public function createTable()
    {
        $this->dbConnect->query(
            "CREATE TABLE IF NOT EXISTS `{$this->tableName}` (
            `id` INTEGER PRIMARY KEY AUTOINCREMENT,
            `ip4` UNSIGNED INT,
            `city` VARCHAR(255),
            `platform` VARCHAR(255),
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)"
        );
    }

    public function insert($insertData)
    {
        $sql = "INSERT INTO `{$this->tableName}` (ip4, city, platform) VALUES (:ip4, :city, :platform)";

        $stmt = $this->dbConnect->prepare($sql);

        $stmt->bindValue(":ip4", ip2long($insertData["ip4"]));
        $stmt->bindValue(":city", $insertData["city"]);
        $stmt->bindValue(":platform", $insertData["platform"]);

        $stmt->execute();
    }

    public function selectCountByCity()
    {
        $sql = "SELECT city, COUNT(id) as 'count' FROM user_analytics GROUP BY city";
        return $this->select($sql);
    }

    public function selectCountDistinctIpByHour()
    {
        $sql = "SELECT strftime ('%H', created_at) hour, COUNT(DISTINCT ip4) as 'count'
        FROM user_analytics
        GROUP BY strftime ('%H',created_at)";
        return $this->select($sql);
    }

    public function select(string $sql)
    {
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
