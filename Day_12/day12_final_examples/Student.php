<?php
class Student {
  private $conn;
  private $table = "students";

  public function __construct($db) {
    $this->conn = $db;
  }

  public function getById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function getByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function getAll() {
    $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function create($name, $email) {
    $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    return $stmt->execute();
  }

  public function update($id, $name, $email) {
    $stmt = $this->conn->prepare("UPDATE " . $this->table . " SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);
    return $stmt->execute();
  }

  public function delete($id) {
    $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }
}
?>
