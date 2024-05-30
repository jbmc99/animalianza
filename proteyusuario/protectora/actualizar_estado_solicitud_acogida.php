<?php
require_once('conexion.php');

if (!isset($_GET['id_solicitud_acogida']) || !isset($_GET['nuevo_estado'])) {
    echo 'Error: Faltan parámetros.';
    exit;
}

$id_solicitud_acogida = $_GET['id_solicitud_acogida'];
$nuevo_estado = $_GET['nuevo_estado'];

$sql = "UPDATE solicitud_acogida SET estado = ? WHERE id_solicitud_acogida = ?";

$stmt = $conn->prepare($sql);


//compramos si la consulta se preparó correctamente
$stmt->bind_param("si", $nuevo_estado, $id_solicitud_acogida);

//ejecutamos la declaracion
if ($stmt->execute()) {
    echo 'El estado de la solicitud de acogida se ha actualizado correctamente.';
} else {
    echo 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>