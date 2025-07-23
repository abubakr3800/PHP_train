<?php
session_start();
$rows = file("logs/login.log");
if (!isset($_SESSION['user'])) { 
    die("Access denied. <a href='login.php'>Login</a>");
}else {
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>";
require('nav.php');
echo "<div class='container mt-5'><h4>📝 Login Log</h4>";
echo "<table class='table table-bordered'><thead><tr><th>Date</th><th>User</th><th>Status</th></tr></thead><tbody>";
foreach ($rows as $row) {
  list($date, $user, $status) = explode("|", $row);
  echo "<tr>
    <td class='text-muted'>$date</td>
    <td class='fw-bold'>$user</td>
    <td><span class='badge bg-" . (trim($status) == 'SUCCESS' ? 'success' : 'danger') . "'>" . trim($status) . "</span></td>
  </tr>";
}
echo "</tbody></table></div>";
}
?>
