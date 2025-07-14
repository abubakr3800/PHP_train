<?php
    $fullname = $_POST['firstName'] . ' ' . $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $conf = $_POST['confpass'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            box-sizing: border-box;
        }

        .logform{
            width: 30%;
            margin: 50px auto;
            padding: 50px;
            background: #ddd;
        }

        .logform p {
            margin:20px 0;
            padding:10px;
            display:block;
            width: 100%;
        }
        .log-bt{
            background-color: #4CAF50;
            color:#f0f0f0;
        }
    </style>
</head>
<body>
    <div lass="logform">
        <p>your name is: <strong> <?php echo $fullname ?> </strong> </p>
        <p>your email is: <strong> <?php echo $email ?> </strong> </p>
        <p>your age is: <strong> <?php  echo ($password == $conf ? "password match" : "password not match" ) ?> </strong> </p>
    </div>
    <a href="./logform.php">go to login form</a>
</body>
</html>