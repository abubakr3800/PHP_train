<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<p style='color:red'>❌ Email already exists.</p>";
    } else {
        $sql = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green'>✅ Registered successfully. <a href='login.html'>Login now</a></p>";
        } else {
            echo "<p style='color:red'>❌ Registration failed.</p>";
        }
    }
}
?>
