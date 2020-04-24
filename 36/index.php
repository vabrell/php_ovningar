<?php

class User {
  private $username;
  private $password;

  public function __construct(String $username, String $password) {
    $this->username = $username;
    $this->password = $password;
  }

  public function get($property) {
    return $this->$property;
  }

  public function set($property, $value) {
    $this->$property = $value;
  }

  static function loginForm() {
    return "<form method='POST'>
              <div>
                <label for='username'>Användarnamn</label>
                <input type='text' name='username' id='username'>
              </div>

              <div>
                <label for='password'>Lösenord</label>
                <input type='password' name='password' id='password'>
              </div>

              <input type='submit' name='submit' value='Login'>
            </form>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <?php echo User::loginForm() ?>
</body>
</html>