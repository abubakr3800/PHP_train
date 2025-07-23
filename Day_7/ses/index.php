<?php
session_start();
$_SESSION['count'] = ($_SESSION['count'] ?? 0 ) + 1;
// isset($_SESSION['count']) ?  $_SESSION['count'] += 1 : $_SESSION['count'] = 1  ;
include_once("visit_log.php");
include("visit_log.php");
?>
<?php
function ecPrin(){
    // require_once("print_log.php");
    echo __FUNCTION__;
}
// require("print_log.php");
echo __DIR__;
// ecPrin();
?>
<p> user visit counts is : <?= $_SESSION['count'] ?> </p>

