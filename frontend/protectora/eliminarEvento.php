<?php
// Verificar si se ha seleccionado un evento para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
    // Obtener el ID del evento seleccionado
    $evento_id = $_POST['id_evento'];

    // Incluir archivo de conexión
    require_once('conexion.php');

    // Construir la consulta SQL para eliminar el evento
    $sql = "DELETE FROM evento WHERE id_evento = $evento_id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de gestión de eventos
        header('Location: gestionEventos.php');
        exit();
    } else {
        echo "Error al eliminar el evento: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se ha seleccionado ningún evento, redireccionar a la página de gestión de eventos
    header('Location: gestionEventos.php');
    exit();
}
?>
