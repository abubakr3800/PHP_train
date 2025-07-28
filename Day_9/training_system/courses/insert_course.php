<?php
include '../db/db.php';
$title = $_POST['title'];
$desc = $_POST['description'];
$hours = $_POST['hours'];
$price = $_POST['price'];

mysqli_query($conn, "INSERT INTO courses (title, description, hours, price)
                     VALUES ('$title', '$desc', $hours, $price)");
header("Location: courses.php");
