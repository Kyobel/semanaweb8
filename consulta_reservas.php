<?php
include 'db.php';

// Consulta para obtener el contenido de la tabla RESERVA
$stmt_reservas = $pdo->query('SELECT * FROM RESERVA');
$reservas = $stmt_reservas->fetchAll();

// Mostrar las reservas
echo "<h2>Reservas de Servicios Turísticos</h2>";
echo "<table border='1'>";
echo "<tr><th>ID Reserva</th><th>ID Cliente</th><th>Fecha Reserva</th><th>ID Vuelo</th><th>ID Hotel</th></tr>";
foreach ($reservas as $reserva) {
    echo "<tr>";
    echo "<td>{$reserva['id_reserva']}</td>";
    echo "<td>{$reserva['id_cliente']}</td>";
    echo "<td>{$reserva['fecha_reserva']}</td>";
    echo "<td>{$reserva['id_vuelo']}</td>";
    echo "<td>{$reserva['id_hotel']}</td>";
    echo "</tr>";
}
echo "</table>";
?>
