<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>All Students</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include "navigation.php"; ?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-3 text-center">Student List</h2>
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Birth Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM students";
                $result = $conn->query($sql);
            
                if ($result && $result->num_rows > 0):
                  while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= $row['name'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['phone'] ?></td>
                      <td><?= $row['date_of_birth'] ?></td>
                    </tr>
                <?php
                  endwhile;
                else:
                  echo "<tr><td colspan='5'>No students found.</td></tr>";
                endif;
                ?>
              </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
