<?php

function calculateTotal($items, $tax = 0.14) {
  $sum = 0;
  foreach ($items as $i) {
    $sum += $i['price'] * $i['qty'];
  }
  return $sum + ($sum * $tax);
}

$discount = fn($total, $percent = 10) => $total - ($total * $percent / 100);

$notify = function($msg) {
  echo "<div class='alert alert-info'>$msg</div>";
};

function formatUserName(&$name) {
  $name = ucfirst(strtolower($name));
}

$products = [
  ['price' => 100, 'qty' => 2],
  ['price' => 50, 'qty' => 1]
];

$total = calculateTotal($products);
$final = $discount($total);
$name = "AHMED";
formatUserName($name);
$notify("Thank you $name. Your final total is $final.");