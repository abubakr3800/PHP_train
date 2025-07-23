<?php
// مثال لتصدير اسم ودرجة إلى ملف CSV يومي
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $folder = 'exports/' . date('Y-m-d');
  if (!file_exists($folder)) mkdir($folder);

  $f = fopen("$folder/grades.csv", 'a');
  fputcsv($f, [$_POST['student'], $_POST['score']]);
  fclose($f);
  echo "Saved.";
}