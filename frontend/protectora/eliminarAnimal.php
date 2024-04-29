<?php
// Conectar a la base de datos
require_once('conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtener el ID del animal desde la solicitud POST
$idAnimal = $_POST['id_animal'];

// Preparar la consulta SQL
$sql = "DELETE FROM animal WHERE id_animal = ?";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Vincular los parámetros
$stmt->bind_param('i', $idAnimal);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

// Cerrar la conexión
$conn->close();
?>