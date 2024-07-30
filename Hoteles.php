<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $ubicacion = htmlspecialchars($_POST['ubicacion'], ENT_QUOTES, 'UTF-8');
    $habitaciones_disponibles = (int)$_POST['habitaciones_disponibles'];
    $tarifa_noche = (float)$_POST['tarifa_noche'];

    $stmt = $pdo->prepare('INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche]);

    echo "Hotel registrado con éxito";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Hotel</title>
</head>
<body>
<div class="container mt-5">
    <p><a href="index.php" class="btn btn-secondary">Regresar</a></p>
    <h2>Registrar Hotel</h2>
    <form method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="habitaciones_disponibles" class="form-label">Habitaciones Disponibles:</label>
            <input type="number" id="habitaciones_disponibles" name="habitaciones_disponibles" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="tarifa_noche" class="form-label">Tarifa por Noche:</label>
            <input type="number" step="0.01" id="tarifa_noche" name="tarifa_noche" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
</body>
</html>
