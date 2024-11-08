CREATE DATABASE BD_Final;
USE BD_Final;

CREATE TABLE User(
    noUser  INT     NOT NULL   AUTO_INCREMENT  
    pseudo  VARCHAR NOT NULL
    mdp     VARCHAR NOT NULL
    mail    VARCHAR NOT NULL
    PRIMARY KEY (noUser)
);

CREATE TABLE Statistiques(
    humidite    INT NULL
    temperature INT NULL
    moyHum      INT NULL
    moyTemp     INT NULL
);