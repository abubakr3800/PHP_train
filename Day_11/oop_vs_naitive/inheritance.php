<?php
class User {
  public $name;
  public function login() {
    echo "$this->name logged in";
  }
}

class Student extends User {
  public $grade;
  public function study() {
    echo "$this->name is studying...";
  }
}

$s = new Student();
$s->name = "Ali";
$s->login();
$s->study();