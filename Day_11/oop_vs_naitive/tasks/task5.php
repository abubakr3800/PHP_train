<?php

// ✅ Task 5: Trait usage
trait Timestampable {
  public function currentTimestamp() {
    echo date("Y-m-d H:i:s");
  }
}

class Order {
  use Timestampable;
}

class Invoice {
  use Timestampable;
}
