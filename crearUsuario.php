<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO usuarios (username, passwords) VALUES (?, ?)');
    $stmt->execute([$username, $password]);

    echo "Usuario registrado con éxito";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Usuario</title>
</head>
<body>
<div class="container mt-5">
<a href="index.php" class="btn btn-secondary">Regresar</a>
    <h2>Registrar Usuario</h2>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
    </form>
</div>
</body>
</html>
