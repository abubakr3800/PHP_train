<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['age'] = $_POST['age'];
  $_SESSION['country'] = $_POST['country'];
  $_SESSION['job'] = $_POST['job'];
  header("Location: profile.php");
  exit;
}
?>
