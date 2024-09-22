<?php
session_start();
include("conexiondb.php"); // Asegúrate de incluir la conexión

if (isset($_POST['login'])) {
    $email = trim($_POST['loginEmail']);
    $password = trim($_POST['loginPassword']);

    if (!empty($email) && !empty($password)) {
        $consulta = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($consulta); // Usa $mysqli en lugar de $conex
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $user = $resultado->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id']; // Establecer la sesión
                header("Location: paintball.php"); // Redirigir a la página principal
                exit();
            } else {
                $_SESSION['login_error'] = "Error: Credenciales incorrectas.";
            }
        } else {
            $_SESSION['login_error'] = "Error: Credenciales incorrectas.";
        }
        
        $stmt->close();
    } else {
        $_SESSION['login_error'] = "Error: Todos los campos son obligatorios.";
    }
    
    // Redirigir a la página de login
    header("Location: paintball.php");
    exit();
}
?>
