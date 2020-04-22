<?php

$personer = [
  "Dr. Cooper",
  "Mrs. Dalloway",
  "Mr. Dalloway",
  "Dr. Mabuse",
  "Col. Stephens",
  "Dr. Ashcroft"
];

$list = '';

foreach ($personer as $person) {
  if (($namn = explode(' ', $person))[0] === 'Dr.') {
    $namn[1] = strtolower($namn[1]);
    $list .= "<li>{$namn[0]} {$namn[1]}</li>";
  } else {
    $list .= "<li>$person</li>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diagnostiskt test - Grunder i PHP</title>
</head>

<body>
  <ul><?php echo $list ?></ul>
</body>

</html>