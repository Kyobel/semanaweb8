<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Verificación de Reservas y Consultas</title>
</head>
<body>
    <div class="container mt-5">
        <?php include 'registro_reservas.php'; ?> <!-- Este es el archivo PHP donde registras las diez reservas -->
        
        <?php include 'consulta_reservas.php'; ?> <!-- Este es el archivo PHP donde consultas las reservas -->
        
        <?php include 'consulta_hoteles.php'; ?> <!-- Este es el archivo PHP donde consultas los hoteles con más de dos reservas -->
    </div>
</body>
</html>