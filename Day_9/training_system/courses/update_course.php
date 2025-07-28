<?php
include '../db/db.php';
$id = $_GET['id'];
$title = $_POST['title'];
$desc = $_POST['description'];
$hours = $_POST['hours'];
$price = $_POST['price'];

mysqli_query($conn, "UPDATE courses SET title='$title', description='$desc', hours=$hours, price=$price WHERE id=$id");
header("Location: courses.php");
