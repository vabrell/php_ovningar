-- Skapa en ny databas (moviedatabase) och i den skapar du sedan tre tabeller (movies, actors och actors_movies). Kolumnerna i de tre databaserna ska vara enligt följande: movies(id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(50), year YEAR), actors(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), birthday DATE), actors_movies (id INT AUTO_INCREMENT PRIMARY KEY, actor_id INT, movie_id INT)
CREATE DATABASE moviedatabase;
USE moviedatabase;
CREATE TABLE movies (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(50), year YEAR);
CREATE TABLE actors (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), birthday DATE);
CREATE TABLE actors_movies (id INT AUTO_INCREMENT PRIMARY KEY, actor_id INT, movie_id INT);

-- Därefter går du till ​https://www.imdb.com​ och letar upp skådespelaren Harrison Ford. Skriv in hans värden i actors-tabellen.
INSERT INTO actors (name, birthday) VALUES ('Harrison Ford', '1942-06-13');

-- Välj sedan tre filmer som Harrison Ford varit med i och skriv in deras värden i movies-tabellen. För varje film väljer du också ut tre skådespelare som varit med i filmen, och skriver deras värden i actors-tabellen. Anteckna gärna också i vilken film de varit med. Den som vill spara lite tid väljer exempelvis två eller flera filmer ur sammaserie, eftersom du har stor chans att hitta samma skådespelare i dessa filmer. Se dock till att du tar med någon skådespelare som bara är med i en av filmerna.
INSERT INTO movies (title, year)
VALUES  ('Star Wars', '1977'),
        ('Star Wars: Episode V - The Empire Strikes Back', '1980'),
        ('Raiders of the Lost Ark', '1981');

INSERT INTO actors (name, birthday)
VALUES  ('Mark Hamill', '1951-09-25'),
        ('Carrie Fisher', '1956-10-21'),
        ('Peter Mayhew', '1944-05-19'),
        ('Karen Allen', '1951-10-05'),
        ('John Rhys-Davies', '1944-05-05'),
        ('Wolf Kahler', '1940-04-03');

-- Nu kommer delen där du ska binda ihop skåde spelare och filmer. Titta på dina noteringar och skapa utifrån dem rader i tabellen actors_movies. Om filmen “Jakten på den försvunna skatten” har id 1 i movies-tabellen, och “Harrison Ford” har id 1 i actors-tabellen, så ska du skapa en rad som har dessa två värden. Fortsätt så tills du har skrivit in alla kombinationerna.
INSERT INTO actors_movies (actor_id, movie_id)
VALUES  (1, 1),
        (2, 1),
        (3, 1),
        (4, 1),
        (1, 2),
        (2, 2),
        (3, 2),
        (4, 2),
        (1, 3),
        (5, 3),
        (6, 3),
        (7, 3);

-- Äntligen kan du testa om du gjort rätt. Skriven query som hämtar titel för en film, samt information om vilka skådespelare som var med i den.
SELECT  title,
        GROUP_CONCAT(name) AS actors
FROM actors_movies
JOIN movies ON movies.id = movie_id
JOIN actors ON actors.id = actor_id
GROUP BY title;

-- Skriv nu en query som hämtar all information om en skådespelare, samt vilka filmer den varit med i.
SELECT  name,
        year,
        GROUP_CONCAT(title) AS movies
FROM actors
JOIN movies ON movies.id IN (
    SELECT movie_id FROM actors_movies
    WHERE actor_id = actors.id
)
GROUP BY name;

-- Skriv en query som visar alla filmer i bokstavsordning, samt hur många skådespelare (i din databas) som medverkat i den
SELECT  title,
        (
            SELECT COUNT(id)
            FROM actors_movies
            WHERE movie_id = movies.id
        ) AS actors
FROM movies
GROUP BY title
ORDER BY title;