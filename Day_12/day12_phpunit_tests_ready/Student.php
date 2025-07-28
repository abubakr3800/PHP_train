<?php
class Student {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getAll() {
        $sql = "SELECT * FROM students";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
