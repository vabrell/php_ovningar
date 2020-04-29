<?php

$filename = '../42/content.txt';


// Read whole file
$FILE = fopen($filename, 'r');
$fread = fread($FILE, filesize($filename));
fclose($FILE);

// Read lines and return string
$FILE = fopen($filename, 'r');
$fgets = '';
while (($buffer = fgets($FILE, 4096)) !== false) {
  $fgets .= $buffer;
}
fclose($FILE);

// Read lines and return array
$file = file($filename);

echo $fread, "<br><br>", $fgets, "<br><br>", print_r($file);
