<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $grade = $_POST['grade'];

  $folder = "exports/" . date("Y-m-d");
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  $file = fopen("$folder/students.csv", "a");
  fputcsv($file, [$name, $grade]);
  fclose($file);
  echo "Saved to CSV.";
}