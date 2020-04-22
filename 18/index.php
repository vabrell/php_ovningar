<?php
$text = null;

if (isset($_POST['submit'])) {
  $text = "{$_POST['name']} skrev in lösenord '{$_POST['password']}'.";
  $sex = $_POST['sex'] === 'man' ? 'Han' : 'Hon';
  $sexes = $_POST['sex'] === 'man' ? 'Hans' : 'Hennes';
  $animals = '';
  foreach ($_POST['animals'] AS $index => $animal) {
    if ($index > 0 && $index !== count($_POST['animals']) - 1) {
      $animals .= ', ';
    }

    if (count($_POST['animals']) > 1 && $index === count($_POST['animals']) - 1) {
      $animals .= ' och ';
    }

    $animals .= "en $animal";
  }
  $text .= "<br>$sex har $animals.";
  $text .= "<br>$sexes favoritmat är {$_POST['food']}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrering</title>
</head>
<body>
  <form method="post">
    <div>
      <label for="name">Namn</label>
      <input type="text" name="name"> 
    </div>

    <div>
      <label for="password">Lösenord</label>
      <input type="password" name="password">
    </div>

    <div>
      <label for="animals">Husdjur</label>
      <input type="checkbox" name="animals[]" value="katt"> Katt
      <input type="checkbox" name="animals[]" value="hund"> Hund
      <input type="checkbox" name="animals[]" value="fisk"> Fisk
    </div>

    <div>
      <label for="sex">Kön</label>
      <input type="radio" name="sex" value="kvinna"> Kvinna
      <input type="radio" name="sex" value="man"> Man
    </div>

    <div>
      <label for="food">Favoritmat</label>
      <select name="food">
        <option selected disabled>-- Välj --</option>
        <option value="pizza">Pizza</option>
        <option value="tacos">Tacos</option>
        <option value="thai">Thai</option>
      </select>
    </div>

    <input type="submit" name="submit" value="Skicka">
  </form>

  <h3><?php echo $text ?></h3>
</body>
</html>