<?php
require_once('../protectora/conexion.php');

// Obtener los datos de la solicitud
$id_solicitud_adopcion = $_GET['id_solicitud_adopcion'];
$nuevo_estado = $_GET['nuevo_estado'];

// Actualizar el estado de la solicitud en la base de datos
$sql = "UPDATE solicitud_adopcion SET estado = ? WHERE id_solicitud_adopcion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nuevo_estado, $id_solicitud_adopcion);

if ($stmt->execute()) {
    echo "Estado actualizado correctamente.";
} else {
    echo "Error al actualizar el estado: " . $stmt->error;
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>
