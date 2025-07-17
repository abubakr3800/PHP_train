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
      $products = [
        ["name" => "Laptop", "price" => 15000, "quantity" => 3],
        ["name" => "Phone", "price" => 8000, "quantity" => 5],
        ["name" => "Tablet", "price" => 6000, "quantity" => 2],
      ];
    ?>

    <div class="container mt-5">
      <h2 class="text-success mb-4">Product Inventory</h2>
      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Price (EGP)</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
              <td><?= $product["name"] ?></td>
              <td><?= $product["price"] ?></td>
              <td><?= $product["quantity"] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 