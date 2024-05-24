<?php

namespace Src\Database;

class Users
{
    private $dbConnect;

    private $tableName = 'users';

    public function __construct()
    {
        $this->dbConnect = SqliteConnect::connect();
    }

    public function createTable()
    {
        $this->dbConnect->query(
            "CREATE TABLE IF NOT EXISTS `{$this->tableName}` (
            `id` INTEGER PRIMARY KEY AUTOINCREMENT,
            `login` VARCHAR(255) UNIQUE,
            `password` VARCHAR(255)
            )"
        );
    }

    public function insert($insertData)
    {
        $sql = "INSERT INTO `{$this->tableName}` ('login', 'password') VALUES (:login, :password)";

        $stmt = $this->dbConnect->prepare($sql);

        $stmt->bindValue(":login", $insertData["login"]);
        $stmt->bindValue(":password", md5($insertData["password"]));

        $stmt->execute();
    }

    public function selectUserByLoginAndPass(string $login, string $password)
    {
        $md5Pass = md5($password);
        $sql = "SELECT * FROM `{$this->tableName}` WHERE login='$login' AND password='$md5Pass'";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function select(string $sql)
    {
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
