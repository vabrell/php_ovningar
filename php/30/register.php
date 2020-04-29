<?php
include 'functions.php';
session_start();
$name = '';
$age = '';
$education = '';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $education = $_POST['education'];

  if (!empty($name)
      && !empty($_POST['password'])
      && !empty($age)
      && !empty($education)) {
        $date = new DateTime();

        $salt = $date->format('U');
        $hash = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT);
        
        $_SESSION[$name] = [
          'name' => $name,
          'password' => $hash,
          'salt' => $salt,
          'age' => $age,
          'education' => $education,
          'datetime' => $date->format('H:i:s')
        ];

        header('Location: login.php');
      }
}

echo registerForm($name, $age, $education);