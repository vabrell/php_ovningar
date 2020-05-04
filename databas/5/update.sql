-- Uppdatera skatorna till att specimen är 5.
UPDATE animals SET specimens = 5 WHERE id = 9;

-- Uppdatera alla fågar så deras specimen-antal halveras.
UPDATE animals SET specimens = FLOOR(specimens / 2) WHERE category = 'fågel';

-- Uppdatera blåvalen så den får sitt latinska namn (Balaenoptera musculus).
UPDATE animals SET name = 'Balaenoptera musculus' WHERE id = 6;

-- Uppdatera alla däggdjur som har mindre än 4 specimens så de ökar sitt antal med 2.
UPDATE animals SET specimens = specimens + 2 WHERE category = 'däggdjur' AND specimens < 4;