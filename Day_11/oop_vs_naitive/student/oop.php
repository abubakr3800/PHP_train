<?php
class Student {
  public $name;
  public $email;
  public $age;
  public $courses = [];
  private $password; // private property cannot be accessed normally

  public function __construct($name, $email, $age, $courses, $password) {
    $this->name = $name;
    $this->email = $email;
    $this->age = $age;
    $this->courses = $courses;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function showInfo() {
    echo "Name: $this->name<br>";
    echo "Email: $this->email<br>";
    echo "Age: $this->age<br>";
    echo "Courses: " . implode(", ", $this->courses) . "<br><hr><br>";
  }

  public function verifyPassword($inputPassword) {
    return password_verify($inputPassword, $this->password);
  }
}

// Example usage
$student = new Student("Ali", "ali@example.com", 22, ["Math", "Physics", "English"], "123456");
$student2 = new Student("ahmed", "ahmed@example.com", 29, ["arabic", "Physics", "duetch"], "555");

$student->showInfo();
// echo "";
$student2->showInfo();

// Test password check
if ($student->verifyPassword("123456")) {
  echo "✅ Password for student 1 is correct";
} else {
  echo "❌ Wrong password for student 1";
}

// Test password check
if ($student2->verifyPassword("123456")) {
  echo "✅ Password for student 2 is correct";
} else {
  echo "❌ Wrong password for student 2";
}

?>