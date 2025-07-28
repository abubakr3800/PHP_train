<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "training_system";
    private $port = 3306;
    public $conn;

    public function connect() {
        $this->conn = new mysqli(
            $this->host, $this->username,
            $this->password, $this->dbname,
            $this->port
        );
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
