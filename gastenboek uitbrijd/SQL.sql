CREATE TABLE gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersnaam VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    wachtwoord VARCHAR(255) NOT NULL,
    isadmin BOOLEAN NOT NULL DEFAULT 0
);
CREATE TABLE gastenboek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersid INT NOT NULL,
    bericht TEXT NOT NULL,
    datumtijd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gebruikersid) REFERENCES gebruikers(id)
);
INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord, isadmin)
 VALUES ('1234', '1234@gmail.com', '0000', 0);
