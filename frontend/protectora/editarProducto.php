<?php
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $nombreProducto = mysqli_real_escape_string($conn, $_POST['nombreProducto']);
    $descripcionProducto = mysqli_real_escape_string($conn, $_POST['descripcionProducto']);
    $precioProducto = mysqli_real_escape_string($conn, $_POST['precioProducto']);

    if (!empty($nombreProducto) && !empty($descripcionProducto) && !empty($precioProducto) && !empty($id_producto)) {
        $sql = "UPDATE producto SET nombre='$nombreProducto', descripcion='$descripcionProducto', precio='$precioProducto' WHERE id_producto = $id_producto";

        if ($conn->query($sql) === TRUE) {
            header('Location: gestionProductos.php');
            exit();
        } else {
            echo "Error al actualizar el producto: " . $conn->error;
        }
    } else {
        echo "Error: Algunos campos están vacíos.";
        // Código de depuración para ver qué campos están vacíos
        echo "<br>id_producto: " . var_export($id_producto, true);
        echo "<br>nombreProducto: " . var_export($nombreProducto, true);
        echo "<br>descripcionProducto: " . var_export($descripcionProducto, true);
        echo "<br>precioProducto: " . var_export($precioProducto, true);
    }

    $conn->close();
} else {
    header('Location: gestionProductos.php');
    exit();
}
?>
