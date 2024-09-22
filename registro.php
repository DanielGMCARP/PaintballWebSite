<?php
include("conexiondb.php");
if (isset($_POST['register'])) {
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $dni = trim($_POST['dni']);
    $age = trim($_POST['age']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($name) && !empty($surname) && !empty($dni) && !empty($age) && !empty($password)) {
        // Verificar si el email ya está registrado
        $checkEmail = "SELECT * FROM users WHERE email = ?";
        $stmtCheck = $conex->prepare($checkEmail);
        $stmtCheck->bind_param('s', $email);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();

        if ($result->num_rows > 0) {
            echo "El email ya está registrado. Por favor, usa otro.";
        } else {
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Preparar la consulta para evitar inyección SQL
            $consulta = "INSERT INTO users (email, name, surname, dni, age, password) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conex->prepare($consulta);
            $stmt->bind_param('ssssss', $email, $name, $surname, $dni, $age, $hashed_password);

            if ($stmt->execute()) {
                echo "Registro exitoso. Puedes iniciar sesión.";
                header("Location: paintball.php"); // Redirigir a la página principal
                exit();
            } else {
                echo "Error al registrar: " . $stmt->error;
            }

            $stmt->close();
        }
        $stmtCheck->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
