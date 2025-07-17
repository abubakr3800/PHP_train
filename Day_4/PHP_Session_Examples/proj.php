<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <?php
$students = [
  ["name" => "Ahmed", "course" => "PHP", "grade" => 75],
  ["name" => "Salma", "course" => "JS", "grade" => 95],
  ["name" => "Youssef", "course" => "MySQL", "grade" => 58],
  ["name" => "Laila", "course" => "HTML", "grade" => 88]
];
?>

<div class="container mt-5">
  <h3 class="mb-4">Students Grades Report</h3>

  <table class="table table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>Name</th>
        <th>Course</th>
        <th>Grade</th>
        <th>Status</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $index => $student): ?>
        <tr class="<?= $student['grade'] < 60 ? 'table-danger' : 'table-success' ?>">
          <td><?= $student['name'] ?></td>
          <td><?= $student['course'] ?></td>
          <td><span class="badge bg-<?= $student['grade'] < 60 ? 'danger' : 'success' ?>"><?= $student['grade'] ?>%</span></td>
          <td>
            <?php if ($student['grade'] < 60): ?>
              <div class="alert alert-warning p-1 m-0" role="alert">Failed</div>
            <?php else: ?>
              Passed
            <?php endif; ?>
          </td>
          <td>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $index ?>">
              View
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modal<?= $index ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <p><strong>Name:</strong> <?= $student['name'] ?></p>
                    <p><strong>Course:</strong> <?= $student['course'] ?></p>
                    <p><strong>Grade:</strong> <?= $student['grade'] ?>%</p>
                    <p><strong>Status:</strong> <?= $student['grade'] < 60 ? 'Failed' : 'Passed' ?></p>
                  </div>
                </div>
              </div>
            </div>

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 