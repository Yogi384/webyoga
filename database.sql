CREATE DATABASE anime_db;
USE anime_db;
CREATE TABLE anime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100),
    genre VARCHAR(100),
    episode INT,
    deskripsi TEXT
);
INSERT INTO anime (judul, genre, episode, deskripsi) VALUES
('Naruto Shippuden','Action, Adventure',500,'Perjalanan Naruto menjadi Hokage'),
('Attack on Titan','Action, Drama',87,'Perang manusia melawan titan');