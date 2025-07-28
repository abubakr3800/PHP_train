<?php
abstract class Person {
  protected $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function introduce();
}

class Student extends Person {
  public function introduce() {
    echo "I am $this->name, a student.<br><hr><br>";
  }
}

class Teacher extends Person {
  public function introduce() {
    echo "I am $this->name, a teacher.<br><hr><br>";
  }
}

$people = [
  new Student("Ali"),
  new Teacher("Sara")
];

foreach ($people as $person) {
  $person->introduce();
}