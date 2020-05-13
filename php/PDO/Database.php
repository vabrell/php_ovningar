<?php

class Database {
    private $username = 'zoo_janitor';
    private $password = 'Zoo123';
    private $host = 'localhost';
    private $dbName = 'zoo';

    private $conn;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbName";
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (Exception $e) {
            throw new Exception("Något gick fel: " . $e->getMessage());
        }
    }

    public function conn() {
        return $this->conn;
    }
}