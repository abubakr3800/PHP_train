<?php
class Student {
    private $name;
    private $email;
    private $age;

    public function __construct($name, $email, $age) {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }

    public function getProfile() {
        return "Name: $this->name\nEmail: $this->email\nAge: $this->age";
    }
}
?>