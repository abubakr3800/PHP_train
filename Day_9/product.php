<?php
session_start();
if (!isset($_SESSION['logstate']) || $_SESSION['logstate'] == 0) {
    // header("Location: logform.php");
}
// $str = 'VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZw==';
echo base64_encode("hello") ."<br>";
// echo password_hash("hello" , PASSWORD_DEFAULT) ."<br>";
echo base64_decode("aGVsbG8=");
    // echo "products";
?>