<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: No se ha iniciado sesión.");
}

$user_id = $_SESSION['user_id'];

// Registro de diez reservas combinando vuelos y hoteles para el usuario en sesión
for ($i = 1; $i <= 10; $i++) {
    // Seleccionar un vuelo aleatorio
    $stmt_vuelo = $pdo->query('SELECT id_vuelo FROM VUELO ORDER BY RAND() LIMIT 1');
    $id_vuelo = $stmt_vuelo->fetchColumn();

    // Seleccionar un hotel aleatorio
    $stmt_hotel = $pdo->query('SELECT id_hotel FROM HOTEL ORDER BY RAND() LIMIT 1');
    $id_hotel = $stmt_hotel->fetchColumn();

    // Fecha de reserva (asumiremos la fecha actual para simplificar)
    $fecha_reserva = date('Y-m-d');

    // Insertar la reserva en la tabla RESERVA asociada al usuario en sesión
    $stmt_insert = $pdo->prepare('INSERT INTO RESERVA (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, ?, ?, ?)');
    $stmt_insert->execute([$user_id, $fecha_reserva, $id_vuelo, $id_hotel]);
}

echo "Se han registrado diez reservas de servicios turísticos para el usuario con ID: $user_id.";
?>
