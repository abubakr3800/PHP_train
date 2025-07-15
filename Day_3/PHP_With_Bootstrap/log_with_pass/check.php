<?php
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Check if password is correct
    if ($password === '123') {
        // Password is correct - store username in session and redirect to welcome
        $_SESSION['user'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        // Password is wrong - store error in session and redirect back to login
        $_SESSION['error'] = "Password is wrong! Please try again.";
        header("Location: log_with_pass.php");
        exit();
    }
} else {
    // If not POST request, redirect to login page
    header("Location: ./");
    exit();
}
?> 