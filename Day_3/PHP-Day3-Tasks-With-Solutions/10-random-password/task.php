<?php
function generatePassword($length = 6) {
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  $pass = "";
  for ($i = 0; $i < $length; $i++) {
    $pass .= $chars[rand(0, strlen($chars)-1)];
  }
  return $pass;
}

echo "Password: " . generatePassword();
