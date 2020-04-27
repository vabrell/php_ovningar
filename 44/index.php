<?php

if (isset($_POST['submit'])) {
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

  $date = new DateTime;
  $datetime = $date->format('Y-m-d_H.i.s');
  $filename = "{$datetime}_$name.txt";

  $file = fopen($filename, 'w');
  fwrite($file, $message . PHP_EOL);
  fclose($file);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skicka ett meddelande</title>
</head>
<body>
  <form method="post">
  <div>
    <label for="name">Namn</label>
    <input type="text" id="name" name="name">
  </div>
  <div>
    <label for="message">Meddelande</label>
    <textarea name="message" id="message" cols="30" rows="5"></textarea>
  </div>

  <input type="submit" value="Send" name="submit">
  </form>
</body>
</html>