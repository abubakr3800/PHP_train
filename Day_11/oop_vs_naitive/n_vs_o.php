<?php
$name = "Ali";
echo "$name is attending...";

class Student {
  public $name;
  public function attend() {
    echo "$this->name is attending...";
  }
}

$student1 = new Student();
$student1->name = "Ali";
$student1->attend();
?>