
<?php
$users = [
  ['email' => 'admin@example.com', 'password' => '123456', 'name' => 'Admin'],
  ['email' => 'test@example.com', 'password' => 'test123', 'name' => 'Test User']
];

$email = $_GET['email'] ?? '';
$password = $_GET['password'] ?? '';
$loggedIn = false;
$name = '';
$message = '';
$secure = ($_SERVER['HTTP_HOST'] === 'localhost');

foreach ($users as $user) {
  if ($user['email'] === $email && $user['password'] === $password) {
    $loggedIn = true;
    $name = $user['name'];
    break;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">
    
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-6 col-12 p-5 mt-5 shadow rounded">
                <?php if (!$secure): ?>
                    <div class="alert alert-danger">⚠️ اتصال غير آمن: استخدم localhost فقط</div>
                <?php endif; ?>

                <?php if ($loggedIn): ?>
                    <div class="alert alert-success">✅ Welcome, <?= $name ?> (Admin)</div>
                    <div class="row">
                        <div class="col"><a class="btn btn-block btn-primary w-100" href="./login.php">logout</a></div>
                        <div class="col"><a class="btn btn-block btn-primary w-100" href="./products.php?email=<?=$email?>&password=<?= $password ?>">products</a></div>
                        <div class="col"><a class="btn btn-block btn-primary w-100" href="./signup.php">create account</a></div>
                    </div>
                <?php elseif (!$loggedIn && isset($_GET['email'])): ?>
                    <div class="alert alert-danger">⚠️ Wrong user or pass</div>
                    <form method="GET" class="was-validated" >
                        <div class="mb-3">
                            <label>Email</label>
                            <input name="email" type="email" required class="form-control is-valid" value="">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input name="password" type="password" required class="form-control  is-valid">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100">Login</button>
                        </div>
                        <div class="form-text text-secondary text-center">
                            <?php
                                foreach ($users as $value) {
                                    echo $value['email'] . "/" . $value['password'] . "<br>";
                                }    
                            ?>
                        </div>
                    </form>
                <?php else: ?>
                    <form method="GET" class="was-validated" >
                        <div class="mb-3">
                            <label>Email</label>
                            <input name="email" type="email" required class="form-control is-valid" value="">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input name="password" type="password" required class="form-control  is-valid">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100">Login</button>
                        </div>
                        <div class="form-text text-secondary text-center">
                            <?php
                                foreach ($users as $value) {
                                    echo $value['email'] . " / " . $value['password'] . "<br>";
                                }    
                            ?>
                        </div>
                    </form>
                    
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
