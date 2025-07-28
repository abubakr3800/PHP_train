<?php

abstract class User {
  protected $name;

  public function __construct($name) {
    $this->name = $name;
  }

  abstract public function describe();
}

class Student extends User {
  public function describe() {
    echo "Student: $this->name <br>";
  }
}

class Admin extends User {
  public function describe() {
    echo "Admin: $this->name <br>";
  }
}

$users = [
  new Student("Ali"),
  new Admin("Salma")
];

foreach ($users as $user) {
  $user->describe();
}