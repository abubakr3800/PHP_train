<?php
class Student {
  public $name;
  public $email;

  function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }
}

$student = new Student("Ali", "ali@mail.com");
echo $student->name;
?>
