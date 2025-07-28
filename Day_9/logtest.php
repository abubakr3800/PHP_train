<?php
$servername ="localhost" ;
$username = "root";
$password = "";
$dbname = "test123";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $loemail = $_POST['email'];
    $loginpass= $_POST['password'];
    // echo $logpass . "<br>";
    echo md5($logpass ) . "<br>";


    $select = "SELECT * FROM admin WHERE email = '$loemail' ";
    $result = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($result);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        echo "email correct";
        if(password_verify($loginpass , $fetch['password']) ){
            echo "Found" . $numRows . "row(s)";
            $_SESSION['logstate'] = 1;
            $_SESSION['loginName'] = $fetch['username'];
            // header("Location: logform.php");
        } else {
            echo "No rows found. password wrong";
            $_SESSION['logstate'] = 0;
            // header("Location: logform.php");
        }
    }else {
        echo "wrong email";
    }
    // echo $numRows;
}
?>