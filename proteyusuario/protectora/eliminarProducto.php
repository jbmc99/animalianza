<?php
// Verificar si se ha seleccionado un producto para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    // Obtener el ID del producto seleccionado
    $id_producto = $_POST['id_producto'];

    // Incluir archivo de conexión
    require_once('conexion.php');

    // Construir la consulta SQL para eliminar el producto
    $sql = "DELETE FROM producto WHERE id_producto = $id_producto";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de gestión de productos
        header('Location: gestionProductos.php');
        exit();
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se ha seleccionado ningún producto, redireccionar a la página de gestión de productos
    header('Location: gestionProductos.php');
    exit();
}
?>