<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare('SELECT id, passwords FROM usuarios WHERE username = ?');
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($contrasena, $user['passwords'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        <form method="post">
            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <button type="submit" name="login" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <p><a href="crearUsuario.php" class="btn btn-success">Crear Nuevo Usuario</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <p><a href="vuelos.php" class="btn btn-secondary">Crear Vuelo</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <p><a href="Hoteles.php" class="btn btn-secondary">Crear Hotel</a></p>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</body>
</html>
