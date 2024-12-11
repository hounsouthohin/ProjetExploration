DROP DATABASE IF EXISTS BD_Final;

CREATE DATABASE BD_Final;
USE BD_Final;

CREATE TABLE RoleUtilisateur(   
	role_id     INT          NOT NULL   AUTO_INCREMENT PRIMARY KEY,
    role_name   VARCHAR(50)  NOT NULL
);

CREATE TABLE Utilisateur(
	role_id INT          NOT NULL,
    noUser  INT          NOT NULL   AUTO_INCREMENT PRIMARY KEY,
    pseudo  VARCHAR(50)  NOT NULL,
    mdp     VARCHAR(100) NOT NULL,
    mail    VARCHAR(50)  NOT NULL,
	CONSTRAINT FK_UtilisateurRole FOREIGN KEY(role_id)
	REFERENCES RoleUtilisateur(role_id)
);

CREATE TABLE Statistiques(
    noStat      INT NOT NULL    AUTO_INCREMENT PRIMARY KEY,
    humidite    INT NULL,
    temperature INT NULL,
    temps       DATETIME NULL
);

CREATE TABLE Moyennes(
    noMoy       INT NOT NULL    AUTO_INCREMENT PRIMARY KEY,
    moyHum      DECIMAL(5,2) NULL,
    moyTemp     DECIMAL(5,2) NULL
);

CREATE TABLE UserAttempt(
    noUser       INT      NOT NULL,
    last_attempt DATETIME NOT NULL,
    attempt      INT      NOT NULL,
    blocked      BIT      NOT NULL,
    CONSTRAINT   FK_Utilisateur  FOREIGN KEY (noUser)
	REFERENCES Utilisateur(noUser)
);




DROP TRIGGER IF EXISTS FaireMoyenne;

DELIMITER $$

CREATE TRIGGER FaireMoyenne
AFTER INSERT ON Statistiques
FOR EACH ROW
BEGIN
    DECLARE moyenne DECIMAL(5,2);  -- Utilisation de DECIMAL pour la moyenne
    -- Calcul de la moyenne de l'humidité
    SELECT AVG(humidite) INTO moyenne FROM Statistiques;
    -- Insertion de la moyenne dans la table Statistiques
    UPDATE Moyennes SET moyHum = moyenne
    WHERE noMoy = 1;
    
    -- Calcul de la moyenne de la température
    SELECT AVG(temperature) INTO moyenne FROM Statistiques;
    -- Insertion de la moyenne dans la table Statistiques
    UPDATE Moyennes SET moyTemp = moyenne
    WHERE noMoy = 1;
END$$

DELIMITER ;

INSERT INTO Moyennes(moyHum, moyTemp) VALUES (0.0, 0.0);