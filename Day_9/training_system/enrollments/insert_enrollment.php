<?php
include '../db/db.php';
$student_id = $_POST['student_id'];
$course_id = $_POST['course_id'];
$grade = $_POST['grade'];

$sql = "INSERT INTO enrollments (student_id, course_id, grade)
        VALUES ($student_id, $course_id, " . ($grade ? $grade : 'NULL') . ")";
mysqli_query($conn, $sql);
header("Location: enrollments.php");
