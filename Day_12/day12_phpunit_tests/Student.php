<?php
class Student {
  private $conn;
  function __construct($db) {
    $this->conn = $db;
  }
  function getById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
?>