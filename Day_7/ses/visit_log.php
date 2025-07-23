<?php
// تسجيل زيارة المستخدم إلى الموقع في ملف نصي
$visitLog = fopen("logs/visits.txt", "a"); // فتح الملف بنمط الإضافة
fwrite($visitLog, "i visited the file " . $_SERVER['PHP_SELF'] . " at date: " . date("y-m-d_h:i") . "\n" ); // كتابة التاريخ
fclose($visitLog); // إغلاق الملف
?>
