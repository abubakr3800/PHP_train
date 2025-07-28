<?php
trait Logger {
  public function log($msg) {
    echo "[LOG] $msg";
  }
}

class Student {
  use Logger;
  public $name = "Ali";
}

$s = new Student();
$s->log("Student created");
?>
