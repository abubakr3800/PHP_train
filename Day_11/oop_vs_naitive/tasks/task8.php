<?php

// ✅ Task 8: BankAccount (Encapsulation)
class BankAccount {
  private $balance = 0;

  public function deposit($amount) {
    if ($amount > 0) $this->balance += $amount;
  }

  public function withdraw($amount) {
    if ($amount <= $this->balance) $this->balance -= $amount;
  }

  public function getBalance() {
    return $this->balance;
  }
}