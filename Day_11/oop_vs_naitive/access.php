<?php
class User {
  public $username = "admin";
  protected $role = "moderator";
  private $password = "secret";

  public function showInfo() {
    echo $this->username;  // ✅
    echo $this->role;      // ✅
    echo $this->password;  // ✅
  }
}

$user = new User();
echo $user->username; // ✅
// echo $user->role; // ❌
// echo $user->password; // ❌