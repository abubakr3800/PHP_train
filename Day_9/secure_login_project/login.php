<?php
session_start();
include "db.php";

$secure = ($_SERVER['HTTP_HOST'] === 'localhost');
$_SESSION['loggedin'] = $_SESSION['loggedin'] ?? false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['admin_name'] = $user['username'];
                $_SESSION['loggedin'] = true;
                $_SESSION['admin_email'] = $user['email'];
                echo "<div class='alert alert-success'>✅ Welcome, " . htmlspecialchars($user['username']) . "</div>";
            } else {
                echo "<div class='alert alert-danger'>❌ Wrong password.</div>" ;
            }
        } else {
            echo "<div class='alert alert-danger'>❌ No user found with this email.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>❌ Failed to prepare statement.</div>";
    }
}
?>
