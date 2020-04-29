<?php
$discs = [
  "Skiva 1" => rand(35*60, 72*60),
  "Skiva 2" => rand(35*60, 72*60),
  "Skiva 3" => rand(35*60, 72*60),
  "Skiva 4" => rand(35*60, 72*60),
  "Skiva 5" => rand(35*60, 72*60)
];

$time = array_sum($discs);

foreach ($discs AS $skiva => $disc) {
  $discTime= gmdate('i\m s\s');
  echo "$skiva, total tid: $discTime<br>";
}

echo "<br>Total speltid: ", gmdate('H\h i\m s\s', $time);