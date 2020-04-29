<?php
session_start();
require 'Users.php';
$users = new Users;

if (isset($_POST['register'])) {
    // Sanitize the input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    // Check if the name is supplied
    if (empty($name)) {
        $errors['name'] = 'Namn måste fyllas i.';
    }

    // Check if the email is supplied
    if (empty($email)) {
        $errors['email'] = 'E-post måste fyllas i.';
    }

    // Check if the password is supplied
    if (empty($password)) {
        $errors['password'] = 'Lösenord måste fyllas i.';
    }

    // Check if the email is valid
    if (isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'E-posten är inte en giltig e-post.';
    }

    // If all checks pass; add the user
    if (count($errors) < 1) {
        $users->store([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salt password</title>
    <style>
        .error {
            color: red;
            margin-top: -2px;
        }
    </style>
</head>
<body>
    <form method="post">
        <div>
            <label for="name">Namn</label>
            <input type="text" name="name" id="name">
            <?php if (isset($errors['name'])) { ?>
            <p class="error"><?php echo $errors['name'] ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="email">E-post</label>
            <input type="email" name="email" id="email">
            <?php if (isset($errors['email'])) { ?>
            <p class="error"><?php echo $errors['email'] ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="password">Lösenord</label>
            <input type="password" name="password" id="password">
            <?php if (isset($errors['password'])) { ?>
            <p class="error"><?php echo $errors['password'] ?></p>
            <?php } ?>
        </div>

        <input type="submit" value="Registrera" name="register">
    </form>
</body>
</html>