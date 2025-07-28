<?php

// بعد التحقق من تسجيل الدخول:
$token = bin2hex(random_bytes(16));
$_SESSION['token'] = $token;
echo json_encode(["token" => $token]);

// في أي طلب لاحق:
if ($_SERVER['HTTP_AUTHORIZATION'] !== $_SESSION['token']) {
  http_response_code(403);
  echo json_encode(["error" => "Access Denied"]);
  exit;
}