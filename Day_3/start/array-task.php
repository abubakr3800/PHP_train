<?php
// 1. مصفوفة أسماء
$students = array("Ahmed", "Salma", "Omar", "Laila", "Youssef");

// 2. مصفوفة الاسم والدرجة
$grades = array(
    "Ahmed" => 88,
    "Salma" => 92,
    "Omar" => 75,
    "Laila" => 85,
    "Youssef" => 90
);

// 3. اطبع أول اسم
echo "First student: " . $students[0] . "<br>";

// 4. اطبع اسم ودرجة طالب
echo "Salma's grade: " . $grades["Salma"];
?>