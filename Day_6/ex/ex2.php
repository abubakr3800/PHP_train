<?php
// إنشاء مجلد بتاريخ اليوم داخل مجلد logs
$today = date("Y-m-d");
$path = "logs/ahmed2";
if (file_exists($path)) {
    echo "file already exitst at: $path";
}else {
    mkdir($path, 0777, true);
    echo "Created folder: $path";
}