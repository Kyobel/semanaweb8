<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
include 'db.php';

// Obtener lista de vuelos
$stmt_vuelos = $pdo->query('SELECT * FROM VUELO');
$vuelos = $stmt_vuelos->fetchAll();

// Obtener lista de hoteles
$stmt_hoteles = $pdo->query('SELECT * FROM HOTEL');
$hoteles = $stmt_hoteles->fetchAll();

// Procesar reserva
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservar'])) {
    $id_vuelo = (int)$_POST['vuelo'];
    $id_hotel = isset($_POST['hotel']) ? (int)$_POST['hotel'] : null;

    // Validar si el vuelo y el hotel están disponibles (plazas y habitaciones)
    $stmt_disponibilidad_vuelo = $pdo->prepare('SELECT plazas_disponibles FROM VUELO WHERE id_vuelo = ?');
    $stmt_disponibilidad_vuelo->execute([$id_vuelo]);
    $plazas_disponibles_vuelo = $stmt_disponibilidad_vuelo->fetchColumn();

    if ($plazas_disponibles_vuelo > 0) {
        // Reducir las plazas disponibles del vuelo seleccionado
        $stmt_actualizar_plazas_vuelo = $pdo->prepare('UPDATE VUELO SET plazas_disponibles = plazas_disponibles - 1 WHERE id_vuelo = ?');
        $stmt_actualizar_plazas_vuelo->execute([$id_vuelo]);

        // Insertar la reserva en la tabla RESERVA
        $stmt_reserva = $pdo->prepare('INSERT INTO RESERVA (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, ?, ?, ?)');
        $fecha_reserva = date('Y-m-d'); // Fecha actual
        $stmt_reserva->execute([$user_id, $fecha_reserva, $id_vuelo, $id_hotel]);

        $mensaje_reserva = "Reserva realizada con éxito.";
    } else {
        $mensaje_reserva = "El vuelo seleccionado no tiene plazas disponibles.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reservar Vuelo</title>
</head>

<body>
    <div class="container mt-5">
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
        <h2>Reservar Vuelo</h2>
        <?php
        if (isset($mensaje_reserva)) {
            echo '<div class="alert alert-success">' . htmlspecialchars($mensaje_reserva) . '</div>';
        }
        ?>
        <form action="reserva.php" method="post">
            <div class="mb-3">
                <label for="vuelo" class="form-label">Seleccione Vuelo:</label>
                <select id="vuelo" name="vuelo" class="form-control" required>
                    <option value="">Seleccionar vuelo...</option>
                    <?php foreach ($vuelos as $vuelo) : ?>
                        <option value="<?php echo $vuelo['id_vuelo']; ?>"><?php echo htmlspecialchars($vuelo['destino']); ?> - $<?php echo number_format((float)$vuelo['precio'], 2); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="hotel" class="form-label">Seleccione Hotel (opcional):</label>
                <select id="hotel" name="hotel" class="form-control">
                    <option value="">Ninguno</option>
                    <?php foreach ($hoteles as $hotel) : ?>
                        <option value="<?php echo $hotel['id_hotel']; ?>"><?php echo htmlspecialchars($hotel['nombre']); ?> - $<?php echo number_format((float)$hotel['tarifa_noche'], 2); ?>/noche</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="reservar" class="btn btn-primary">Reservar</button>
        </form>
    </div>
</body>

</html>
