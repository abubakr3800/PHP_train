<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php
$tools = ["VS Code", "Git", "GitHub", "Figma", "Postman"];

echo "Tools Count: " . count($tools) . "<br>";

if (in_array("GitHub", $tools)) {
  echo "GitHub is in the list.<br>";
}

echo "All Tools: ";
print_r(array_values($tools));
?>
    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 