<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Consultar la base de datos para obtener las opciones de productos
$sql = "SELECT id_producto, nombre FROM producto";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar las opciones de productos
    $productos = array();

    // Iterar sobre los resultados y agregarlos al array
    while($row = $result->fetch_assoc()) {
        $producto = array(
            'id' => $row['id_producto'],
            'nombre' => $row['nombre']
        );
        array_push($productos, $producto);
    }

    // Devolver las opciones de productos en formato JSON
    echo json_encode($productos);
} else {
    // Si no hay productos, devolver un array vacío
    echo json_encode(array());
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
