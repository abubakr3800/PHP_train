<?php
$name = "Ali";
$email = "ali@example.com";
$age = 22;
$courses = ["Math", "Physics", "English"];
$password = "123456"; // No encryption or security

echo "Name: $name<br>";
echo "Email: $email<br>";
echo "Age: $age<br>";
echo "Courses: " . implode(", ", $courses) . "<br>";
// No password shown for security
?>