<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>مشروع PHP - اليوم الثاني</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php
session_start();
if (!isset($_SESSION['data'])) $_SESSION['data'] = [];

function getStatus($grade) {
  if ($grade >= 85) return "امتياز";
  elseif ($grade >= 75) return "جيد جدا";
  elseif ($grade >= 65) return "جيد";
  elseif ($grade >= 50) return "مقبول";
  else return "راسب";
}

function generateStudentRow($name, $grade) {
  $status = getStatus($grade);
  return "<tr><td>{$name}</td><td>{$grade}</td><td>{$status}</td></tr>";
}

if (isset($_POST['student_name']) && isset($_POST['student_grade'])) {
  $name = $_POST['student_name'];
  $grade = (int)$_POST['student_grade'];
  $_SESSION['data'][] = ['name' => $name, 'grade' => $grade];
}
?>

<div class="container py-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h2 class="text-center mb-4">إدخال درجات الطلاب</h2>
      <form method="post" class="needs-validation" novalidate>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">اسم الطالب</label>
            <input type="text" name="student_name" class="form-control" required>
            <div class="invalid-feedback">الرجاء إدخال الاسم</div>
          </div>
          <div class="col-md-6">
            <label class="form-label">الدرجة</label>
            <input type="number" name="student_grade" class="form-control" required min="0" max="100">
            <div class="invalid-feedback">الرجاء إدخال درجة بين 0 و 100</div>
          </div>
        </div>
        <button class="btn btn-success mt-3 w-100">إضافة</button>
      </form>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-10 offset-md-1">
      <h4 class="text-center mb-3">نتائج الطلاب</h4>
      <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
          <tr>
            <th>الاسم</th>
            <th>الدرجة</th>
            <th>التقدير</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['data'] as $student): ?>
            <?= generateStudentRow($student['name'], $student['grade']) ?>
          <?php endforeach; ?>
        </tbody>
      </table>

      <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#resetModal">إعادة تعيين البيانات</button>
    </div>
  </div>
</div>

<!-- Reset Modal -->
<div class="modal fade" id="resetModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="?reset=true">
        <div class="modal-header">
          <h5 class="modal-title">تأكيد الحذف</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          هل أنت متأكد من حذف جميع بيانات الطلاب؟
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-danger">نعم، احذف</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_GET['reset'])) {
  $_SESSION['data'] = [];
  header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
}
?>

<script>
(() => {
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