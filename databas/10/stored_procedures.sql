-- Jobba med din zoo-databas och tabellen animals. Skapa en view som visar alla däggdjur.
CREATE VIEW mamals AS
SELECT animals.name, categories.category
FROM animals
JOIN categories ON categories.id = animals.category_id
WHERE animals.category_id = (
    SELECT id FROM categories
    WHERE category = 'Däggdjur'
);

-- Skapa en view som visar alla djur vars namn slutar på -a. Prova sedan att ändra namnet på ett av dessa djur för att se om din view uppdateras.
CREATE VIEW ends_with_a AS
SELECT name FROM animals
WHERE name LIKE '%a';

-- Skapa en procedure som flyttar alla djur som finns i area 2 till area 3.
DELIMITER $$

CREATE PROCEDURE move_to_area_2()
BEGIN
    UPDATE animals
    SET animals.area_id = 3
    WHERE animals.area_id = 2;
END $$

DELIMITER ;

CALL move_to_area_2();

-- Skapa en procedure som flyttar alla djur från en area till en annan. Låt proceduren ta emot två argument (den area som djuren finns i,respektive den area dit de ska).
DELIMITER $$

CREATE PROCEDURE change_area (`from` INT, `to` INT)
BEGIN
    UPDATE animals
    SET animals.area_id = `to`
    WHERE animals.area_id = `from`;
END $$

DELIMITER ;
-- Skapa en function som returnerar antalet specimen för en viss kategori djur. Kategorin ska skickas med som ett argument.
SET GLOBAL log_bin_trust_function_creators = 1;
DELIMITER $$

CREATE FUNCTION `total_specimens` (cat VARCHAR(50))
RETURNS INT
NOT DETERMINISTIC
BEGIN
    DECLARE total INT;
    SET total = (
        SELECT SUM(specimens)
        FROM animals
        WHERE category_id = (
            SELECT id FROM categories
            WHERE category = cat
        )
    );
    RETURN total;
END $$

DELIMITER ;