<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

// Obtener lista de vuelos
$stmt = $pdo->query('SELECT * FROM VUELO');
$vuelos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inicio</title>
</head>
<body>
<div class="container mt-5">
    <h2>Bienvenido a la Agencia de Viajes</h2>
    <p><a href="reserva.php" class="btn btn-primary">Pedir Reservacion</a></p>

    <h3>Vuelos Disponibles</h3>
    <ul class="list-group">
        <?php foreach ($vuelos as $vuelo): ?>
            <li class="list-group-item">
                <?php echo htmlspecialchars($vuelo['destino']); ?> - $<?php echo number_format((float)$vuelo['precio'], 2); ?> -
                <?php if (isset($vuelo['fecha']) && !empty($vuelo['fecha'])): ?>
                    Salida: <?php echo date('d/m/Y H:i', strtotime($vuelo['fecha'])); ?>
                <?php else: ?>
                    Fecha no disponible
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><a href="logout.php" class="btn btn-secondary">Cerrar Sesión</a></p>
</div>
</body>
</html>
