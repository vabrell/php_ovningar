<?php
$educations = ['Avancerad Webbdesign', 'CMS 1', 'Webbutveckling med JavaScript', 'PHP och Databaser', 'CMS 2', 'LIA 1', 'LIA 2', 'Examensarbete'];
sort($educations);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Europeiska länder</title>
</head>
<body>
  <?php
    foreach ($educations AS $education) {
      echo "<br><input type='checkbox' value='", $education, "'> ", $education;
    }
  ?>
</body>
</html>