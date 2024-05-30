<?php
require_once('conexion.php');
session_start();

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

//verificamos si se han recibido los datos esperados y si el usuario está autenticado
if (!isset($_SESSION['id_protectora']) || !isset($_POST['id_animal'])) {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes']);
    exit();
}

//obtenemos el id_protectora de la sesión y el id_animal del formulario
$id_protectora = $_SESSION['id_protectora'];
$idAnimal = $_POST['id_animal'];

//consulta para eliminar el animal
$sqlEliminar = "DELETE FROM animal WHERE id_animal = ? AND id_protectora = ?";
$stmtEliminar = $conn->prepare($sqlEliminar);
$stmtEliminar->bind_param('ii', $idAnimal, $id_protectora);

//se ejecuta la consulta y se verifica si se ha eliminado el animal
if ($stmtEliminar->execute()) {
    echo json_encode(['success' => true, 'id_animal' => $idAnimal]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el animal']);
}

$stmtEliminar->close();
$conn->close();
?>

