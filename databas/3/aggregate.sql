-- Skriv ut det totala antalet djur (summan av specimen).
SELECT SUM(specimens) AS total_animals FROM animals;

-- Skriv ut det genomsnittliga antalet specimens.
SELECT AVG(specimens) AS average_animals FROM animals;

-- Skriv ut högsta värdet som finns i kolumnen specimen.
SELECT MAX(specimens) AS most_animals FROM animals;

-- Skriv ut både namn och antal för den djurart som har flest antal specimens.
SELECT category, SUM(specimens) AS specimens FROM animals GROUP BY category ORDER BY specimens DESC LIMIT 1;

-- Skriv ut hur många arter som ingår i kategorin däggdjur.
SELECT COUNT(DISTINCT name) AS species FROM animals WHERE category = 'däggdjur';

-- Skriv ut en lista över antalet djurarter per kategori.
SELECT category, COUNT(DISTINCT name) AS species FROM animals GROUP BY category;

-- Skriv ut det totala antalet djur per kategori, sorterat från högst till lägst.
SELECT category, SUM(specimens) AS total_animals FROM animals GROUP BY category ORDER BY total_animals DESC;

-- Skriv ut antalet djur arter som har mellan 3 och 10 specimens, per kategori.
SELECT category, COUNT(DISTINCT name) AS three_to_ten_specimens FROM animals WHERE specimens BETWEEN 3 AND 10 GROUP BY category;