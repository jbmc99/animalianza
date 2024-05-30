<?php
// Conexión a la base de datos
require_once('conexion.php');

// Comprobar si los parámetros necesarios están presentes
if (!isset($_GET['id_solicitud_acogida']) || !isset($_GET['nuevo_estado'])) {
    echo 'Error: Faltan parámetros.';
    exit;
}

$id_solicitud_acogida = $_GET['id_solicitud_acogida'];
$nuevo_estado = $_GET['nuevo_estado'];

// Prepara la consulta SQL para actualizar el estado de la solicitud
$sql = "UPDATE solicitud_acogida SET estado = ? WHERE id_solicitud_acogida = ?";

// Prepara la declaración
$stmt = $conn->prepare($sql);

// Vincula los parámetros
$stmt->bind_param("si", $nuevo_estado, $id_solicitud_acogida);

// Ejecuta la declaración
if ($stmt->execute()) {
    echo 'El estado de la solicitud de acogida se ha actualizado correctamente.';
} else {
    echo 'Error: ' . $stmt->error;
}

// Cierra la declaración y la conexión
$stmt->close();
$conn->close();
?>