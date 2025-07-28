<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "training_system";

// إنشاء الاتصال
$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>