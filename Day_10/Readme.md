**Day 10: REST API with PHP (6 Hours)**

---

**Slide 1: Intro to API**

- API = Application Programming Interface → وسيلة لتواصل الأنظمة
- REST = Representational State Transfer → نوع من أنواع الـ API بيستخدم HTTP
- بيستخدم الطرق: GET, POST, PUT, DELETE
- بيرجع البيانات بصيغة JSON

**Task:**

> اشرح الفرق بين API و REST API بكلماتك.

---

**Slide 2: Database JOIN Recap**

- JOIN بيربط بيانات من جداول متعددة
- مثال: نعرض أسماء الطلاب، الكورسات، والدرجات من جدول enrollments

```sql
SELECT students.name, courses.title, enrollments.grade
FROM enrollments
JOIN students ON enrollments.student_id = students.id
JOIN courses ON enrollments.course_id = courses.id;
```

**Task:**

> أنشئ View باسم view\_student\_courses باستخدام الاستعلام السابق.

---

**Slide 3: REST Methods Overview**

| Method | Description  | DB Equivalent |
| ------ | ------------ | ------------- |
| GET    | جلب بيانات   | SELECT        |
| POST   | إضافة بيانات | INSERT        |
| PUT    | تعديل بيانات | UPDATE        |
| DELETE | حذف بيانات   | DELETE        |

**Task:**

> أي طريقة تستخدم لتحديث إيميل طالب؟

---

**Slide 4: GET Example (courses)**

```php
GET /api/courses.php        // جلب كل الكورسات
GET /api/courses.php?id=2   // جلب كورس محدد
```

**Task:**

> عدل السكريبت ليرجع 404 لو الكورس غير موجود.

---

**Slide 5: POST Example (Add Course)**

```js
fetch('/api/courses.php', {
  method: 'POST',
  body: JSON.stringify({ title: "PHP", price: 200 }),
  headers: { "Content-Type": "application/json" }
});
```

**Server-side PHP:**

```php
$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];
$price = $data['price'];
mysqli_query($conn, "INSERT INTO courses (title, price) VALUES ('$title', '$price')");
```

**Task:**

> أضف تحقق من الحقول الفارغة قبل الإضافة.

---

**Slide 6: PUT Example (Update Course)**

```js
fetch('/api/courses.php', {
  method: 'PUT',
  body: JSON.stringify({ id: 2, title: "Updated PHP" }),
  headers: { "Content-Type": "application/json" }
});
```

**Server-side PHP:**

```php
parse_str(file_get_contents("php://input"), $data);
$id = $data['id'];
$title = $data['title'];
mysqli_query($conn, "UPDATE courses SET title='$title' WHERE id=$id");
```

**Task:**

> أضف شرط للتأكد أن الكورس موجود قبل التحديث، وإذا غير موجود يرجع خطأ.

---

**Slide 7: DELETE Example**

```js
fetch('/api/courses.php?id=2', { method: 'DELETE' });
```

**PHP:**

```php
parse_str(file_get_contents("php://input"), $data);
$id = $data['id'];
mysqli_query($conn, "DELETE FROM courses WHERE id=$id");
```

**Task:**

> أضف تنبيه تأكيد قبل تنفيذ الحذف.

---

**Slide 8: Security – Login with Token**

- المستخدم يسجل دخول عبر POST إلى /api/login.php
- السيرفر يرجع Token
- المتصفح يخزن الـ Token في localStorage
- كل طلب API بيبعت التوكن للتأكد من الصلاحية

**Task:**

> خزّن اسم المستخدم في localStorage واظهره في الـ navbar.

---

**Slide 9: Authentication in UI**

كل صفحة تتحقق من وجود التوكن:

```js
if (!localStorage.getItem("token")) {
  alert("Please login");
  window.location.href = "login.html";
}
```

**Task:**

> أضف حماية التوكن إلى `students.html`, `courses.html`, `enrollments.html`

---

**Slide 10: Final Task**

> ابنِ CRUD كامل لجدول الطلاب باستخدام:

- students\_api/get.php
- students\_api/post.php
- students\_api/put.php
- students\_api/delete.php

🧩 استخدم Bootstrap + fetch() + token + navbar

