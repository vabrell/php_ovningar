<?php

function loginForm($name) {
  $form = <<<HTML
<form method="post">
  <label for="name">Namn</label>
  <input type="text" name="name" value="$name"> 

  <label for="password">Lösenord</label>
  <input type="password" name="password">

  <input type="submit" name="submit" value="Logga in">
</form>
<p>Har du inget konto kan du registrera dig, <a href="register.php">här</a>.
HTML;

return $form;
}

function registerForm($name, $age, $education) {
  $educations = ['Avancerad Webbdesign', 'CMS 1', 'Webbutveckling med JavaScript', 'PHP och Databaser', 'CMS 2', 'LIA 1', 'LIA 2', 'Examensarbete'];
  sort($educations);

  $edus = '';
  foreach ($educations AS $educ) {
    $selected = $educ === $education ? 'selected' : '';
    $edus .= "<option value='$educ' $selected>$educ</option>";
  }
  $form = <<<HTML
<form method="post">
  <div>
    <label for="name">Namn</label>
    <input type="text" name="name" value="$name"> 
  </div>

  <div>
    <label for="password">Lösenord</label>
    <input type="password" name="password">
  </div>

  <div>
    <label for="age">Ålder</label>
    <input type="text" name="age" value="$age"> 
  </div>

  <div>
    <label for="education">Kurs</label>
    <select name="education">
      <?php echo $edus ?>
    </select>
  </div>

  <input type="submit" name="submit" value="Registrera">
</form>
HTML;

return $form;
}