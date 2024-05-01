<?php
// Verificar si se han recibido los datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
    // Obtener los datos del formulario
    $id_evento = $_POST['id_evento'];
    $nombreEvento = $_POST['nombreEvento'];
    $descripcionEvento = $_POST['descripcionEvento'];
    $fechaEvento = $_POST['fechaEvento'];

    // Incluir archivo de conexión
    require_once('conexion.php');

    // Construir la consulta SQL para actualizar el evento
    $sql = "UPDATE evento SET nombre='$nombreEvento', descripcion='$descripcionEvento', fecha='$fechaEvento' WHERE id_evento = $id_evento";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de gestión de eventos
        header('Location: gestionEventos.php');
        exit();
    } else {
        echo "Error al actualizar el evento: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se han recibido los datos esperados, redirigir a la página de gestión de eventos
    header('Location: gestionEventos.php');
    exit();
}
?>
