<?php
include 'functions.php';
session_start();
$name = '';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];

  if (!empty($_SESSION[$name])) {
    if ($name === $_SESSION[$name]['name']
        && $_POST['password'] === $_SESSION[$name]['password']) {
          $date = new DateTime();

          $_SESSION['user'] = [
            'name' => $name,
            'datetime' => $date->format('H:i:s')
          ];

          header('Location: ./');
    } else {
      echo 'Fel lösenord';
    }
  } else {
    echo 'Användaren finns inte';
  }
}

echo loginForm($name);