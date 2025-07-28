<?php
// ✅ Task 3: Employee class with access modifiers
class Employee {
  public $name;
  protected $salary;
  private $bonus;

  public function __construct($name, $salary, $bonus) {
    $this->name = $name;
    $this->salary = $salary;
    $this->bonus = $bonus;
  }

  public function showDetails() {
    echo "Name: $this->name, Salary: $this->salary, Bonus: $this->bonus";
  }
}
