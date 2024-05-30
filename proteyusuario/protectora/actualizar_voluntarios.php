<?php
// Incluir el archivo de conexión a la base de datos
require_once('conexion.php');

// Verificar si se ha recibido el valor de aceptación de adopciones y el ID de la protectora
if (isset($_GET['acepta_voluntarios']) && isset($_GET['id_protectora'])) {
    $acepta_voluntarios = $_GET['acepta_voluntarios'];
    $id_protectora = $_GET['id_protectora'];

    // Preparar la consulta SQL
    $stmt = $conn->prepare("UPDATE protectora SET acepta_voluntarios = ? WHERE id_protectora = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular los parámetros a la consulta preparada
    $stmt->bind_param('si', $acepta_voluntarios, $id_protectora);

    // Ejecutar la consulta
    if ($stmt->execute() === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    } else {
        echo "Actualización exitosa";
    }
} else {
    // Si no se recibió el valor esperado, devolver un mensaje de error
    echo "Error: No se recibió el valor de aceptación de voluntarios o el ID de la protectora";
}

// Cerrar conexión
$conn->close();
?>
