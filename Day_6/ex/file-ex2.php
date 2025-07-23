<?php
// قراءة محتوى ملف الزيارات كسطور مفصولة
$entries = file("logs/visits.txt");
echo "<pre>";
var_dump($entries);
echo "</pre>";
foreach ($entries as $index => $line) {
  echo "Visit #" . ($index + 1) . ": $line<br>";
}