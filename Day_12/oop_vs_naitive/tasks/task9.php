<?php

// ✅ Task 9: Abstraction - Employee
abstract class EmployeeBase {
  abstract public function calculateSalary();
}

class HourlyEmployee extends EmployeeBase {
  public $hours;
  public $rate;
  public function __construct($hours, $rate) {
    $this->hours = $hours;
    $this->rate = $rate;
  }
  public function calculateSalary() {
    return $this->hours * $this->rate;
  }
}
