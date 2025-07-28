<?php

// ✅ Task 7: Vehicle & Car (Inheritance)
class Vehicle {
  public $make;
  public $model;
  public function info() {
    echo "$this->make $this->model";
  }
}

class Car extends Vehicle {
  public $fuelType;
  public function info() {
    echo "$this->make $this->model runs on $this->fuelType";
  }
}
