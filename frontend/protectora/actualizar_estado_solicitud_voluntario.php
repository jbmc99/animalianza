<?php
// Conexión a la base de datos
require_once('conexion.php');

// Obtén el id de la solicitud y el nuevo estado de la solicitud
$id_solicitud_voluntariado = $_GET['id_solicitud_voluntariado'];
$nuevo_estado = $_GET['nuevo_estado'];

// Prepara la consulta SQL para actualizar el estado de la solicitud
$sql = "UPDATE solicitud_voluntariado SET estado = ? WHERE id_solicitud_voluntariado = ?";

// Prepara la declaración
$stmt = $conn->prepare($sql);

// Vincula los parámetros
$stmt->bind_param("si", $nuevo_estado, $id_solicitud_voluntariado);

// Ejecuta la declaración
$stmt->execute();

// Cierra la declaración y la conexión
$stmt->close();
$conn->close();
?>