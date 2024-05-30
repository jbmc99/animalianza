<?php
require_once('conexion.php');
//obtenemos el id de la solicitud de voluntariado y el nuevo estado
$id_solicitud_voluntariado = $_GET['id_solicitud_voluntariado'];
$nuevo_estado = $_GET['nuevo_estado'];

$sql = "UPDATE solicitud_voluntariado SET estado = ? WHERE id_solicitud_voluntariado = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nuevo_estado, $id_solicitud_voluntariado);

$stmt->execute();
$stmt->close();
$conn->close();
?>