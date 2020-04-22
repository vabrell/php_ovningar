<?php
$greeting = null;
if (isset($_POST['submit'])) {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === 'victor' && $_POST['password'] === 'password') {
      $greeting = 'Godkänd';
    } else {
      $greeting = 'Ej välkommen';
    }
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skicka data</title>
</head>
<body>
  <h1><?php echo $greeting ?></h1>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="username">Användarnamn</label>
    <input type="text" name="username" value="<?php echo $_POST['username'] ?? '' ?>">

    <label for="password">Lösenord</label>
    <input type="password" name="password">

    <input type="submit" name="submit" value="Logga in">
  </form>
</body>
</html>