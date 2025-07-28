<?php include '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="../dt/datatables.min.css"> -->
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Student List</h3>
  <?= $role == 1 ? '<a href="add_student.php" class="btn btn-success mb-3">+ Add Student</a>' : " "; ?>
  <table class="table table-bordered table-striped" id="dt-test">
    <thead class="table-dark">
      <tr>
        <th>Name</th><th>Email</th><th>Phone</th><th>DOB</th> <?= $role == 1 ? "<th>Actions</th>" : " "; ?>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = "SELECT * FROM students";
      $res = mysqli_query($conn, $q);
      // var_dump($res);
      while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['date_of_birth']}</td>
                ";
                if($role == 1){
                  echo "<td>
                    <a href='edit_student.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete_student.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                  </td>";
                }
                echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../dt/datatables.min.js"></script>
<script>
  let table = new DataTable('#dt-test', {
      responsive: true,
      layout: {
        topStart: {
            buttons: [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
                }
            ]
        }
    }
  });
</script> -->
</body>
</html>
