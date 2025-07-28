<?php

// ✅ Task 4: Inheritance - Animal & Dog
class Animal {
  public $name;
  public function makeSound() {
    echo "Some generic sound";
  }
}

class Dog extends Animal {
  public function makeSound() {
    echo "Woof";
  }
}