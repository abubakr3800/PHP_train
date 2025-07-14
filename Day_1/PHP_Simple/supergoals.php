<?php
// echo "<pre>";
// var_dump($_SERVER);
// echo "</pre>"

// echo $_SERVER['SERVER_NAME'] . '<br>' . $_SERVER['REMOTE_ADDR'];

// echo $_SERVER['PHP_SELF'] . '<br>' ;
// echo $_SERVER['REMOTE_ADDR'] . "<br>" ; 
// echo $_SERVER['SERVER_NAME'] . "<br>" ; 
// echo $_SERVER['REQUEST_METHOD'] .  "<br>" ; 
// echo $_SERVER['HTTP_USER_AGENT']  ;

session_start();
$_SESSION['username'] = 'Ahmed';
$_SESSION['useremail'] = 'ahmed@g.c';
// var_dump( $_SESSION);

echo $_SESSION['username'] ;

?>