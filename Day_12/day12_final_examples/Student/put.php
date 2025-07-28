<?php
require_once "Database.php";
require_once "Student.php";

parse_str(file_get_contents("php://input"), $_PUT);

$id = $_PUT['id'] ?? null;
$name = $_PUT['name'] ?? '';
$email = $_PUT['email'] ?? '';

if (!$id || !$name || !$email) {
  echo json_encode(["status" => "error", "message" => "Missing data"]);
  exit;
}

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

if ($student->update($id, $name, $email)) {
  echo json_encode(["status" => "success", "message" => "Student updated"]);
} else {
  echo json_encode(["status" => "error", "message" => "Update failed"]);
}
?>
