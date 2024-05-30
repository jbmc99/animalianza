<?php
require_once('../protectora/conexion.php');

//se obtienen los datos de la solicitud de adopcion y el nuevo estado
$id_solicitud_adopcion = $_GET['id_solicitud_adopcion'];
$nuevo_estado = $_GET['nuevo_estado'];

//y se actualizan en la bbdd
$sql = "UPDATE solicitud_adopcion SET estado = ? WHERE id_solicitud_adopcion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nuevo_estado, $id_solicitud_adopcion);

if ($stmt->execute()) {
    echo "Estado actualizado correctamente.";
} else {
    echo "Error al actualizar el estado: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
