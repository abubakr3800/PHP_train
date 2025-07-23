<?php
$name = "  ali           ";
// echo $name . "<br>";
// echo trim($name); // "ali"

echo "<hr/>";

$text = "welcome to php world!";
echo substr($text , 0, 7); // Welcome to php world!
echo "<br>";
echo ($text ); // Welcome to php world!
// echo "<br>";
// echo ucfirst($text); // Welcome to php world!

// echo "<hr/>";

// echo ($text); // Welcome to php world!
// echo "<br>";
// echo str_replace("php", "JavaScript", $text); // welcome to JavaScript world!


// echo "<hr/>";

// $script = "<a href='hacked.php'><strong>click here</strong></a>";
// echo ($script); // click here clickable link with bold text
// echo "<br/>";
// echo strip_tags($script); // <a href='hacked.php'>click here </a>
// echo "<br/>";
// echo strip_tags($script, '<strong>'); // click here )(removes any tag but skip the strong tag)
// echo "<br/>";
// echo htmlspecialchars($script); // print a tag as a plain text <a href='hacked.php'><strong>click here</strong></a>
// echo "<br/>";

// echo "<hr/>";