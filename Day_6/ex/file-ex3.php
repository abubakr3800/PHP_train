<?php
// إنشاء مجلد بتاريخ اليوم داخل مجلد logs
$today = date("Y-m-d_H-i");
$path = "logs/$today";
if (!file_exists($path)) {
  mkdir($path, 0777, true);
  echo "Created folder: $path";
}