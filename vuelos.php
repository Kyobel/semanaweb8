<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $origen = htmlspecialchars($_POST['origen'], ENT_QUOTES, 'UTF-8');
    $destino = htmlspecialchars($_POST['destino'], ENT_QUOTES, 'UTF-8');
    $fecha = $_POST['fecha']; // Formato YYYY-MM-DD
    $plazas_disponibles = (int)$_POST['plazas_disponibles'];
    $precio = (float)$_POST['precio'];

    $stmt = $pdo->prepare('INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$origen, $destino, $fecha, $plazas_disponibles, $precio]);

    echo "Vuelo registrado con éxito";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Vuelo</title>
</head>
<body>
<div class="container mt-5">
    <p><a href="index.php" class="btn btn-secondary">Regresar</a></p>
    <h2>Registrar Vuelo</h2>
    <form method="post">
        <div class="mb-3">
            <label for="origen" class="form-label">Origen:</label>
            <input type="text" id="origen" name="origen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" id="destino" name="destino" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Salida:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="plazas_disponibles" class="form-label">Plazas Disponibles:</label>
            <input type="number" id="plazas_disponibles" name="plazas_disponibles" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
</body>
</html>
