<?php
session_start();

require 'connection.php';

$username = $_POST['user'];
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
//  ********** files **********
// $file = $_FILES['file'];

// $fileName = $_FILES['file']['name'];
// $fileTmpName = $_FILES['file']['tmp_name'];
// $fileSize = $_FILES['file']['size'];
// $fileError = $_FILES['file']['error'];
// $fileType = $_FILES['file']['name'];

// $fileExt = explode('.' , $fileName);
// $fileActualExt = strtolower(end($fileExt));

// $allowed = array('jpg' , 'jpeg' , 'png' , 'pdf');
//  ********** files **********


$s = "SELECT * FROM admin WHERE email = '$email'";
$result = mysqli_query($con , $s);
$num = mysqli_num_rows($result);

if($num == 1){
    echo "username already taken";
}else{

    $reg = "INSERT INTO `admin`(`user_name`, `email`, `password`, `admin`) VALUES ('$username' , '$email' , '$pass' , 0 )";
    mysqli_query($con, $reg);
    echo "secceded";
    header('location:./');


    // if(in_array($fileActualExt , $allowed)){
    //     if ($fileError === 0){
    //         if ($fileSize < 1000000){
    //             $fileNameNew = uniqid('' , true) . "." . $fileActualExt;
    //             $fileDestination = 'images/users/' . $fileNameNew;
    //             move_uploaded_file($fileTmpName, $fileDestination);
    //             $reg = "insert into admins(user_name , email , password , profPic ) values ('$name' , '$email' , '$pass' , '$fileNameNew' )";
    //             mysqli_query($con, $reg);
    //             echo "secceded";
    //             header('location:dashbord_main.php');
    //         } else {
    //             echo "your file is too big";
    //         }
    //     } else {
    //         echo "There was an error while uploadin file!";
    //     }
    // } else {
    //     echo "You cannot upload files of this types";
    // }
    
}
