
# 📘 Day 6 – Part 2: PHP File System (From Scratch)

This section introduces the file system in PHP from the ground up with real-world examples and structured exercises.

---

## ✅ Covered Concepts

- What is File System in PHP?
- Writing to files using `fopen`, `fwrite`, `file_put_contents`
- Reading files using `file`, `file_get_contents`
- Creating folders with `mkdir()`
- Uploading files securely with `$_FILES`
- Filtering file types (e.g., images only)
- Displaying files in Bootstrap layout
- Deleting files with `unlink()`
- Exporting CSV data
- Reading file info with `basename`, `pathinfo`, `filesize`

---

## 🔸 Examples & Tasks

### 📄 Task 1: Logging Visits

Create a folder `logs/` and store a timestamp entry in `visits.txt` on every visit.

```php
$file = fopen("logs/visits.txt", "a");
fwrite($file, "Visited at " . date("Y-m-d H:i:s") . "\n");
fclose($file);
```

---

### 📄 Task 2: Show File Lines in Table

Read `users.txt` using `file()` and display each line in a Bootstrap table.

---

### 📁 Task 3: Create Date-based Folder

```php
$folder = "logs/" . date("Y-m-d_H-i");
if (!file_exists($folder)) mkdir($folder, 0777, true);
```

---

### 📤 Task 4: Upload Image to Dated Folder

Use `$_FILES` to upload JPG or PNG to a folder named `uploads/YYYY-MM-DD/`. Reject other types.

---

### 🖼️ Task 5: Show Uploaded Images in Cards

Use `glob()` to read images from today's folder and display them in 3-column Bootstrap grid using `col-md-4`.

---

### 🗑️ Task 6: Delete Image on Button Click

Each displayed image includes a delete button that uses `unlink()` to remove the file from disk.

---

### 📊 Task 7: Export Student Data as CSV

User inputs `name` and `grade` via form and appends data to `exports/YYYY-MM-DD/students.csv`.

```php
fputcsv($file, [$name, $grade]);
```

---

### 📌 Task 8: Show File Info

Read all image files in `uploads/`, then display:
- `basename()`
- `filesize()`
- `pathinfo()['extension']`

---

## 🧩 Final Project: Mini File Manager

Includes:
- Uploading and validating images
- Logging user visits
- Displaying uploaded files with delete option
- Exporting CSV data
- All styled using Bootstrap 5

