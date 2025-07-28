<?php
abstract class Person {
  protected $name;
  protected $subject;
  public function __construct($name , $subject) {
    $this->name = $name;
    $this->subject = $subject;
  }
  abstract public function introduce();
}

class Teacher extends Person {
  public function introduce() {
    echo "I am $this->name, and I teach $this->subject.";
  }
}

$teacher1 = new Teacher("John" , "math");

$teacher1->introduce();
// echo $teacher1->name;


// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-

// class Person {
//     abstract public function introduce(); // ❌ خطأ
// }

// abstract class Person {
//     abstract public function introduce();
// }

// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-

abstract class Animal {
    abstract public function makeSound();
}

$dog = new Animal(); // ❌ خطأ

class Dog extends Animal {
    public function makeSound() {
        echo "Woof!";
    }
}
$dog = new Dog();

// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-

// abstract class Person {
//   abstract public function introduce();
// }

// class Student extends Person {
//   // ❌ لم ينفذ الدالة
// }

// class Student extends Person {
//   public function introduce() {
//     echo "I'm a student.";
//   }
// }