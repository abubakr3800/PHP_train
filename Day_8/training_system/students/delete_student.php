<?php
include '../db/db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM students WHERE id=$id");
header("Location: students.php");
