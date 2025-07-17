<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        print_r($_POST);
        echo "<br>";
        if(isset($_POST['date']))
            echo $_POST['date'];
    ?>
    <form action="" method="">
        <input type="date" name="date" >
        <input type="email" name="email" >
        <input type="password" name="password" >
        <button>send</button>
    </form>
</body>
</html>