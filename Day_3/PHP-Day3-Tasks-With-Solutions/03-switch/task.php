<?php
$type = "guest";
switch ($type) {
  case "admin":
    echo "لوحة كاملة";
    break;
  case "editor":
    echo "محرر";
    break;
  case "guest":
    echo "عرض فقط";
    break;
  default:
    echo "غير معرف";
}
