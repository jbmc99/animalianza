<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreProducto = $conn->real_escape_string($_POST['nombreProducto']);
    $descripcionProducto = $conn->real_escape_string($_POST['descripcionProducto']);
    $precioProducto = $conn->real_escape_string($_POST['precioProducto']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO producto (nombre, descripcion, precio) 
            VALUES ('$nombreProducto', '$descripcionProducto', '$precioProducto')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de gestión de productos
        header("Location: gestionProductos.php");
        exit();
    } else {
        // Manejar el caso de error al insertar en la base de datos
        echo "Error al guardar el producto en la base de datos: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
