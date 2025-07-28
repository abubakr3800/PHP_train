<?php
require_once "Database.php";
require_once "Student.php";

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

$id = $_GET['id'] ?? null;

if ($id && is_numeric($id)) {
  $data = $student->getById($id);
  echo json_encode(["status" => "success", "student" => array_map("htmlspecialchars", $data)]);
} else {
  $all = $student->getAll();
  echo json_encode(["status" => "success", "students" => array_map(function($row) {
    return array_map("htmlspecialchars", $row);
  }, $all)]);
}
?>
