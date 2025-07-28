<?php
// ✅ Task 1: Wallet class (Encapsulation vs Data Hiding)
class Wallet {
  private $amount = 0;

  public function addMoney($value) {
    if ($value > 0) {
      $this->amount += $value;
    }
  }

  public function checkAmount() {
    return $this->amount;
  }
}
