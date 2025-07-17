<?php
$blocked_ips = ['192.168.0.1'];
if (in_array($_SERVER['REMOTE_ADDR'], $blocked_ips)) {
  header("Location: blocked.php");
  exit;
}
?>