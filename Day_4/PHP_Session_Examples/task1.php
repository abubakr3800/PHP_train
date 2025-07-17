<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success">
    
    <?php
        $books = ["Clean Code", "The Pragmatic Programmer", "Design Patterns", "You Don’t Know JS", "Eloquent JavaScript"];
    ?>

    <div class="container mt-5">
    <h2 class="text-success mb-4">Book Titles</h2>
        <ul class="list-group">
            <?php foreach ($books as $book): ?>
                <li class="list-group-item"><?= $book ?></li>
            <?php endforeach; ?>
        </ul>
    </div>


    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 