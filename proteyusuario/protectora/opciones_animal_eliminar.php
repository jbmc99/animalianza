<?php
require_once('conexion.php');

session_start();
if (!isset($_SESSION['id_protectora'])) {
    header("Location: login.php");
    exit();
}

$id_protectora = $_SESSION['id_protectora'];
$sql = "SELECT id_animal, nombre FROM animal WHERE id_protectora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_protectora);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $animales = array();

    while ($row = $result->fetch_assoc()) {
        $animal = array(
            'id' => $row['id_animal'],
            'nombre' => $row['nombre']
        );
        array_push($animales, $animal);
    }
    echo json_encode($animales);
} else {
    echo json_encode(array());
}

$stmt->close();
$conn->close();
?>