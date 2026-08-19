<?php
require_once 'config/database.php';
$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    // Validación básica
    if (empty($nombre) || empty($apellido) || empty($email)) {
        $mensaje = 'Todos los campos son obligatorios.';
        $tipo_mensaje = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = 'El correo electrónico no es válido.';
        $tipo_mensaje = 'error';
    } else {
        // Insertar en la base de datos
        $conn = getConnection();
        
        // Usar prepared statements para mayor seguridad
        $stmt = $conn->prepare('INSERT INTO estudiantes (nombre, apellido, email, activo) VALUES (?, ?, ?, 1)');
        $stmt->bind_param('sss', $nombre, $apellido, $email);
        
        if ($stmt->execute()) {
            $mensaje = 'Estudiante insertado correctamente.';
            $tipo_mensaje = 'exito';
            // Limpiar el formulario
            $nombre = $apellido = $email = '';
        } else {
            $mensaje = 'Error al insertar el estudiante: ' . $stmt->error;
            $tipo_mensaje = 'error';
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Estudiante</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 400px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background-color: #4CAF50; color: white; padding: 10px; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .mensaje { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .exito { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        a { display: inline-block; margin-top: 15px; color: #4CAF50; }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Insertar Estudiante</h1>
        
        <?php if ($mensaje): ?>
            <div class="mensaje <?= $tipo_mensaje ?>">
                <strong><?= htmlspecialchars($mensaje) ?></strong>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>" required></label>
            </div>
            
            <div class="form-group">
                <label>Apellido: <input type="text" name="apellido" value="<?= htmlspecialchars($apellido ?? '') ?>" required></label>
            </div>
            
            <div class="form-group">
                <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required></label>
            </div>
            
            <button type="submit">Agregar Estudiante</button>
        </form>
        
        <a href="estudiantes.php">Ver lista de estudiantes</a>
    </div>
</body>
</html>