<?php
class User {
    protected $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    protected function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }
}
?>
