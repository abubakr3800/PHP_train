<?php
require_once "Database.php";
require_once "Student.php";

parse_str(file_get_contents("php://input"), $_DELETE);
$id = $_DELETE['id'] ?? null;

if (!$id || !is_numeric($id)) {
  echo json_encode(["status" => "error", "message" => "Invalid ID"]);
  exit;
}

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

if ($student->delete($id)) {
  echo json_encode(["status" => "success", "message" => "Student deleted"]);
} else {
  echo json_encode(["status" => "error", "message" => "Delete failed"]);
}

?>
