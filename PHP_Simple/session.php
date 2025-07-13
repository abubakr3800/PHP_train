<?php
session_start();
if ($_POST['password'] === '123') {
  $_SESSION['user'] = $_POST['username'];
  header("Location: welcome.php");
}