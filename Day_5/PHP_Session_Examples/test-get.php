<?php
    if (isset($_GET['username']) || $_GET['email']) {
        echo $_GET['username'] ."<br>" .$_GET['email'];
    }