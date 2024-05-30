<?php
session_start();

//comprobamos si tipo_login está en la sesión
if (isset($_SESSION['tipo_login'])) {
    if ($_SESSION['tipo_login'] == 'usuario') {
        //mostramos la navbar para usuarios o protectoras
        include('navbar_usuario.php');
    } else if ($_SESSION['tipo_login'] == 'protectora') {
        include('../protectora/navbar_protectora.php');
    }
} else {
    header("Location: login.php");
    exit();
}

//incluimos el archivo q genera las fichas de los animales
include('../protectora/generar_fichas_animales.php');
?>

<?php
include('header.php');
    include('footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
