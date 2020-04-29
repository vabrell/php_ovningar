<?php

$path = 'content.txt';
$content = '';

if (isset($_POST['submit'])) {
  $file = fopen($path, 'a');

  fwrite($file, $_POST['message'] . PHP_EOL);

  fclose($file);
}

if (file_exists($path)) {
  $file = fopen($path, 'r');

  $content = fread($file, filesize($path));

  fclose($file);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Write to file</title>
</head>
<body>
  <form method="post">
    <label for="message">Meddelande</label>
    <input type="text" id="message" name="message">

    <input type="submit" name="submit" value="Submit">
  </form>

  <p>
    <pre><?php echo $content ?></pre>
  </p>
</body>
</html>