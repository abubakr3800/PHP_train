<?php
// file: student.php
class Student {
  public $name;
  public $email;
  private $isActive = false;

  public function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }

  public function activate() {
    $this->isActive = true;
  }

  public function getStatus() {
    return $this->isActive ? "Active" : "Inactive";
  }

  public function toJson() {
    return json_encode([
      "name" => $this->name,
      "email" => $this->email,
      "status" => $this->getStatus()
    ]);
  }
}
