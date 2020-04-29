<?php

$date = new DateTime();

if (intval($date->format('i')) % 2 == 0) {
  echo 'even';
} else {
  echo 'odd';
}

echo "<br>";

$second = intval($date->format('s'));

if ($second >= 0 && $second <= 20) echo "0-20";
if ($second >= 21 && $second <= 40) echo "21-40";
if ($second >= 41 && $second <= 60) echo "41-60";
