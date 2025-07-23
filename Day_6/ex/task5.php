<?php
$folder = "logs/" . date("Y-m-d_H-i");
if (!file_exists($folder)) mkdir($folder, 0777, true);