 -- Nieuwe database aanmaken genaamd 'poll'
CREATE DATABASE IF NOT EXISTS poll;
USE poll;

-- Tabel 'poll' aanmaken
CREATE TABLE IF NOT EXISTS poll (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vraag VARCHAR(255)
);

-- Voorbeeldgegevens invoegen in de tabel 'poll'
INSERT INTO poll (vraag) VALUES
('Wat is je favoriete programmeertaal?');

-- Tabel 'optie' aanmaken
CREATE TABLE IF NOT EXISTS optie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT,
    antwoord VARCHAR(255),
    stemmen INT,
    FOREIGN KEY (poll_id) REFERENCES poll(id)
);

-- Voorbeeldgegevens invoegen in de tabel 'optie'
INSERT INTO optie (poll_id, antwoord, stemmen) VALUES
(1, 'PHP', 0),
(1, 'Python', 0),
(1, 'JavaScript', 0),
(1, 'Java', 0);  