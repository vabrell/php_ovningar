<?php
$error = null;

if (isset($_POST['submit'])) {
  if ($_FILES['file']['error'] === 0) {
    $uploadOK = true;
    $dir = "uploads/";
    $file = $dir . basename($_FILES['file']['name']);

    if(!getimagesize($_FILES['file']['tmp_name'])) {
      $error = 'Filen är inte en bild';
      $uploadOK = false;
    } else if ($_FILES['file']['size'] > 100000) {
      $error = 'Bilden är för stor för att ladda upp';
      $uploadOK = false;
    } else if (file_exists($file)) {
      $error = 'Bilden finns redan';
      $uploadOK = false;
    } else if ($uploadOK) {
      move_uploaded_file($_FILES['file']['tmp_name'], $file);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ladda upp bild</title>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <p>
      <input type="file" name="file">
      <?php echo "<br>", $error; ?>
    </p>
    <input type="submit" name="submit" value="Ladda upp fil">
  </form>
</body>
</html>