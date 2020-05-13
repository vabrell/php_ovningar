<?php

require('Database.php');
$db = new Database;

$db->conn()->query("INSERT INTO animals (name, specimens, category_id, area_id) VALUES ('Gris', 32, 1, 1)");