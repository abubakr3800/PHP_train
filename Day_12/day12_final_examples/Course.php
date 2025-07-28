<?php
class Course {
  private $conn;
  private $table = "courses";

  public function __construct($db) {
    $this->conn = $db;
  }

  public function getById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
?>
