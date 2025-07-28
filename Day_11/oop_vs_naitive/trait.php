<?php
trait Logger {
  public function log($message) {
    echo "[LOG] $message";
  }
}

class Student {
  use Logger;
  public $name = "Ali";
}

class Teacher {
  use Logger;
  public $name = "Sara";
}

$s = new Student();
$s->log("Student object created");