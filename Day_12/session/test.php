<?php

$sql = "SELECT * FROM users WHERE email = '$email'";


$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);


echo $_GET['name'];
echo htmlspecialchars($_GET['name']);


$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$data = $stmt->get_result()->fetch_assoc();
echo json_encode(array_map("htmlspecialchars", $data));