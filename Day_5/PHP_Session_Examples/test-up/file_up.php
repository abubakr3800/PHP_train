<?php
  echo"<pre>";
  print_r($_FILES);
  echo"</pre>";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {

  
  $name = $_FILES['image']['name'];
  $ext = (explode('.' ,$name)[ count(explode('.' , $name) ) - 1]);
  $typ = (explode('/' ,$_FILES['image']["type"])[0]);
  $allowed = [ "png" , "jpg" , "jpeg" ];
  $tmp = $_FILES['image']['tmp_name'];
  if ( in_array($ext , $allowed) && $typ == "image" && $_FILES["image"]["size"] < 3 * 1024*1024 ) {

    // move_uploaded_file( $tmp , "img/$name");
    // echo "<img src='img/$name' class='img-thumbnail m-3' width='200'>";

  }else{
    echo "THIS IS NOT IMAGE";
  }
}
?>

  <form method="post" enctype="multipart/form-data" class="p-3">
    <input type="text" name="username">
    <input type="file" name="image[]" class="form-control mb-2" multiple accept=".jpg">
    <!-- <input type="file" name="file" class="form-control mb-2"> -->
    <button class="btn btn-primary">Upload</button>
  </form>