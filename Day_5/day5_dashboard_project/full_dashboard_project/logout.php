<?php
    // $log = file_get_contents('log.txt');
session_start();

?>
<!DOCTYPE html>
<html>
<head><title>Log File</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h3>Logs</h3>
<pre><?php
//  echo htmlspecialchars($log); 
session_unset();
session_destroy();
header("Location : index.php");
?></pre>
</body>
</html>
