<?php

require 'App/bootstrap.php';

use App\Road;
use App\Driver;
use App\Map;

$route = '';
$next = $_POST['next'] ?? '';
$car = '';
$planned = '';

$road = new Road;
$driver = new Driver;

if (!Road::exists()) {
    $road->generate();
    header('Location: ./');
}

if (isset($_POST['drive'])) {
    $result = $driver->planDrive()->drive();
    $planned = $road->getStretchesByName($driver->plannedRoute);
    $planned = array_map(function ($stretch) {
        return ucfirst($stretch);
    }, $planned);
    $planned = implode(', ', $planned);
}

$map = new Map;

if (isset($_POST['new_road'])) {
    $road->remove();
    $map->remove();
    $driver->remove();
    header('Location: ./');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c253d5ef44.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }

        input[type=submit] {
            border: 2px solid rgb(42, 35, 82);
            border-radius: 1rem;
            background-color: rgb(255, 255, 255);
            color: rgb(42, 35, 82);
            padding: .4rem .8rem;
            font-size: 1rem;
            font-weight: bold;
        }

        input[type=submit]:hover {
            background-color: rgb(42, 35, 82);
            color: rgb(255, 255, 255);
        }

        h1 {
            color: rgb(42, 35, 82);
        }

        .icon {
            font-size: 4rem;
            color:rgb(42, 35, 82);
        }
    </style>
</head>

<body>
    <h1>Driver - one driver, one car and many crashes</h1>
    
    <form method="post">
    <?php if ($map->exists() && count($map->getMap()) === 12) { ?>
        <input type="submit" name="new_road" value="New road">
    <?php } else { ?>
        <input type="submit" name="drive" value="Drive">
    <?php } ?>
    </form>

    <p><strong>Planned route:</strong> <?php echo $planned ?></p>
    <?php if (!empty($result)) { ?>
    <p><i class="fas fa-<?php echo $result ?> icon"></i></p> 
    <?php } ?>
</body>

</html>