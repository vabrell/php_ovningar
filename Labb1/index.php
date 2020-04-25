<?php

require 'App/bootstrap.php';

use App\Road;
use App\Driver;
use App\Map;

$route = '';
$next = $_POST['next'] ?? '';
$result = null;
$planned = '';

$road = new Road;
$driver = new Driver;

if (!Road::exists()) {
  $road->generate();
  header('Location: ./');
}

if (isset($_POST['drive'])) {
  $result = $driver->planDrive()->drive();
  $planned = implode(', ', $road->getStretchesByName($driver->plannedRoute));
}

if (!Map::exists()) {
  $route = "This is the first stretch of road, I'll have to guess.";
}

$map = new Map;

if (isset($_POST['new_road'])) {
  $road->removeRoad();
  $map->removeMap();
  header('Location: ./');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Driver</title>
</head>
<body>
  <h1>Driver - one driver, one car and many crashes</h1>
  <p><strong>Planned route:</strong> <?php echo $planned ?></p>
  <p><strong>Result:</strong> <?php echo $result ?></p>
  <form method="post">


  <?php if ($map->exists() && count($map->getMap()) === 12) { ?>
    <input type="submit" name="new_road" value="New road">
  <?php } else { ?>
    <input type="submit" name="drive" value="Drive">
  <?php } ?>
  </form>
</body>
</html>