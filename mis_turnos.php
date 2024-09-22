<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Turnos - Piroca Paintball</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();
    include("conexiondb.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: paintball.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $query = $mysqli->prepare("
        SELECT r.id, c.name AS court_name, r.time, r.reservation_date 
        FROM reservations r 
        JOIN courts c ON r.court_id = c.id 
        WHERE r.user_id = ?
    ");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    ?>

    <header>
        <div class="container">
            <h1>Piroca Paintball</h1>
            <ul>
                <li><a href="logout.php">Cerrar Sesión</a></li>
                <li><a href="paintball.php">Inicio</a></li>
            </ul>
        </div>
    </header>

    <main>
        <h2>Mis Turnos</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Cancha</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            
                            <td><?php echo htmlspecialchars($row['court_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                            <td><?php echo htmlspecialchars($row['reservation_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tienes turnos reservados.</p>
        <?php endif; ?>

    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Piroca Paintball. Vanessa está reservada.</p>
            <p>Contacto: <a href="mailto:contacto@pirocapaintball.com">contacto@pirocapaintball.com</a></p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
