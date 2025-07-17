<?php
//if ($_SERVER["HTTP_SEC_CH_UA_PLATFORM"] == 'Linux'){
//    header("location:./index.php");
//}
echo $_SERVER["REMOTE_ADDR"];
echo "<pre>";
    print_r($_SERVER);
echo "</pre>";