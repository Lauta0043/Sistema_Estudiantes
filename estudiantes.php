<?php
require_once 'config/database.php';
$conn = getConnection();
$resultado = $conn->query('SELECT * FROM estudiantes WHERE activo = 1 ORDER BY apellido');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        a { color: #4CAF50; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Estudiantes</h1>
    <a href="agregar_estudiante.php" style="display: inline-block; padding: 10px; background-color: #4CAF50; color: white; border-radius: 4px;">+ Agregar Estudiante</a>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nombre']) ?></td>
                    <td><?= htmlspecialchars($fila['apellido']) ?></td>
                    <td><?= htmlspecialchars($fila['email']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p>Total: <?= $resultado->num_rows ?> estudiantes</p>
</body>
</html>
