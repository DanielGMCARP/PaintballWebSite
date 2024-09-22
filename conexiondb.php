<?php
$host = 'localhost'; // Dirección del servidor
$usuario = 'root'; // Usuario de la base de datos
$contraseña = ''; // Contraseña de la base de datos (vacía en XAMPP por defecto)
$base_de_datos = 'marcosdario';

$mysqli = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}
?>
