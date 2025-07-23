<?php
session_start();
$rows = file("logs/uploads.log");
if (!isset($_SESSION['user'])) { 
    die("Access denied. <a href='login.php'>Login</a>");
}else {
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>";
require('nav.php');
echo "<div class='container mt-5'><h4>📂 Upload Log</h4>";
echo "<table class='table table-striped'><thead><tr><th>Date</th><th>User</th><th>Type</th><th>Path</th><th>MIME</th></tr></thead><tbody>";
foreach ($rows as $row) {
  list($date, $user, $type, $path, $mime) = explode("|", $row);
  echo "<tr>
    <td>$date</td>
    <td>$user</td>
    <td><span class='badge bg-info'>" . trim($type) . "</span></td>
    <td><code>" . trim($path) . "</code></td>
    <td><small>" . trim($mime) . "</small></td>
  </tr>";
}
echo "</tbody></table></div>";
}
?>
