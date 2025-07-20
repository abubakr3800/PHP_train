# 📘 Day 6: PHP Functions + Strings + File System (Full Day)

---

## 🟦 Part 1: PHP Functions + String Built-in Functions

### ✅ Covered Topics

#### PHP Functions:

- Named functions
- Arrow functions
- Anonymous functions
- Functions with default parameters
- Passing by reference

#### String Functions:

- `strlen()`, `strtoupper()`, `strtolower()`, `ucfirst()`
- `trim()`, `str_replace()`, `strpos()`, `substr()`

---

### 🔸 Example: Multi-type Functions

```php
function greet($name = "Guest") {
  return "Welcome $name!";
}

function capitalize(&$name) {
  $name = ucfirst(strtolower($name));
}

$logger = fn($msg) => "[LOG] " . strtoupper($msg);

$hello = function($name) {
  return "Hello $name";
};

$name = "sara";
capitalize($name);
echo greet($name);             // Welcome Sara!
echo $logger("logged in");     // [LOG] LOGGED IN
echo $hello("Ali");            // Hello Ali
```

---

### 🧪 Task: Order Summary System

**Task:** Build a script that includes:

- A function to calculate total
- Arrow function for tax
- Anonymous logger
- Name formatting using reference

**Solution:**

```php
function calculateTotal($items, $tax = 0.14) {
  $sum = 0;
  foreach ($items as $i) {
    $sum += $i['price'] * $i['qty'];
  }
  return $sum + ($sum * $tax);
}

$discount = fn($total, $percent = 10) => $total - ($total * $percent / 100);

$notify = function($msg) {
  echo "<div class='alert alert-info'>$msg</div>";
};

function formatUserName(&$name) {
  $name = ucfirst(strtolower($name));
}

$products = [
  ['price' => 100, 'qty' => 2],
  ['price' => 50, 'qty' => 1]
];
$total = calculateTotal($products);
$final = $discount($total);
$name = "AHMED";
formatUserName($name);
$notify("Thank you $name. Your final total is $final.");
```

---

### 🔸 Example: String Functions

```php
$name = "  ali ";
echo trim($name); // "ali"

$text = "welcome to php world!";
echo ucfirst($text); // Welcome to php world!

echo str_replace("php", "JavaScript", $text);
// welcome to JavaScript world!
```

---

### 🧪 Task: Text Analyzer Form

**Task:** Create a form input for a sentence. On submit, apply:

- `strlen`
- `str_replace` "bad" => "\*\*\*"
- `substr` first 10 characters
- `ucfirst`, `strtoupper`

