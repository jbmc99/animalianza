<?php
require_once('conexion.php');
session_start();

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

if (!isset($_SESSION['id_protectora']) || !isset($_POST['id_animal'])) {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes']);
    exit();
}

$id_protectora = $_SESSION['id_protectora'];
$idAnimal = $_POST['id_animal'];

$sqlEliminar = "DELETE FROM animal WHERE id_animal = ? AND id_protectora = ?";
$stmtEliminar = $conn->prepare($sqlEliminar);
$stmtEliminar->bind_param('ii', $idAnimal, $id_protectora);

if ($stmtEliminar->execute()) {
    echo json_encode(['success' => true, 'id_animal' => $idAnimal]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el animal']);
}

$stmtEliminar->close();
$conn->close();
?>
