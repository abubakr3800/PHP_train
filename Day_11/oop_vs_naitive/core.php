<?php
abstract class Person {
  protected $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function introduce();
}

class Student extends Person {
  private $courses = [];

  public function enroll($course) {
    $this->courses[] = $course;
  }

  public function introduce() {
    echo "I'm $this->name and I'm a student.";
  }
}

class Teacher extends Person {
  public function introduce() {
    echo "I'm $this->name and I teach programming.";
  }
}

$people = [
  new Student("Ali"),
  new Teacher("Sara")
];

foreach ($people as $person) {
  $person->introduce();
}