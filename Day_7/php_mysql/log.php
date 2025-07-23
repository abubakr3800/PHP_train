<?php
session_start();

require 'connection.php';


$mail = $_POST['email'];
$pass = $_POST['password'];


$s = "SELECT * FROM admin WHERE email = '$mail' && password = '$pass' ";
$result = mysqli_query($con , $s);
$num = mysqli_num_rows($result);

if($num == 1){
    while($row = mysqli_fetch_assoc($result)) {
        if($row["admin"] == 1){
            $_SESSION['userId']     = $row['id'];
            $_SESSION['user_name']  = $row["user_name"];
            $_SESSION['email']      = $row['email'];
            header('location:./');
        }else if($row["admin"] == 0) {
            echo "you are such a user please contact admin to change your permision";
        }
        // $_SESSION['username'] = $name;
        echo "username: " . $row["user_name"]. " - password: " . $row["password"]. " " . $row["admin"]. "<br>";
        echo gettype($row["admin"]). "<br>";
        settype($row["admin"],'boolean');
        echo gettype($row["admin"]). "<br>" . $row["admin"]. "<br>";
        
    }
}else{
    $error = "Your Login Name or Password is invalid please sign in first";
    echo $error . "<a href='./sign-in'> go back </a>";
}