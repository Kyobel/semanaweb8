-- Creación de la base de datos si no existe
CREATE DATABASE IF NOT EXISTS AGENCIA;
USE AGENCIA;

-- Tabla Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    passwords VARCHAR(255) NOT NULL
);

-- Tabla VUELO
CREATE TABLE IF NOT EXISTS VUELO (
    id_vuelo INT AUTO_INCREMENT PRIMARY KEY,
    origen VARCHAR(255) NOT NULL,
    destino VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    plazas_disponibles INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla HOTEL
CREATE TABLE IF NOT EXISTS HOTEL (
    id_hotel INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ubicacion VARCHAR(255) NOT NULL,
    habitaciones_disponibles INT NOT NULL,
    tarifa_noche DECIMAL(10, 2) NOT NULL
);

-- Tabla RESERVA
CREATE TABLE IF NOT EXISTS RESERVA (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    fecha_reserva DATE NOT NULL,
    id_vuelo INT,
    id_hotel INT,
    FOREIGN KEY (id_vuelo) REFERENCES VUELO(id_vuelo),
    FOREIGN KEY (id_hotel) REFERENCES HOTEL(id_hotel)
);
