<?php
require_once 'Course.php';

$course = new Course("Ahmed", "ahmed@example.com", "PHP Advanced", 40);
echo $course->displayCourseInfo();
?>
