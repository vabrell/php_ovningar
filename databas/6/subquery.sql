-- Ta reda på hur många specimens det finns av djur som börjar på bokstaven “M”. Skriv först en subquery som ger dig dessa djur (samt alla deras andra egenskaper) och därefter en query som räknar ut summan av specimens från subqueryn. Tips: Du behöver ge subqueryn ett alias(eftersom den producerar en sk “derived table”), och använda detta alias i den yttre queryn.
SELECT SUM(a.specimens) FROM (SELECT * FROM animals WHERE name LIKE 'm%') a;

-- Ta reda på vilket djur som har längst namn av alla de djur som har fler än 10 specimens. Börja med att skriva en subquery som hämtar alla med fler än 10 och ge den tabellen(resultatet blir i form av en tabell) ett alias. Skriv sedan en andra (yttre) query som räknar ut maxvärdet på längden av namnet från subqueryn.
SELECT * FROM (SELECT * FROM animals WHERE specimens > 10) a ORDER BY LENGTH(a.name) DESC LIMIT 1;

-- Använd subqueries för att ta reda på namnet på den djurart som har flest specimens bland de djur som ingår i kategorierna fågel eller fisk. Tips: Använd ORDERBY i kombination med LIMIT 1 för att få fram djuret med flest.
SELECT * FROM (SELECT * FROM animals WHERE category IN ('fågel', 'fisk')) a ORDER BY a.specimens DESC LIMIT 1;

-- Använd subqueries för att ta reda på vilka andra djur som har samma antal specimens som Ekoxen. I det här fallet behöver du skriva en subquery som ger en scalar som resultat, nämligen antalet specimen för ekoxen. Därefter skriver du en yttre query som använder det värdet. Tips: Använd subqueryn som ett villkor till WHERE i den yttre queryn.
SELECT * FROM animals WHERE specimens = (SELECT specimens FROM animals WHERE name = 'Ekoxe');

-- Skriv en subquery som hämtar information om medelvärdet på specimens för däggdjuren. Använd sedan detta värde för att hämta fram namnen på de övriga djur (som inte är däggdjur) som har fler specimens.
SELECT * FROM animals WHERE specimens > (SELECT AVG(specimens) FROM animals WHERE category = 'däggdjur' GROUP BY category) AND category != 'däggdjur';