<?php
$students = [
  ["name" => "Ahmed", "score" => 95],
  ["name" => "Sara", "score" => 40],
  ["name" => "Laila", "score" => 87]
];

foreach ($students as $s) {
  $status = ($s['score'] >= 90) ? "ممتاز" : (($s['score'] >= 50) ? "ناجح" : "راسب");
  echo $s['name'] . ": " . $status . "<br>";
}
