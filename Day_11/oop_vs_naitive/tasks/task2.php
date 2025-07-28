<?php
// ✅ Task 2: Course class with constructor
class Course {
  public $title;
  public $instructor;

  public function __construct($title, $instructor) {
    $this->title = $title;
    $this->instructor = $instructor;
  }

  public function describe() {
    echo "Course: $this->title by $this->instructor";
  }
}
