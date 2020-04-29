<?php

$jag = "Abrell";
$du = "Andersson";

$length = strlen($jag);

$counter = 0;

for ($i = 0; $i < $length; $i++) {
  if ($jag[$i] === $du[$i]) {
    $counter++;
  }
}

echo "Jämför $jag och $du<br><br>";
echo "Antal lika tecken: $counter";