**Solution:**

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $text = $_POST['text'] ?? '';
  echo "<p>Original: $text</p>";
  echo "<p>Length: " . strlen($text) . "</p>";
  echo "<p>Safe: " . str_replace("bad", "***", $text) . "</p>";
  echo "<p>First 10: " . substr($text, 0, 10) . "</p>";
  echo "<p>Capital: " . ucfirst($text) . "</p>";
  echo "<p>Uppercase: " . strtoupper($text) . "</p>";
}
```

---

## 🟩 Part 2: PHP File System (From Scratch)

### 🧠 Slide: Overview of Common PHP File System Functions

قبل ما نبدأ بالتاسكات العملية، تعالوا نستعرض أهم دوال نظام الملفات (File System) في PHP:

| Function               | Description                                     |
| ---------------------- | ----------------------------------------------- |
| `fopen()`              | فتح ملف للقراءة أو الكتابة                      |
| `fwrite()`             | كتابة نص داخل ملف مفتوح بـ `fopen()`            |
| `fclose()`             | إغلاق الملف بعد الانتهاء من الكتابة             |
| `file_put_contents()`  | كتابة نص كامل داخل ملف (طريقة مختصرة)           |
| `file_get_contents()`  | قراءة محتوى ملف كنص واحد                        |
| `file()`               | قراءة ملف كسطر لكل عنصر في array                |
| `mkdir()`              | إنشاء مجلد جديد                                 |
| `is_dir()`             | التحقق هل المسار مجلد                           |
| `file_exists()`        | التحقق من وجود الملف أو المجلد                  |
| `unlink()`             | حذف ملف                                         |
| `glob()`               | قراءة كل الملفات المطابقة لنمط معين داخل مجلد   |
| `basename()`           | استخراج اسم الملف من المسار الكامل              |
| `pathinfo()`           | استخراج معلومات عن الملف (الامتداد، الاسم...)   |
| `filesize()`           | الحصول على حجم الملف بالبايت                    |
| `move_uploaded_file()` | نقل الملف المرفوع من مكانه المؤقت إلى مكان دائم |
| `fputcsv()`            | كتابة صف من البيانات داخل ملف CSV               |

كل الدوال دي هنستخدمها خلال التاسكات القادمة لبناء مشروع File Manager بسيط متكامل.

### 📄 Task 1: Logging Visits

```php
$file = fopen("logs/visits.txt", "a");
fwrite($file, "Visited at " . date("Y-m-d H:i:s") . "\n");
fclose($file);
```

---

### 📄 Task 2: Display Log File in Table

```php
$lines = file("logs/visits.txt");
echo "<table class='table'><tr><th>#</th><th>Entry</th></tr>";
foreach ($lines as $i => $line) {
  echo "<tr><td>" . ($i+1) . "</td><td>$line</td></tr>";
}
echo "</table>";
```

---

### 📁 Task 3: Date-based Folder Creation

```php
$folder = "logs/" . date("Y-m-d_H-i");
if (!file_exists($folder)) mkdir($folder, 0777, true);
```

---

### 📤 Task 4: Secure Image Upload

```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $folder = "uploads/" . date("Y-m-d") . "/";
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  $fileName = time() . "_" . basename($_FILES['image']['name']);
  $fullPath = $folder . $fileName;

  $allowedTypes = ['image/jpeg', 'image/png'];
  if (in_array($_FILES['image']['type'], $allowedTypes)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
    echo "Image uploaded to: $fullPath";
  } else {
    echo "<div class='alert alert-danger'>Invalid file type</div>";
  }
}
```

---

### 🖼️ Task 5: Image Gallery in Cards

```php
$folder = "uploads/" . date("Y-m-d") . "/";
$images = glob($folder . "*.{jpg,png,jpeg}", GLOB_BRACE);

foreach ($images as $img) {
  echo "<div class='col-md-4'><div class='card mb-3'>";
  echo "<img src='$img' class='card-img-top'>";
  echo "</div></div>";
}
```

---

### 🗑️ Task 6: Delete Uploaded Files

```php
if (isset($_GET['delete'])) {
  $target = $_GET['delete'];
  if (file_exists($target)) {
    unlink($target);
    echo "Deleted $target";
  }
}
```

---

### 📊 Task 7: Export Student Grades to CSV

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $grade = $_POST['grade'];

  $folder = "exports/" . date("Y-m-d");
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  $file = fopen("$folder/students.csv", "a");
  fputcsv($file, [$name, $grade]);
  fclose($file);
  echo "Saved to CSV.";
}
```

---

### 📌 Task 8: Display File Info

```php
$folder = "uploads/" . date("Y-m-d") . "/";
$files = glob($folder . "*.*");

foreach ($files as $f) {
  $info = pathinfo($f);
  echo "<p>";
  echo "<strong>Name:</strong> " . basename($f) . " | ";
  echo "<strong>Type:</strong> " . $info['extension'] . " | ";
  echo "<strong>Size:</strong> " . filesize($f) . " bytes";
  echo "</p>";
}
```

---

## 🧩 Final Project: File Manager

Includes:

- Secure file upload with folder-by-date
- Log each visit
- Display uploaded images with Bootstrap
- Delete file via UI
- Export CSV from form input
- Display file info using `pathinfo()`
- Bootstrap UI for layout

