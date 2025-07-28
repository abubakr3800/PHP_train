<?php
class Student {
  public $name;
  public $email;
  public $age;
  private $isActive = false;

  public function activate() {
    $this->isActive = true;
  }

  public function getStatus() {
    return $this->isActive ? "Active" : "Inactive";
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $s = new Student();
  $s->name = $_POST['name'];
  $s->email = $_POST['email'];
  $s->age = $_POST['age'];
  $s->activate();
  echo json_encode([
    "name" => $s->name,
    "email" => $s->email,
    "age" => $s->age,
    "status" => $s->getStatus()
  ]);
}
?>
