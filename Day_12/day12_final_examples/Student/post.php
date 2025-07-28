<?php
require_once "Database.php";
require_once "Student.php";

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

if (!$name || !$email) {
  echo json_encode(["status" => "error", "message" => "Missing name or email"]);
  exit;
}

if ($student->create($name, $email)) {
  echo json_encode(["status" => "success", "message" => "Student added"]);
} else {
  echo json_encode(["status" => "error", "message" => "Insertion failed"]);
}
?>
