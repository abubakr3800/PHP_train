<?php
// ✅ Task 10: Polymorphism - Shape
class Shape {
  public function draw() {
    echo "Drawing shape\n";
  }
}

class Circle extends Shape {
  public function draw() {
    echo "Drawing Circle\n";
  }
}

class Rectangle extends Shape {
  public function draw() {
    echo "Drawing Rectangle\n";
  }
}

$shapes = [new Circle(), new Rectangle()];
foreach ($shapes as $shape) {
  $shape->draw();
}
