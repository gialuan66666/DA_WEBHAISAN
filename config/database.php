<?php

class Database
{
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbname = "da_webhaisan";
    private $dbpass = "mysql"; 

    public $dbconnection;

    public function connect()
    {
        try {

            $this->dbconnection = new PDO(
                "mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8",
                $this->dbuser,
                $this->dbpass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

            return $this->dbconnection;

        } catch (PDOException $e) {

            die("Kết nối thất bại: " . $e->getMessage());

        }
    }
}