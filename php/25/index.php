<?php
session_start();
if (!empty($_SESSION['user'])) {
  $session = $_SESSION['user']['name'];
  $user = $_SESSION[$session];
  $message = "Välkommen tillbaka <strong>{$user['name']}!</strong>";
  $name = ucfirst($user['name']);
  $message .= "<br><p><strong>Namn:</strong> {$name}<br>";
  $message .= "<strong>Ålder:</strong> {$user['age']}<br>";
  $message .= "<strong>Kurs:</strong> {$user['education']}<p>";
} else {
  $message = "Du måste logga in för att kunna komma åt den kurser, <a href='login.php'>logga in här</a>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kurser</title>
</head>
<body>
  <h2>Kurser</h2>
  <p><?php echo $message ?></p>
  <?php if (!empty($_SESSION['user'])) { ?>
    <p>
      <a href="logout.php">Logga ut</a>
    </p>
  <?php } ?>
</body>
</html>