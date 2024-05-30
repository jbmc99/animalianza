<?php
// Incluir el archivo de conexión a la base de datos
require_once('conexion.php');

// Verificar si se ha recibido el valor de aceptación de acogidas y el ID de la protectora
if (isset($_GET['acepta_acogidas']) && isset($_GET['id_protectora'])) {
    $acepta_acogidas = $_GET['acepta_acogidas'];
    $id_protectora = $_GET['id_protectora'];

    // Preparar la consulta SQL
    $stmt = $conn->prepare("UPDATE protectora SET acepta_acogidas = ? WHERE id_protectora = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular los parámetros a la consulta preparada
    $stmt->bind_param('si', $acepta_acogidas, $id_protectora);

    // Ejecutar la consulta
    if ($stmt->execute() === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    } else {
        echo "Actualización exitosa";
    }
} else {
    // Si no se recibió el valor esperado, devolver un mensaje de error
    echo "Error: No se recibió el valor de aceptación de acogidas o el ID de la protectora";
}

// Cerrar conexión
$conn->close();
?>

