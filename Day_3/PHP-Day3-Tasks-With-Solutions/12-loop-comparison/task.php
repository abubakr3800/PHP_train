<?php
$names = ["Ali", "Mona", "Hassan"];

echo "Using for:<br>";
for ($i = 0; $i < count($names); $i++) {
  echo $names[$i] . "<br>";
}

echo "<br>Using while:<br>";
$i = 0;
while ($i < count($names)) {
  echo $names[$i] . "<br>";
  $i++;
}

echo "<br>Using foreach:<br>";
foreach ($names as $name) {
  echo $name . "<br>";
}
