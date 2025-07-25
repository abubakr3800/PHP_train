**الشرح الكامل ليوم Firebase لـ Frontend Developers**

---

### مدة اليوم: 6 ساعات
### المستوى: مبتدئ إلى متوسط
### التكنولوجيا: Firebase (Compat API), JavaScript, HTML, Bootstrap (اختياري)

---

## الساعة الأولى: مقدمة + إعداد Firebase

**مفاهيم:**
- ما هو Firebase؟
- خدمات Firebase للفرونت أند (Auth, Firestore, Hosting)
- كيفية إنشاء Firebase Project وإضافة Web App

**المثال:**
```html
<script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js"></script>
<script>
  const firebaseConfig = {
    apiKey: "...",
    authDomain: "...",
    projectId: "..."
  };
  firebase.initializeApp(firebaseConfig);
</script>
```

**التاسك:** ينشئ الطالب Firebase Project ويربطه بصفحة HTML.

**الحل:** تركيب firebaseConfig + سكريبت firebase-app.

---

## الساعة 2: Firestore (Add/Get)

**مفاهيم:**
- Collection - Document - Fields
- مفهوم NoSQL

**المثال:**
```js
const db = firebase.firestore();

db.collection("tasks").add({ title: "Buy milk", done: false });

db.collection("tasks").get().then(snapshot => {
  snapshot.forEach(doc => console.log(doc.data()));
});
```

**التاسك:** إنشاء input + button لإضافة مهمة وعرضها في UL.

**الحل:**
- `document.getElementById("taskInput").value`
- `db.collection("tasks").add(...)`
- `ul.innerHTML += ...`

---

## الساعة 3: Real-time Updates

**مفاهيم:**
- `onSnapshot()` vs `get()`

**المثال:**
```js
db.collection("tasks").onSnapshot(snapshot => {
  list.innerHTML = "";
  snapshot.forEach(doc => {
    const task = doc.data();
    const li = document.createElement("li");
    li.textContent = task.title;
    list.appendChild(li);
  });
});
```

**التاسك:** استخدام `onSnapshot` للتسجيل في console عند إضافة مهمة.

**الحل:** استخدام `.forEach(doc => console.log(doc.data()))`

---

## الساعة 4: Firebase Authentication (Google)

**مفاهيم:**
- Google Sign-in
- ربط UID مع مهام المستخدم

**المثال:**
```js
const auth = firebase.auth();
const provider = new firebase.auth.GoogleAuthProvider();

auth.signInWithPopup(provider).then(result => {
  console.log(result.user.displayName);
});
```

**التاسك:**
- عمل login button
- عرض اسم المستخدم بعد الدخول

**الحل:** `document.getElementById("userInfo").textContent = user.displayName`

---

## الساعة 5: المشروع العملي

**To-Do App:**
- Google Login
- إضافة/حذف مهام
- عرض فقط مهام UID
- Realtime update

**التاسك:**
- اضافة Checkbox + Line-through
- عمل Logout

**الحل:**
- `db.collection("tasks").doc(id).update({ done: !done })`
- CSS: `text-decoration: line-through`

---

## الساعة 6: Challenge + Deploy

**التحدي:**
- ترتيب المهام حسب الوقت
- المهام المنتهية في نهاية القائمة

**الحل:**
- `orderBy("done")`
- `orderBy("createdAt")`

---

اليوم ينتهي بمشروع كامل ومراجعة لكل ال API المستعملة.

