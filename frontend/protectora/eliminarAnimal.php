<?php
// Conectar a la base de datos
require_once('conexion.php');
session_start();

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Verificar si 'id_protectora' está en la sesión
if (!isset($_SESSION['id_protectora']) || !isset($_POST['id_animal'])) {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes']);
    exit();
}

$id_protectora = $_SESSION['id_protectora'];
$idAnimal = $_POST['id_animal'];

// Preparar la consulta SQL para eliminar el animal
$sqlEliminar = "DELETE FROM animal WHERE id_animal = ? AND id_protectora = ?";
$stmtEliminar = $conn->prepare($sqlEliminar);
$stmtEliminar->bind_param('ii', $idAnimal, $id_protectora);

// Ejecutar la consulta para eliminar el animal
if ($stmtEliminar->execute()) {
    echo json_encode(['success' => true, 'id_animal' => $idAnimal]);
} else {
    // Aquí se elimina la línea que imprime el mensaje de error como un alert
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el animal']);
}

// Cerrar la conexión a la base de datos
$stmtEliminar->close();
$conn->close();
?>

