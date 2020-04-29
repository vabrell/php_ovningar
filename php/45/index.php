<?php

$filename = 'boye.csv';

$file = file($filename);

$FILE = fopen($filename, 'r');

while(!feof($FILE)) {
  $csv[] = fgetcsv($FILE);
}

fclose($FILE);

print_r($file);

echo "<br><br>";

print_r($csv);