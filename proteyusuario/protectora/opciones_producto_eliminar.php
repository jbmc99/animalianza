<?php
require_once('conexion.php');
session_start();
$id_protectora = $_SESSION['id_protectora'];
$sql = "SELECT id_producto, nombre FROM producto WHERE id_protectora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_protectora);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $productos = array();
    while($row = $result->fetch_assoc()) {
        $producto = array(
            'id' => $row['id_producto'],
            'nombre' => $row['nombre']
        );
        array_push($productos, $producto);
    }
    echo json_encode($productos);
} else {
    echo json_encode(array());
}

$stmt->close();
$conn->close();
?>