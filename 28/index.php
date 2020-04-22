<?php
function rollDice() {
  $dice = [];

  for ($i = 0; $i < 6; $i++) {
    $dice[] = rand(1, 6);
  }

  return $dice;
}

function checkDice($dice) {
  $diceRolled = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0
  ];

  $results = [
    'yatzy' => [],
    'quadruplet' => [],
    'triplets' => [],
    'pair' => []
  ];

  $points = 0;
  $wtype = 'Inget';

  foreach ($dice AS $die) {
    $diceRolled[$die]++;
  }

  foreach ($diceRolled AS $die => $dice) {
    switch($dice) {
      case 2:
        $results['pair'][] = $die;
      break;

      case 3:
        $results['triplets'][] = $die;
      break;

      case 4:
        $results['quadruplet'][] = $die;
      break;

      case 6:
        $results['yatzy'][] = $die;
      break;
    }
  }

  foreach ($results AS $type => $result) {
    if (count($result) > 0) {
      $die = max($result);
      switch($type) {
        case 'pair':
          $points = $die * 2;
          $wtype = $type;
        break;

        case 'triplets':
          $points = $die * 3;
          $wtype = $type;
        break;

        case 'quadruplet':
          $points = $die * 4;
          $wtype = $type;
        break;

        case 'yatzy':
          $points = 50;
          $wtype = $type;
        break;
      }
    }
  }

  return [
    "type" => $wtype,
    "points" => $points
  ];
}

if (isset($_POST['roll'])) {
  $dice = rollDice();
  $result = checkDice($dice);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yatzy</title>
</head>
<body>
  <h1>Yatzy</h1>
  <?php if (isset($_POST['roll'])) { ?>
    <p><strong>Tärningar:</strong> <?php echo implode(", ", $dice) ?></p>
    <p><strong>Resultat:</strong> <?php echo $result['type'] ?></p>
    <p><strong>Poäng:</strong> <?php echo $result['points'] ?></p>
  <?php } ?>

  <form method="post">
    <input type="submit" name="roll" value="Rulla tärningar">
  </form>
</body>
</html>