<?php
session_start();
$_SESSION["name"] = $_GET['name'];
$_SESSION["user"][] = [
    'username' => $_GET['name'],
    'email' => $_GET['email'],
    'password' => $_GET['pass']
];
// array_push([
//     'username' => "ahmed",
//     'email' => "ahmed@g.c",
//     'password' => "123456"
// ]);
// echo $_SESSION['username'] ."<br>"; // Outputs: ahmed
echo "<pre>";
print_r($_SESSION);
echo "</pre>";