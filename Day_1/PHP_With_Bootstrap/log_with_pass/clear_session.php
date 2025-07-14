<?php
// Start session
session_start();

// Clear all session data
session_unset();

// Destroy the session
session_destroy();

// Send response
echo "Session cleared successfully";
header("Refresh:5; url=index.php");
?> 