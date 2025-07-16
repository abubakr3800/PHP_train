<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>نموذج وتقييم الطلاب - Bootstrap فقط</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> body { direction: rtl; } </style>
</head>
<body class="bg-dark text-white">

<div class="container py-5">
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <!-- ✅ FORM -->
            <h2 class="text-center mb-4">نموذج تسجيل الطالب</h2>
            <form class="g-3 was-validated" novalidate>
                <div class="row">
                    <div class="col-md-6">
                      <label for="fullname" class="form-label">الاسم الكامل</label>
                      <input type="text" class="form-control is-valid" id="validationServer01" required />
                      <div class="invalid-feedback">من فضلك أدخل الاسم.</div>
                    </div>
                
                    <div class="col-md-6">
                      <label for="email" class="form-label">البريد الإلكتروني</label>
                      <input type="email" class="form-control is-valid" id="validationServer02" required />
                      <div class="invalid-feedback">أدخل بريدًا إلكترونيًا صحيحًا.</div>
                    </div>
                
                    <div class="col-md-4">
                      <label for="age" class="form-label">العمر</label>
                      <input type="number" class="form-control" id="age" min="10" max="100" required>
                      <div class="invalid-feedback">أدخل العمر بشكل صحيح.</div>
                    </div>
                
                    <div class="col-md-4">
                      <label for="gender" class="form-label">الجنس</label>
                      <select class="form-select" id="gender" required>
                        <option selected disabled value="">اختر...</option>
                        <option>ذكر</option>
                        <option>أنثى</option>
                      </select>
                      <div class="invalid-feedback">اختر الجنس.</div>
                    </div>
                
                    <div class="col-md-4">
                      <label for="grade" class="form-label">الدرجة</label>
                      <input type="number" class="form-control" id="grade" min="0" max="100" required>
                      <div class="invalid-feedback">أدخل الدرجة من 0 إلى 100.</div>
                    </div>
                    
                    <div class="col-12">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" rows="3" required></textarea>
                        <div class="invalid-feedback">اكتب رايك هنا.</div>
                    </div>
                
                    <div class="col-12 text-center mt-3">
                      <button type="submit" class="btn btn-success px-4 me-2">إرسال البيانات</button>
                      <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#studentsModal">عرض الطلاب</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

  <!-- ✅ Modal with Table -->
  <div class="modal fade" id="studentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header text-dark">
          <h5 class="modal-title">قائمة الطلاب</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <?php
            $name1 = "أحمد علي";
            $grade1 = 90;
            $status1 = ($grade1 >= 85) ? "امتياز" : (($grade1 >= 75) ? "جيد جدا" : (($grade1 >= 65) ? "جيد" : (($grade1 >= 50) ? "مقبول" : "راسب")));

            $name2 = "منى سمير";
            $grade2 = 72;
            $status2 = ($grade2 >= 85) ? "امتياز" : (($grade2 >= 75) ? "جيد جدا" : (($grade2 >= 65) ? "جيد" : (($grade2 >= 50) ? "مقبول" : "راسب")));

            $name3 = "كريم فؤاد";
            $grade3 = 45;
            $status3 = ($grade3 >= 85) ? "امتياز" : (($grade3 >= 75) ? "جيد جدا" : (($grade3 >= 65) ? "جيد" : (($grade3 >= 50) ? "مقبول" : "راسب")));
          ?>

          <table class="table table-bordered mt-3">
            <thead class="table-dark">
              <tr>
                <th>الاسم</th>
                <th>الدرجة</th>
                <th>التقدير</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><?= $name1 ?></td><td><?= $grade1 ?></td><td><?= $status1 ?></td></tr>
              <tr><td><?= $name2 ?></td><td><?= $grade2 ?></td><td><?= $status2 ?></td></tr>
              <tr><td><?= $name3 ?></td><td><?= $grade3 ?></td><td><?= $status3 ?></td></tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ✅ Scripts -->
<script>
// Validation
(() => {
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form =>
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false)
  );
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
