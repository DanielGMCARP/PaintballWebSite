<?php
$host = 'localhost'; 
$usuario = 'tu_usuario';
$contraseña = 'tu_contraseña';
$base_de_datos = 'marcosdario';

$mysqli = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($mysqli->connect_error) {
    echo "Conexión fallida: " . $mysqli->connect_error;
} else {
    echo "Conexión exitosa";
}

$mysqli->close();
?>
