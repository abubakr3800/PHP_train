<?php
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
echo greet($name) . "<hr>";             // Welcome Sara!
echo $logger("logged in") . "<hr>";     // [LOG] LOGGED IN
echo $hello("Ali") . "<hr>";            // Hello Ali

?>
