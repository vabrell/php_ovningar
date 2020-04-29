<?php
session_start();
require 'Users.php';
$users = new Users;
$errors = [];
$user = $users->getLoggedInUser();

if (isset($_POST['login'])) {
    // Sanitize the input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

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

    // Verify email and password
    if (count($errors) < 1 && !$users->login($email, $password)) {
        $errors['login'] = 'E-posten eller lösenordet är fel.';
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
    <?php if (!$user) { ?>
        <form method="post">
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
            <?php if (isset($errors['login'])) { ?>
                <p class="error"><?php echo $errors['login'] ?></p>
            <?php } ?>

            <input type="submit" value="Logga in" name="login">
        </form>
        <a href="register.php">Registrera dig här</a>
    <?php } else { ?>
        <h3>Välkommen tillbaka <?php echo $user->name ?></h3>
        <a href="logout.php">Logga ut</a>
    <?php } ?>
</body>

</html>