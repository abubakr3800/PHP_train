<?php
$servername ="localhost" ;
$username = "root";
$password = "";
$dbname = "training_system";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $message = $_POST["message"];
   $message = base64_encode($_POST["message"]);

   $query = "INSERT INTO chat (message , user1 , user2) VALUES ('$message' , 1 , 2)";
   mysqli_query($conn , $query);
}
?>

<form action="" method="POST">
    <textarea name="message" id=""></textarea>
    <input type="submit" value="Submit">
</form>

<?php
    $getMessages = "SELECT * FROM chat";
    $result = mysqli_query($conn, $getMessages);
    while($row = mysqli_fetch_assoc($result)){
        echo base64_decode($row['message']) . "<br>";
    }
?>