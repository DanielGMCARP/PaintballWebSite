<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piroca Paintball</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();
    ?>
    <audio autoplay loop style="display:none;">
        <source src="Y2meta.app - ME LLAMA - MOMO (Beret) (128 kbps).mp3" type="audio/mpeg">
        Tu navegador no soporta la etiqueta de audio.
    </audio>

    
    

    <header>
        <div class="container">
            <h1>Piroca Paintball</h1>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="#" id="openLogin">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <nav>
        <ul>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="#" id="openRegister">Registrar</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="#" id="openBooking">Reservar Cancha</a></li>
                <li><a href="mis_turnos.php">Mis Turnos</a></li> <!-- Enlace para ver los turnos -->
            <?php endif; ?>
            <li><a href="#que-es-paintball">INFO</a></li>
        </ul>
    </nav>
    
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeRegister">&times;</span>
            <h2>Registro</h2>
            <form id="registerForm" method="POST" action="registro.php">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>

                <label for="surname">Apellido:</label>
                <input type="text" id="surname" name="surname" required>

                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" required>

                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="register">Registrar</button>
                <p class="error" id="registerError"></p>
            </form>
        </div>
    </div>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeLogin">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" method="POST" action="login.php">
                <label for="loginEmail">Correo Electrónico:</label>
                <input type="email" id="loginEmail" name="loginEmail" required>

                <label for="loginPassword">Contraseña:</label>
                <input type="password" id="loginPassword" name="loginPassword" required>

                <button type="submit" name="login">Iniciar Sesión</button>

                <p class="error" id="loginError">
                    <?php
                    if (isset($_SESSION['login_error'])) {
                        echo htmlspecialchars($_SESSION['login_error']);
                        unset($_SESSION['login_error']);
                    }
                    ?>
                </p>
            </form>
        </div>
    </div>
    
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeBooking">&times;</span>
            <h2>Reservar Cancha</h2>
            <form id="bookingForm" method="POST" action="reservas.php">
                <label for="court">Selecciona la Cancha:</label>
                <select id="court" name="court" required>
                    <option value="La Boca">La Boca</option>
                    <option value="El Obelisco">El Obelisco</option>
                    <option value="Los Andes">Los Andes</option>
                    <option value="La Pampa">La Pampa</option>
                    <option value="El Palomar">El Palomar</option>
                    <option value="Villa Devoto">Villa Devoto</option>
                    <option value="San Telmo">San Telmo</option>
                </select>

                <label for="time">Selecciona el Horario:</label>
                <select id="time" name="time" required>
                    <option value="09:00:00">9:00 - 10:00</option>
                    <option value="10:00:00">10:00 - 11:00</option>
                    <option value="11:00:00">11:00 - 12:00</option>
                    <option value="12:00:00">12:00 - 13:00</option>
                    <option value="13:00:00">13:00 - 14:00</option>
                    <option value="14:00:00">14:00 - 15:00</option>
                    <option value="15:00:00">15:00 - 16:00</option>
                </select>

                <label for="fecha_reserva">Fecha de Reserva:</label>
                <input type="date" id="fecha_reserva" name="fecha_reserva" required>

                <button type="submit">Reservar</button>
            </form>
        </div>
    </div>

    <main>
        <div id="quienes-somos">
            <div id="Pibes">
                <h2>Quiénes Somos</h2>
                <p>Somos un grupo de amigos que tuvieron un proyecto dirigido por Olaso y los obligó a hacer un programa de paintball, lo hicimos realidad y ahora tenemos nuestras propias canchas, Piroca Paintball. Todo gracias a Olaso.</p>
            </div>
            <div class="Nosotros">
                <img src="imagenes/Collage Paintball.png" alt="Los Pibes" class="bros">
            </div>
        </div>

        <div id="donde-estamos">
            <div id="ubication"> 
                <h2>Dónde Estamos</h2>  
                <p>Nuestras instalaciones se encuentran en Pareja 2156, tenemos una amplia cantidad de canchas. Nuestra recepcionista Gabriela Saporito en el lugar los puede guiar y cualquier cosa tiene nuestros contactos en el pie de página.</p>
            </div>
            <div class="frame">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.7196786943214!2d-58.49279697495697!3d-34.58595890193728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb6412faaa7fb%3A0x3a80b24ae68e98c3!2sPareja%202156%2C%20Cdad.%20Aut%C3%B3noma%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1726430368272!5m2!1ses!2sar" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div id="que-es-paintball">
            <div>
                <h2>¿Qué es el Paintball?</h2>
                <p>El paintball es un deporte de estrategia y trabajo en equipo, donde los jugadores utilizan marcadoras para lanzar bolas de pintura a sus oponentes. El objetivo es eliminar al equipo contrario o cumplir ciertas misiones sin ser alcanzado por las bolas de pintura. Es un juego emocionante, ideal para desarrollar habilidades de liderazgo, trabajo en equipo y toma de decisiones rápidas.</p>
            </div>
            <div>
                <img src="https://barcelonapaintball.es/wp-content/uploads/2022/03/FIL_0561_p-min-1536x1024.jpg" alt="Equipo de Paintball" class="PaintballTeam">
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Piroca Paintball. Vanessa está reservada.</p>
            <p>Contacto: <a href="mailto:contacto@pirocapaintball.com">contacto@pirocapaintball.com</a></p>
            <p>Síguenos en: 
                <a href="https://x.com/remix_marcos" target="_blank">Twitter Marcos</a> |
                <a href="https://x.com/josedan08309250" target="_blank">Twitter Daniel</a> |
                <a href="https://www.instagram.com/perez0_0marcos/" target="_blank">IG Marcos</a> |
                <a href="https://www.instagram.com/danifouru/" target="_blank">IG Daniel</a> |
                <a href="https://www.instagram.com/dario.guagliardo/" target="_blank">IG Dario</a>  |
            </p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
