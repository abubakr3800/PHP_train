<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5 bg-dark text-white">
  <?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['users'][] = [
      'name' => $_POST['name'],
      'email' => $_POST['email']
    ];
    $users = json_decode($_COOKIE['users'] ?? '[]', true);
    $users[] = ['name' => $_POST['name'], 'email' => $_POST['email']];
    setcookie('users', json_encode($users), time() + 60);
  } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['need'])) {
      switch ($_GET['need']) {
        case 'del':
          session_unset();
          session_destroy();
          break;
        
        case 'last':
          array_pop($_SESSION['users']);
          break;
      }
    }
  }
  ?>

    <div class="container">
      <div class="row  d-flex justify-content-center">
        <div class="col-lg-6">
            <form method="post" class="py-3">
              <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
              <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
              <button type="submit" class="btn btn-success w-100">Save</button>
            </form>
        </div>
      </div>
      <div class="row my-4  d-flex justify-content-center">
          <div class="col-lg-3 col-6">
            <a class="btn btn-block btn-danger w-100" href="./session-task.php?need=del"> clear Session </a>
          </div>
          <div class="col-lg-3 col-6">
            <a  class="btn btn-block btn-warning w-100" href="./session-task.php?need=last"> remove last </a>
          </div>
      </div>
      <div class="row mt-5 d-flex justify-content-center">  
        <div class="col-lg-6">
          <table class="table table-bordered table-striped">
            <tr><th>user name</th><th>user email</th></tr>
            <?php
            if (isset($_SESSION['users'])) {
              # code...
          
            foreach( $_SESSION['users'] as $user){
            ?>
              <tr><td><?= $user['name']?></td><td><?= $user['email'] ?></td></tr>
            <?php
            }
            } else {
              echo "<div class='alert alert-danger' role='alert'>
                      No users!
                    </div>";
            }
            ?>
          </table>
        </div>
      </div>
    </div>
</body>
</html>