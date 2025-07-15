<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>نظام درجات الطلاب</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h2 class="mb-4 text-center">إدخال بيانات الطلاب</h2>
      <form method="POST" class="needs-validation" novalidate>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">اسم الطالب</label>
            <input type="text" name="name" class="form-control" required>
            <div class="invalid-feedback">من فضلك أدخل الاسم</div>
          </div>
          <div class="col-md-6">
            <label class="form-label">الدرجة</label>
            <input type="number" name="grade" class="form-control" required min="0" max="100">
            <div class="invalid-feedback">أدخل درجة بين 0 و 100</div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">إضافة</button>
      </form>
    </div>
  </div>

  <hr class="my-5">

  <?php
  session_start();
  if (!isset($_SESSION['students'])) $_SESSION['students'] = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $grade = (int)$_POST['grade'];
    $_SESSION['students'][] = ['name' => $name, 'grade' => $grade];
  }

  function getStatus($g) {
    return $g >= 50 ? "ناجح" : "راسب";
  }
  ?>

  <div class="row">
    <div class="col-12">
      <h4 class="mb-3">جدول النتائج</h4>
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>الاسم</th>
            <th>الدرجة</th>
            <th>الحالة</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['students'] as $student): ?>
            <tr>
              <td><?= htmlspecialchars($student['name']) ?></td>
              <td><?= $student['grade'] ?></td>
              <td><?= getStatus($student['grade']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetModal">إعادة التهيئة</button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="resetModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="?reset=true">
        <div class="modal-header">
          <h5 class="modal-title">تأكيد إعادة التهيئة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          هل أنت متأكد أنك تريد حذف جميع البيانات؟
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-danger">نعم، احذف الكل</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_GET['reset'])) {
  $_SESSION['students'] = [];
  header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
}
?>

<script>
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>