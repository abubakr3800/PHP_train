<?php
require_once "Student.php";

$student1 = new Student("Ali", "ali@example.com", 20);
echo $student1->getProfile();
?>