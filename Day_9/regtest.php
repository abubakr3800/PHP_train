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
    $name = $_POST['name'];
    $loemail = $_POST['email'];
    $logpass= $_POST['password'];
    echo $logpass . "<br>";
    // echo password_hash($logpass , PASSWORD_DEFAULT) . "<br>";

    $select = "SELECT password FROM admin WHERE email = '$loemail' AND password = '$logpass'";
    $result = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($result);
    $numRows = mysqli_num_rows($result);
    echo $numRows  . 'is number of rows';
    if( $numRows == 0 ){
        // echo "No rows found.";
        $logpass = password_hash($logpass , PASSWORD_DEFAULT);
        $insert = "INSERT INTO admin (username ,email, password) VALUES ('$name' , '$loemail', '$logpass')";
        $result2 = mysqli_query($conn, $insert);
        // $fetch2 = mysqli_fetch_assoc($result2);    
    
        // header("Location: logform.php");
    } else {
        echo "Found " . $numRows . " row(s)";
        $_SESSION['logstate'] = 1;
        // header("Location: logform.php");
    }
    echo $numRows;
}
?>