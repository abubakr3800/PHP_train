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
echo greet($name);             // Welcome Sara!
echo $logger("logged in");     // [LOG] LOGGED IN
echo $hello("Ali");            // Hello Ali