DROP DATABASE IF EXISTS Sesiones_Minijuegos;
CREATE DATABASE IF NOT EXISTS Sesiones_Minijuegos DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE Sesiones_Minijuegos;

CREATE TABLE Usuarios
(
    idUsuario INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    correo VARCHAR(50) NOT NULL UNIQUE,
    contrasenia VARCHAR(50) NOT NULL
);

CREATE TABLE Minijuegos
(
    idMinijuego INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(50) NOT NULL UNIQUE,
    url TEXT NOT NULL
);

CREATE TABLE Preferencia
(
    idUsuario INT UNSIGNED NOT NULL,
    idMinijuego INT UNSIGNED NOT NULL, 
    PRIMARY KEY(idUsuario, idMinijuego),
    FOREIGN KEY(idUsuario) REFERENCES Usuarios(idUsuario),
    FOREIGN KEY(idMinijuego) REFERENCES Minijuegos(idMinijuego)
);