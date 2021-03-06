<?php

require('Database.php');
$db = new Database;

$animal_id = 1;

$sql = "SELECT * FROM animals WHERE id = :id";

$stmt = $db->conn()->prepare($sql);

$stmt->execute([
    ":id" => $animal_id
]);

$animal = $stmt->fetch(PDO::FETCH_OBJ);

echo "<p>$animal->name</p>";