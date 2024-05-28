<?php
session_start(); // Iniciar sesión si no lo has hecho aún

// Verificar si se ha seleccionado un evento para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
    // Obtener el ID del evento seleccionado
    $evento_id = $_POST['id_evento'];

    // Incluir archivo de conexión
    require_once('conexion.php');

    // Verificar si hay una sesión de usuario activa
    if(isset($_SESSION['id_protectora'])) {
        // Obtener el ID de la protectora de la sesión
        $id_protectora = $_SESSION['id_protectora'];

        // Construir la consulta SQL para eliminar el evento, filtrando por la protectora actual
        $sql = "DELETE FROM evento WHERE id_evento = $evento_id AND id_protectora = $id_protectora";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Redireccionar a la página de gestión de eventos
            header('Location: gestionEventos.php');
            exit();
        } else {
            echo "Error al eliminar el evento: " . $conn->error;
        }
    } else {
        // Si no hay una sesión de usuario activa, redireccionar a la página de inicio de sesión
        header('Location: login.php');
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se ha seleccionado ningún evento, redireccionar a la página de gestión de eventos
    header('Location: gestionEventos.php');
    exit();
}
?>