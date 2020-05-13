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
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Något gick fel: " . $e->getMessage());
        }
    }

    public function conn() {
        return $this->conn;
    }
}