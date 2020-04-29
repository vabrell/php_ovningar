<?php

$filename = 'content.txt';

$file = fopen($filename, 'r');

$content = fread($file, filesize($filename));

fclose($file);

echo $content;