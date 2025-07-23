<?php
// $name = $_GET['name'] ?? '';
(isset($_GET['name']) ?  ($name = $_GET['name']) : ($name = ''));
$track = $_GET['track'] ?? '';
$email = $_GET['email'] ?? '';
$phone = $_GET['phone'] ?? '';
// $name_arr = explode(' ', $name);
// print_r(explode(' ', $name));

function getTotal($x , $y , $z){
  return $x+$y+$z;
}

$getOffer = fn($price , $offer) => "$price * $offer" ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submission Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 bg-white p-4 rounded shadow text-center">

          <h2 class="text-success"> 🎉 Thank you, <?php echo trim(ucfirst(strtolower($name)))  ; ?>!</h2>
          <p><strong>Track:</strong> <?php echo $track; ?></p>
          <p><strong>Email:</strong> <?php echo $email; ?></p>
          <p><strong>Phone:</strong> <?php echo ( $phone); ?></p>
          <p><strong>total price:</strong> <?php echo ( getTotal(4 , 5 , 7)); ?></p>
          <p><strong>total price after offer:</strong> <?php echo $getOffer(getTotal(4 , 5 , 7) , .5); ?></p>

      </div>
    </div>
  </div>
</body>
</html>