<?php
session_start();
include("conexiondb.php");
// Verificar la conexión
if (!$mysqli) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener datos del formulario
$court_name = $_POST['court'];
$time = $_POST['time'];
$reservation_date = $_POST['fecha_reserva'];
$user_id = $_SESSION['user_id'];

// Obtener el ID de la cancha
$court_id = obtenerCourtId($court_name);

if (!$court_id) {
    echo 'Error: La cancha seleccionada no existe.';
    exit;
}

// Preparar y ejecutar la consulta de inserción
$query = $mysqli->prepare("INSERT INTO reservations (user_id, court_id, time, reservation_date) VALUES (?, ?, ?, ?)");
$query->bind_param("iiss", $user_id, $court_id, $time, $reservation_date);

if ($query->execute()) {
    $_SESSION['success_message'] = 'Reserva realizada con éxito.';
    header("Location: paintball.php");
    exit;
} else {
    echo 'Error al realizar la reserva: ' . $query->error;
}

// Cerrar la consulta
$query->close();

// Función para obtener el ID de la cancha
function obtenerCourtId($court_name) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT id FROM courts WHERE name = ?");
    $stmt->bind_param("s", $court_name);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc()['id'] : null;
}

// Cerrar la conexión
$mysqli->close();
?>
