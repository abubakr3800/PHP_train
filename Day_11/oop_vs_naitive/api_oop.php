<?php
class Student {
  public $name;
  function __construct($name) {
    $this->name = $name;
  }
  function toJson() {
    return json_encode(["name" => $this->name]);
  }
}

$s = new Student($_POST['name']);
echo $s->toJson();
?>
