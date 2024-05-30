<!--aqui igual que el los otros archivos de editar, se obtienen los datos del formulario y se actualiza el producto en la base de datos-->
<?php
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $nombreProducto = mysqli_real_escape_string($conn, $_POST['nombreProducto']);
    $descripcionProducto = mysqli_real_escape_string($conn, $_POST['descripcionProducto']);
    $precioProducto = mysqli_real_escape_string($conn, $_POST['precioProducto']);

    if ($_FILES['fotoProducto']['size'] > 0) {
        $target_dir = "../images/uploads/";
        $target_file = $target_dir . basename($_FILES["fotoProducto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fotoProducto"]["tmp_name"]);
        if($check !== false) {
            $allowed_formats = array("jpg", "jpeg", "png", "gif");
            if(!in_array($imageFileType, $allowed_formats)) {
                echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                $uploadOk = 0;
            }
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }
        if ($_FILES["fotoProducto"]["size"] > 5 * 1024 * 1024) {
            echo "El tamaño del archivo es demasiado grande.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "El archivo no fue subido.";
        } else {
            if (move_uploaded_file($_FILES["fotoProducto"]["tmp_name"], $target_file)) {
                $ruta_imagen = $target_file;
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        }
    }

    
    $sql = "UPDATE producto SET nombre='$nombreProducto', descripcion='$descripcionProducto', precio='$precioProducto'";
    if (isset($ruta_imagen)) {
        $sql .= ", ruta_imagen='$ruta_imagen'";
    }
    $sql .= " WHERE id_producto = $id_producto";

    if (!empty($nombreProducto) && !empty($descripcionProducto) && !empty($precioProducto) && !empty($id_producto)) {
        if ($conn->query($sql) === TRUE) {
            header('Location: gestionProductos.php');
            exit();
        } else {
            echo "Error al actualizar el producto: " . $conn->error;
        }
    } else {
        echo "Error: Algunos campos están vacíos.";
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
