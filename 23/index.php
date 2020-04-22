<?php
$countries = ['Sverige', 'Norge', 'Danmark', 'Island', 'Tyskland'];
sort($countries);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Europeiska länder</title>
</head>
<body>
  <select name="contries">
    <?php
      foreach ($countries AS $country) {
        echo "<option value='", $country, "'>", $country, "</option>";
      }
    ?>
  </select>
</body>
</html>