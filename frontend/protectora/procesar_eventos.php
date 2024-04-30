<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreEvento = $conn->real_escape_string($_POST['nombreEvento']);
    $descripcionEvento = $conn->real_escape_string($_POST['descripcionEvento']);
    $fechaEvento = $conn->real_escape_string($_POST['fechaEvento']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO evento (nombre, descripcion, fecha) 
            VALUES ('$nombreEvento', '$descripcionEvento', '$fechaEvento')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de gestión de eventos
        header("Location: gestionEventos.php");
        exit();
    } else {
        // Manejar el caso de error al insertar en la base de datos
        echo "Error al guardar el evento en la base de datos: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
