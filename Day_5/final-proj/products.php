<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Upload</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-dark text-white">
<div class="container">
    <?php
    $products = [];
    if (isset($_GET['email'])) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['product_name'];
        $desc = $_POST['desc'];
        $imagePaths = [];
        
        if (!empty($_FILES['images']['name'][0])) {
            $dir = 'uploads/' . date('Y-m-d') . '/';
            if (!file_exists($dir)) mkdir($dir, 0777, true);
        
            foreach ($_FILES['images']['tmp_name'] as $i => $tmpName) {
            $type = $_FILES['images']['type'][$i];
            if (in_array($type, ['image/png', 'image/jpeg', 'image/jpg'])) {
                $fileName = time() . '_' . basename($_FILES['images']['name'][$i]);
                $path = $dir . $fileName;
                move_uploaded_file($tmpName, $path);
                $imagePaths[] = $path;
            }
            }
        
            $products[] = [
            'name' => $name,
            'desc' => $desc,
            'images' => $imagePaths
            ];
        }
        }
    ?>
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-md-8">
              <form method="POST" enctype="multipart/form-data" class="row g-3 needs-validation p-5 d-flex justify-content-center" novalidate>
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input name="product_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Description</label>
                    <input name="desc" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Product Images</label>
                    <input type="file" name="images[]" class="form-control" multiple required>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary w-100">Add Product</button>
                </div>
            </form>
        </div>
    </div>

  <hr class="my-4">

  <?php if (!empty($products)): ?>
    <div class="row mt-4 justify-content-center">
      <?php foreach ($products as $product): ?>
        <?php foreach ($product['images'] as $img): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-secondary text-white">
              <img accept="image/*" src="<?= $img ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5><?= htmlspecialchars($product['name']) ?></h5>
                <p><?= htmlspecialchars($product['desc']) ?></p>
                <p>added by <a class="text-dark" href="mailto:<?= htmlspecialchars($_GET['email']) ?>"><?= htmlspecialchars($_GET['email']) ?></a></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <?php
    }else {
    ?>
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="alert alert-danger">not authorized <a href="./login.php" class="alert-link">sign in and come again</a></div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</body>
</html>
