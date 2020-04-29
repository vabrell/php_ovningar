<?php

$filename = 'content.txt';

$file = fopen($filename, 'r');

$content = '';
while (false !== ($char = fgetc($file))) {
  $content .= $char;
}

fclose($file);

echo "<pre>", $content, "</pre>";