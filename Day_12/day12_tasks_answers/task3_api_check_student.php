<?php
require_once "Database.php";
require_once "Student.php";

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

$email = $_GET['email'] ?? null;
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(["status" => "error", "message" => "Invalid email"]);
  exit;
}

$data = $student->getByEmail($email);
if ($data) {
  $data = array_map("htmlspecialchars", $data);
  echo json_encode(["status" => "success", "student" => $data]);
} else {
  echo json_encode(["status" => "error", "message" => "Student not found"]);
}
?>