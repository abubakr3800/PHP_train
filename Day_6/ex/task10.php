<?php

$folder = "uploads/" . date("Y-m-d") . "/";
$files = glob($folder . "*.*");

foreach ($files as $f) {
  $info = pathinfo($f);
  echo "<p>";
  echo "<strong>Name:</strong> " . basename($f) . " | ";
  echo "<strong>Type:</strong> " . $info['extension'] . " | ";
  echo "<strong>Size:</strong> " . filesize($f) . " bytes";
  echo "</p>";
}