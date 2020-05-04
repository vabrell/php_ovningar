-- Skriv en query som bara skriver ut namnen på djuren.
SELECT name FROM animals;

-- Skriv en query som skriver ut alla kategorier och antalet specimens(det är OK med dubletter).
SELECT category, SUM(specimens) FROM animals GROUP BY category;

-- Skriv en query som listar all djur sorterade fallande efter antal specimens.
SELECT * FROM animals ORDER BY specimens DESC;

-- Skriv en query som listar alla djur, sorterade i första hand fallande efter katergori och i andra hand fallande efter namn.
SELECT * FROM animals ORDER BY category DESC, name DESC;

-- Skriv ut namn och antal för alla djur som har specimen-värde längre eller lika med 10.
SELECT name, specimens FROM animals WHERE specimens >= 10;

-- Skriv en query som listar alla djur, men så att resultatet (svaret på queryn) kommer i form av en kolumn som heter "info" och har innehåll i formatet "Elefant (däggdjur)".
SELECT CONCAT(name, ' (', category, ')') AS info FROM animals;

-- Skriv ut alla djur vars namn börjar på "k".
SELECT name FROM animals WHERE name LIKE 'k%';

-- Skriv ut alla djur vars namn slutar med "a".
SELECT name FROM animals WHERE name LIKE '%a';

-- Skriv ut alla djur vars namn innehåller "ba".
SELECT name FROM animals WHERE name LIKE '%ba%';

-- Skriv ut alla djurnamn sorterat efter längden på deras namn
SELECT name FROM animals ORDER BY LENGTH(name);

-- Skriv ut alla djur som har ett namn som innehåller "om" OCH har fler än 10 specimens.
SELECT name FROM animals WHERE name LIKE '%om%' AND specimens > 10;

-- Skriv ut alla djur som har fler än 5 specimens ELLER är fåglar.
SELECT name FROM animals WHERE specimens > 5 OR category = 'fågel';

-- Skriv ut alla djur som har ett specimen värde som är antingen 0, 2 eller 12.
SELECT name FROM animals WHERE specimens IN (0, 2, 12);

-- Skriv ut en lista på de värden som finns i kategori-kolumnen.
SELECT DISTINCT category FROM animals;