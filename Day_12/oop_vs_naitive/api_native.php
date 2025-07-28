<?php
// post.php
$name = $_POST['name'];
echo json_encode(["name" => $name]);
?>
