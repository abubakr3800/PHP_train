<?php
require_once 'User.php';

class Course extends User {
    private $courseTitle;
    private $hours;

    public function __construct($name, $email, $courseTitle, $hours) {
        parent::__construct($name, $email);
        $this->courseTitle = $courseTitle;
        $this->hours = $hours;
    }

    public function displayCourseInfo() {
        return "Instructor: " . $this->getName() . "<br>Course: $this->courseTitle<br>Hours: $this->hours";
    }
}
?>
