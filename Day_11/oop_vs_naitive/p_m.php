<?php
class Student {
  public $name;
  public $email;

  public function sayHello() {
    echo "Hello $this->name";
  }

  public function showEmail() {
    echo $this->email;
  }
}

// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

class User {
  public $name = "Ali";
  private $password = "12345";
  protected $secret = "hidden";

  public function getPassword() {
    return $this->password;
  }
}
