<?php
session_start();
require('visit_log.php');
session_unset();
session_destroy();   