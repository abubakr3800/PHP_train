
# 📘 Day 6 – Part 1: PHP Functions + String Built-in Functions

This part of the training covers the core concepts of PHP functions and practical string manipulation using built-in functions.

---

## ✅ Covered Topics

### PHP Functions:
- Named functions
- Arrow functions
- Anonymous functions
- Functions with default parameters
- Passing by reference

### String Functions:
- `strlen()`, `strtoupper()`, `strtolower()`, `ucfirst()`
- `trim()`, `str_replace()`, `strpos()`, `substr()`
- Combining string functions inside custom functions

---

## 🔸 Example: Multi-type Functions

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
echo $hello("Ali");
```

---

## 🧪 Task: Order Summary System

- `calculateTotal($items, $tax)`
- Arrow function to calculate discount
- Anonymous logger
- Reference function to fix name

---

## 🔸 Example: String Functions

```php
$name = "  ali ";
echo trim($name); // "ali"

$text = "welcome to php world!";
echo ucfirst($text); // Welcome to php world!

echo str_replace("php", "JavaScript", $text);
// welcome to JavaScript world!
```

---

## 🧪 Task: Text Analyzer Form

Form input:
- Text input from user
- On submit:
  - Apply `strlen`
  - `str_replace` specific word
  - `substr` first 10 characters
  - `ucfirst`, `strtoupper`

---

## 🔸 Final Integration Example

```php
function analyzeText($text) {
  $summary = [
    'original' => $text,
    'length' => strlen($text),
    'lower' => strtolower($text),
    'words' => explode(" ", $text),
    'safe' => str_replace("bad", "***", $text)
  ];
  return $summary;
}
```

> Integrate with HTML form for practice.
