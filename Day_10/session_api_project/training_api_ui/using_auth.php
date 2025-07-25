<?php
header("Content-Type: application/json");
include "auth.php";
check_token(); // لازم التوكن يكون موجود وصحيح

// باقي كود API زي GET/POST/PUT...
