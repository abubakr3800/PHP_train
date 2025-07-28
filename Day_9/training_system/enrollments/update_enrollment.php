<?php
include '../db/db.php';
$id = $_GET['id'];
$grade = $_POST['grade'];

mysqli_query($conn, "UPDATE enrollments SET grade = " . ($grade ? $grade : 'NULL') . " WHERE id = $id");
header("Location: enrollments.php");
