<?php
// هدف المثال: تسجيل زيارة المستخدم إلى الموقع في ملف نصي
$visitLog = fopen("logs/visits.txt", "a"); // فتح الملف بنمط الإضافة
fwrite($visitLog, "New Visit at " . date("Y-m-d H:i:s") . "\n" ); // كتابة التاريخ
fclose($visitLog); // إغلاق الملف