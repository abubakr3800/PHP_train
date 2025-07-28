<?php
class Student {
  public $name;
  public $email;

  function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }

  public function showInfo() {
    echo "Student: $this->name - $this->email";
  }
}

$std = new Student("Ali", "ali@example.com");
$std->showInfo();

// class ClassName {
//   public function __construct() {
//     // يتم التنفيذ عند إنشاء object
//   }
// }