<?php
class User {
  private $username;
  private $password;
  private $role;
  private $email;

  public function __construct(String $username, String $password, String $role, String $email) {
    $this->username = $username;
    $this->password = $password;
    $this->role = $role;
    $this->email = $email;
  }

  public function get($property) {
    return $this->$property;
  }

  public function set($property, $value) {
    $this->$property = $value;
  }
}

$user = new User('victor', 'password', 'admin', 'victor@abrell.se');

echo $user->get('username'), "<br>roll: ", $user->get('role');

echo "<br><br>Byt lösenord", "<br>Nuvarade: ", $user->get('password');
$user->set('password', 'nyttlösenord');
echo "<br>Nytt: ", $user->get('password');