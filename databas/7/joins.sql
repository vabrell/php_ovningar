-- Skapa en ny tabell i databasen zoo. Kalla den nya tabellen categories och låt den ha två kolumner (id INT PRIMARY KEY AUTO_INCREMENT, category VARCHAR(30).
CREATE TABLE categories (id INT PRIMARY KEY AUTO_INCREMENT, category VARCHAR(30));

-- När du gjort detta kan du skriva en query som hämtar värden från en tabell och sparar dem i en annan. Detta kan du göra med query-formen INSERT INTO SELECT:https://dev.mysql.com/doc/refman/8.0/en/insert-select.html I INSERT-delen av queryn ska du ange vilken eller vilka kolumner som ska få värden, och i SELECT del en väljer du ut de distinkta värdena som finns i animals-tabellens kolumn Category.
INSERT INTO categories (category) SELECT DISTINCT category FROM animals;

-- Därefter ändrar du i animals-tabellen, så att den får ytterligare en kolumn som heter category_id (INT). Detta kan du antingen göra via struktur-fliken i PHPMyAdmin eller genom att skriva en query i SQL-fliken. Den queryen ska i så fall skrivas som det beskrivs i https://dev.mysql.com/doc/refman/8.0/en/alter-table.html
ALTER TABLE animals ADD (category_id INT);

-- Nu är det dags att koppla ihop de båda tabellerna. Det värde som finns i categories.id (punkt notation är det vi använder i SQL för att beskriva tabell.kolumn) är det som ska lagras i animals.categories_id, och det kommer senare att vara det som kopplar ihop tabellerna. För att få fram rätt värde måste vi se till att alla rader i tabellen animals som har “Däggdjur” i category ska matchas mot värdet “Däggdjur” i tabellen categories category-column. Du behöver förmodligen använda en subquery för att hämta ett id-värde där categories.category = animals.category.
UPDATE animals SET category_id = (SELECT categories.id FROM categories WHERE categories.category = animals.category);

-- Avsluta med att ta bort kolumnen “category” från tabellen “animals”. Det kan du göra antingen via PHPMyAdmin eller genom att skriva “ALTER TABLE animals DROP...”
ALTER TABLE animals DROP category;

-- Nu ska tabellerna vara sammankopplade. Man kan säga att denna sammankoppling är “lös”, eftersom den inte utnyttjar SQLs inbyggda funktioner kring relationer, men det bryr vi oss inte om just nu. Problemet för oss just nu är att en del nödvändig information har flyttats från animals till categories. Skriv en query som skriver ut en lista på alla djur, med information om vilken kategori de tillhör, något som kommer att kräva en JOIN mellan tabellerna.​ https://dev.mysql.com/doc/refman/8.0/en/join.html
SELECT name, specimens, category FROM animals
JOIN categories ON categories.id = animals.category_id;

-- Vi har ingen information om i vilken avdelning av djurparken som våra djur finns. Skapa en tabell som heter “areas” med kolumnerna (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30))
CREATE TABLE areas (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30));

-- Därefter lägger du till data i den tabellen (“Djungeln”, “Havet”, “Insjön”, “Terrariet”, “Savannen” och “Övrigt” (Grymt, men vi har inte hela dagen på oss...)
INSERT INTO areas (name) VALUES ('Djungeln'), ('Havet'), ('Insjön'), ('Terrariet'), ('Savannen'), ('Övrigt');

-- Ändra sedan i animals-tabellen så att den har en area_id-kolumn, och skriv sedan in lämpliga värden där för varje djurart (Komodovaranen vill vara i terrariet,elefanten på savannen etc.)
ALTER TABLE animals ADD (area_id INT);
UPDATE animals SET area_id = 1 WHERE id = 8;
UPDATE animals SET area_id = 2 WHERE id IN (6, 12, 15);
UPDATE animals SET area_id = 3 WHERE id IN (4, 13);
UPDATE animals SET area_id = 4 WHERE id IN (5, 10, 11);
UPDATE animals SET area_id = 5 WHERE id IN (1, 2, 7);
UPDATE animals SET area_id = 6 WHERE id IN (3, 9, 14);

-- När allt detta är klart skriver du en query som skriver ut en lista på djur (namn,category och area). I och med att du hämtar data från två olika tabeller (förutom animals), så måste du göra två JOINS.
SELECT animals.name, category, areas.name FROM animals
JOIN categories ON categories.id = animals.category_id
JOIN areas ON areas.id = animals.area_id;

-- Skriv en query som hämtar information om vilka djur samt det totala antalet som finns i area “Djungeln”.
SELECT GROUP_CONCAT(animals.name) AS animals, SUM(animals.specimens) AS Total FROM animals WHERE area_id = (SELECT areas.id FROM areas WHERE name = 'Djungeln');

-- Skriv en query som hämtar namn och category för alla djur som finns i arean “Övrigt” och sorterar dem fallande utifrån category, därefter namn (också fallande)
SELECT name, category FROM animals
JOIN categories ON categories.id = animals.category_id
WHERE area_id = (SELECT id FROM areas WHERE name = 'Övrigt')
ORDER BY category DESC, name DESC;