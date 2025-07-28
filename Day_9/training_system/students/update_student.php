<?php
include '../db/db.php';
$id = $_GET['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];

$sql = "UPDATE students SET name='$name', email='$email', phone='$phone', date_of_birth='$dob'
        WHERE id=$id";
mysqli_query($conn, $sql);
header("Location: students.php");
