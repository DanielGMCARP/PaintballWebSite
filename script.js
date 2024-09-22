document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos de los modales
    var registerModal = document.getElementById('registerModal');
    var loginModal = document.getElementById('loginModal');
    var bookingModal = document.getElementById('bookingModal');

    // Obtener botones que abren los modales
    var openRegister = document.getElementById('openRegister');
    var openLogin = document.getElementById('openLogin');
    var openBooking = document.getElementById('openBooking');

    // Obtener botones de cierre de los modales
    var closeRegister = document.getElementById('closeRegister');
    var closeLogin = document.getElementById('closeLogin');
    var closeBooking = document.getElementById('closeBooking');

    // Abrir modales
    if (openRegister) {
        openRegister.onclick = function() {
            registerModal.style.display = 'block';
        }
    }

    if (openLogin) {
        openLogin.onclick = function() {
            loginModal.style.display = 'block';
        }
    }

    if (openBooking) {
        openBooking.onclick = function() {
            bookingModal.style.display = 'block';
        }
    }

    // Cerrar modales
    closeRegister.onclick = function() {
        registerModal.style.display = 'none';
    }

    closeLogin.onclick = function() {
        loginModal.style.display = 'none';
    }

    closeBooking.onclick = function() {
        bookingModal.style.display = 'none';
    }

    // Cerrar modales si se hace clic fuera de ellos
    window.onclick = function(event) {
        if (event.target == registerModal) {
            registerModal.style.display = 'none';
        }
        if (event.target == loginModal) {
            loginModal.style.display = 'none';
        }
        if (event.target == bookingModal) {
            bookingModal.style.display = 'none';
        }
    }
});