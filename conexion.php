<?php

required_once__DIR__.'/config/database.php';

//conecta
$conn = new mysqli(
	DB_HOST,
	DB_USER,
	DB_PASS,
	DB_NAME
);

//verifica si funciona
if ($conn->connect_error){

	die("Error de conexión: " . $con->connect_error);

}

//importante: configurr el charset
$conn->set_charset('utf8mb4');

?>
