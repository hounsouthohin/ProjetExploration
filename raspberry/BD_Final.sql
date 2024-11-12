CREATE DATABASE BD_Final;
USE BD_Final;

CREATE TABLE RoleUtilisateur(   
	role_id     INT          NOT NULL PRIMARY KEY,
    role_name   VARCHAR(50)  NOT NULL
);

CREATE TABLE Utilisateur(
	role_id INT          NOT NULL,
    noUser  INT          NOT NULL   IDENTITY(0,1) PRIMARY KEY,
    pseudo  VARCHAR(50)  NOT NULL,
    mdp     VARCHAR(100) NOT NULL,
    mail    VARCHAR(50)  NOT NULL,
	CONSTRAINT FK_UtilisateurRole FOREIGN KEY(role_id) 
	REFERENCES RoleUtilisateur(role_id)
);

CREATE TABLE Statistiques(
    humidite    INT NULL,
    temperature INT NULL,
    moyHum      INT NULL,
    moyTemp     INT NULL
);




CREATE TABLE UserAttempt(
    noUser       INT      NOT NULL,
    last_attempt DATETIME NOT NULL,
    attempt      INT      NOT NULL,
    blocked      BIT      NOT NULL,
    CONSTRAINT   FK_Utilisateur  FOREIGN KEY (noUser)
	REFERENCES Utilisateur(noUser)
) ;
