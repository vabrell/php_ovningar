-- Skapa en databas med tabeller som innehåller information om produkter (med egenskaperna namn, pris och kategori), kunder (med egenskaperna namn och ort) samt en tabell som lagrar information om vilken kund som köpt vad (samt egenskaperna antal och timestamp, så att vi vet hur många och när ett köp har genomförts).
CREATE DATABASE shop;
USE shop;
CREATE TABLE products (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), price DECIMAL, category VARCHAR(30));
CREATE TABLE customers (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), area VARCHAR(30));
CREATE TABLE orders (id INT AUTO_INCREMENT PRIMARY KEY, product_id INT, customer_id INT, total INT, date TIMESTAMP);

-- Fyll sedan på med fem produkter i tre olika kategorier, fyra kunder och tio olika köp.
INSERT INTO products (name, price, category)
VALUES  ('Äpple', '12,50', 'Frukt'),
        ('Banan', '9,99', 'Frukt'),
        ('Mjölk', '14,50', 'Kylvara'),
        ('Smör', '30', 'Kylvara'),
        ('Flingor', '23', 'Torrvara');

INSERT INTO customers (name, area)
VALUES  ('Kalle Anka', 'Norr'),
        ('Kajsa Anka', 'Syd'),
        ('Joakim Anka', 'Öst'),
        ('Lukas Anka', 'Väst');

INSERT INTO orders (product_id, customer_id, total, date)
VALUES  (1, 1, 3, '2020-05-01 10:45:13'),
        (3, 1, 1, '2020-05-01 10:45:13'),
        (5, 1, 1, '2020-05-01 10:45:13'),
        (2, 2, 5, '2020-05-01 14:13:21'),
        (4, 2, 1, '2020-05-01 14:13:21'),
        (1, 3, 10, '2020-05-04 08:17:45'),
        (2, 3, 10, '2020-05-04 08:17:45'),
        (3, 3, 10, '2020-05-04 08:17:45'),
        (5, 3, 10, '2020-05-04 08:17:45'),
        (4, 4, 4, '2020-05-08 11:11:11');

-- När du har lagt in all data är det dags att skriva queries. Börja med en som visar alla köp (produkt, antal, tid) för en viss kund.
SELECT products.name, total, date
FROM orders
JOIN products ON products.id = product_id
WHERE customer_id = (
    SELECT id FROM customers
    WHERE name = 'Joakim Anka'
);

-- Visa alla köp som gjorts under en viss månad. Ta stöd i de Date & time-funktioner​ som finns i MySql.
SELECT * FROM orders
WHERE date BETWEEN TIMESTAMP('2020-05-01') AND TIMESTAMP('2020-05-31');

-- Lista alla produkter och antal sålda enheter för varje. (Exempel: Häftklammer, 22st)
SELECT  name,
        (
            SELECT SUM(total)
            FROM orders
            WHERE product_id = products.id
        ) AS total
FROM products;