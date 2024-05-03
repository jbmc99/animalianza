<?php
// Verificar si se recibió el ID del producto a eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    // Obtener el ID del producto a eliminar
    $id_producto = $_POST['id_producto'];

    // Incluir archivo de conexión
    require_once('conexion.php');

    // Construir la consulta SQL para eliminar el producto
    $sql = "DELETE FROM producto WHERE id_producto = $id_producto";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Preparar la respuesta en formato JSON
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Preparar la respuesta en formato JSON con mensaje de error
        $response = array('success' => false, 'error' => $conn->error);
        echo json_encode($response);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se recibió el ID del producto, devolver error en formato JSON
    $response = array('success' => false, 'error' => 'ID de producto no recibido');
    echo json_encode($response);
}
?>

