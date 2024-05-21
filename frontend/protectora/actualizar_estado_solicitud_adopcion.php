<?php
require_once('conexion.php');

$id_solicitud_adopcion = $_GET['id_solicitud_adopcion'];
$nuevo_estado = $_GET['nuevo_estado'];

$sql = "UPDATE solicitud_adopcion SET estado = ? WHERE id_solicitud_adopcion = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("si", $nuevo_estado, $id_solicitud_adopcion);

$stmt->execute();

$stmt->close();
$conn->close();

?>