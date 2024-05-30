<?php
session_start(); // Iniciar la sesión



// Comprobar si 'tipo_login' está definido en la sesión
if (isset($_SESSION['tipo_login'])) {
    if ($_SESSION['tipo_login'] == 'usuario') {
        // Mostrar la navbar para usuarios
        include('navbar_usuario.php');
    } else if ($_SESSION['tipo_login'] == 'protectora') {
        // Mostrar la navbar para protectoras
        include('../protectora/navbar_protectora.php');
    }
} else {
    header("Location: login.php");
    exit();
}

// Incluye el archivo para generar las fichas de animales
include('../protectora/generar_fichas_animales.php');
?>

<?php
include('header.php');
    include('footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
