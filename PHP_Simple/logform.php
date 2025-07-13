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

        .logform input {
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
    <form action="profile.php" method="POST" class="logform">
        <input type="text" name="firstName"   placeholder="type first name" required>
        <input type="text" name="lastName"   placeholder="type last name" required>
        <input type="email" name="email"   placeholder="type email" required>
        <input type="password" name="pass" placeholder="type password" required>
        <input type="password" name="confpass" placeholder="renter password" required>
        <input type="submit" value="Submit" class=log-bt>
    </form>
</body>
</html>