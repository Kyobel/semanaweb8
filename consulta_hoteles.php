<?php
include 'db.php';

// Consulta para calcular el número de reservas por hotel
$stmt_contador = $pdo->query('
    SELECT h.nombre AS nombre_hotel, COUNT(r.id_reserva) AS num_reservas
    FROM HOTEL h
    LEFT JOIN RESERVA r ON h.id_hotel = r.id_hotel
    GROUP BY h.id_hotel
    HAVING COUNT(r.id_reserva) > 2
');

// Obtener los resultados
$hoteles_con_reservas = $stmt_contador->fetchAll();

// Mostrar hoteles con más de dos reservas asignadas
echo "<h2>Hoteles con más de dos reservas asignadas</h2>";
echo "<ul>";
foreach ($hoteles_con_reservas as $hotel) {
    echo "<li>{$hotel['nombre_hotel']} - {$hotel['num_reservas']} reservas</li>";
}
echo "</ul>";
?>
