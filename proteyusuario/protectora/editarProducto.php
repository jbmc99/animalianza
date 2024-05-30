<?php
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $nombreProducto = mysqli_real_escape_string($conn, $_POST['nombreProducto']);
    $descripcionProducto = mysqli_real_escape_string($conn, $_POST['descripcionProducto']);
    $precioProducto = mysqli_real_escape_string($conn, $_POST['precioProducto']);

    // Verificar si se ha subido una nueva imagen
    if ($_FILES['fotoProducto']['size'] > 0) {
        // Manejar la subida de la nueva imagen
        $target_dir = "../images/uploads/";
        $target_file = $target_dir . basename($_FILES["fotoProducto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        $check = getimagesize($_FILES["fotoProducto"]["tmp_name"]);
        if($check !== false) {
            // Permitir solo ciertos formatos de imagen
            $allowed_formats = array("jpg", "jpeg", "png", "gif");
            if(!in_array($imageFileType, $allowed_formats)) {
                echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                $uploadOk = 0;
            }
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }

        // Verificar el tamaño del archivo
        if ($_FILES["fotoProducto"]["size"] > 5 * 1024 * 1024) {
            echo "El tamaño del archivo es demasiado grande.";
            $uploadOk = 0;
        }

        // Verificar si $uploadOk está configurado en 0 por un error
        if ($uploadOk == 0) {
            echo "El archivo no fue subido.";
        // Si todo está bien, intentar subir el archivo
        } else {
            if (move_uploaded_file($_FILES["fotoProducto"]["tmp_name"], $target_file)) {
                // Actualizar la ruta de la imagen en la base de datos
                $ruta_imagen = $target_file;
            } else {
                // Manejar el caso de error al mover el archivo subido
                echo "Error al subir la imagen.";
                exit(); // Salir del script si hay un error
            }
        }
    }

    // Construir la consulta SQL para actualizar el producto, incluyendo la ruta de la imagen si se actualizó
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
