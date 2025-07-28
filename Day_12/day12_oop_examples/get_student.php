<?php
require_once "Database.php";
require_once "Student.php";

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
  echo json_encode(["status" => "error", "message" => "Invalid ID"]);
  exit;
}

$data = $student->getById($id);
$data = array_map("htmlspecialchars", $data);
echo json_encode(["status" => "success", "student" => $data]);
?>