<?php
session_start();
$link = '';
if (isset($_SESSION['user']) && $_SESSION['user']) {
  $link = '<a href="secret.php">Hemlig sida</a>';
}
if (isset($_POST['submit'])) {
  if ($_POST['username'] === 'victor'
      && $_POST['password'] === 'password') {
        $date = new DateTime();

        $_SESSION['user'] = [
          'user' => $_POST['username'],
          'datetime' => $date->format('H:i:s')
        ];

        header('Location: ./');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logga in</title>
</head>
<body>
  <form method="post">
    <label for="username">Användarnamn</label>
    <input type="text" name="username" value="<?php echo $_POST['username'] ?? '' ?>"> 

    <label for="password">Lösenord</label>
    <input type="password" name="password">

    <input type="submit" name="submit" value="Logga in">
  </form>

  <h3><?php echo $link ?></h3>
  
</body>
</html>