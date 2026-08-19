<?php
// Archivo de configuración de la base de datos
// config/database.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sistema_estudiantes');

/**
 * Obtiene la conexión a la base de datos
 * @return mysqli
 */
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die('Error de conexión: ' . $conn->connect_error);
    }
    
    // Establecer el charset a UTF-8
    $conn->set_charset('utf8mb4');
    
    return $conn;
}
?>
