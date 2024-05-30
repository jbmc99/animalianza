<?php

//aqui se hace lo mismo q acualizar estado solicitud adopcion pero con acogida
require_once('conexion.php');

if (isset($_GET['acepta_adopciones']) && isset($_GET['id_protectora'])) {
    $acepta_adopciones = $_GET['acepta_adopciones'];
    $id_protectora = $_GET['id_protectora'];

    $stmt = $conn->prepare("UPDATE protectora SET acepta_adopciones = ? WHERE id_protectora = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param('si', $acepta_adopciones, $id_protectora);

    if ($stmt->execute() === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    } else {
        echo "Actualización exitosa";
    }
} else {
    echo "Error: No se recibió el valor de aceptación de adopciones o el ID de la protectora";
}

$conn->close();
?>
