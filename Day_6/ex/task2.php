<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $text = $_GET['text'] ?? '';
  echo "<p>Original: $text</p>";
  echo "<p>Length: " . strlen(trim($text)) . "</p>";
  echo "<p>Safe: " . str_replace("bad", "***", $text) . "</p>";
  echo "<p>Very Safe: " . str_replace("bad", "***", strtolower($text)) . "</p>";
  echo "<p>First 10: " . substr($text, 0, 10) . "</p>";
  echo "<p>Capital: " . ucfirst(trim($text)) . "</p>";
  echo "<p>Uppercase: " . strtoupper($text) . "</p>";
  echo "<p>original: " . ($text) . "</p>";
}