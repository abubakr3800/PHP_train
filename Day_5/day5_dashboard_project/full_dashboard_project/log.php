<?php
$log = file_get_contents('log.txt');
?>
<!DOCTYPE html>
<html>
<head><title>Log File</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h3>Logs</h3>
<pre><?php echo htmlspecialchars($log); ?></pre>
</body>
</html>
