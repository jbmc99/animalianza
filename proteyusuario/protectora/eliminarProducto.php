<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    
    require_once('conexion.php');

    $sql = "DELETE FROM producto WHERE id_producto = $id_producto";

    if ($conn->query($sql) === TRUE) {
        header('Location: gestionProductos.php');
        exit();
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: gestionProductos.php');
    exit();
}
?>