<?php
// Student Management System - Logout Page
// Demonstrates PHP fundamentals: session management

session_start();

// Destroy all session data
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?> 