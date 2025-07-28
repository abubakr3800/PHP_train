<?php
// file: api.php
include 'student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  $student = new Student($data['name'], $data['email']);
  $student->activate();
  echo $student->toJson();
}