<?php
$users = json_decode($_COOKIE['users'] ?? '[]', true);
$users[] = ['name' => $_POST['name'], 'email' => $_POST['email']];
setcookie('users', json_encode($users), time() + 3600);
?>