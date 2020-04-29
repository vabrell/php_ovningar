<?php
if (isset($_POST['submit'])) {
  if ($_FILES['file']['error'] === 0) {
    $dir = "uploads/";
    $file = $dir . basename($_FILES['file']['name']);

    if (!file_exists($file)) {
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
  <title>Ladda upp fil</title>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Ladda upp fil">
  </form>
</body>
</html>