<?php

require('Database.php');
$db = new Database;

if (isset($_POST['addAnimal'])) {
    $sql = "INSERT INTO 
            animals (name, specimens, category_id, area_id)
            VALUES (:name, :specimens, :category, :area)";

    $stmt = $db->conn()->prepare($sql);

    extract($_POST);

    $stmt->execute([
        ":name" => filter_var($name, FILTER_SANITIZE_STRING),
        ":specimens" => filter_var($specimens, FILTER_SANITIZE_NUMBER_INT),
        ":category" => filter_var($category, FILTER_SANITIZE_NUMBER_INT),
        ":area" => filter_var($area, FILTER_SANITIZE_NUMBER_INT),
    ]);
}

$animal_sql = "SELECT a.name, a.specimens, c.category, b.name as area
                FROM animals a
                JOIN areas b ON b.id = a.area_id
                JOIN categories c ON c.id = a.category_id
";

$animals = $db->conn()->query($animal_sql)->fetchAll();
$categories = $db->conn()->query('SELECT * FROM categories')->fetchAll();
$areas = $db->conn()->query('SELECT * FROM areas')->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo</title>
    <style>
        table td {
            padding: .5rem 1rem;
        }
    </style>
</head>

<body>
    <h2>Djurpark</h2>

    <form method="post">
        <h3>Lägg till nytt djur</h3>
        <div>
            <label for="name">Namn</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="specimens">Antal djur</label>
            <input type="number" name="specimens" id="specimens">
        </div>
        <div>
            <label for="category">Kategori</label>
            <select name="category" id="category">
                <option disabled selected>-- Välj kategori --</option>
                <?php
                foreach ($categories as $category) {
                    echo "<option value='$category->id'>$category->category</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="area">Area</label>
            <select name="area" id="area">
                <option disabled selected>-- Välj area --</option>
                <?php
                foreach ($areas as $area) {
                    echo "<option value='$area->id'>$area->name</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" name="addAnimal" value="Lägg till">
    </form>

    <h3>Parkens djur</h3>
    <table>
        <tr>
            <th>Djur</th>
            <th>Antal</th>
            <th>Kategori</th>
            <th>Area</th>
        </tr>
        <?php
            foreach ($animals as $animal) {
                echo "<tr>";
                echo "<td>$animal->name</td>";
                echo "<td>$animal->specimens</td>";
                echo "<td>$animal->category</td>";
                echo "<td>$animal->area</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>

</html>