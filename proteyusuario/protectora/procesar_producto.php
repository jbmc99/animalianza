<?php
session_start();
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_protectora = $_SESSION['id_protectora'];

    $nombreProducto = $conn->real_escape_string($_POST['nombreProducto']);
    $descripcionProducto = $conn->real_escape_string($_POST['descripcionProducto']);
    $precioProducto = $conn->real_escape_string($_POST['precioProducto']);
    $target_dir = "../images/uploads/";
    $target_file = $target_dir . basename($_FILES["fotoProducto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
            $sql = "INSERT INTO producto (id_protectora, nombre, descripcion, precio, ruta_imagen) 
            VALUES ('$id_protectora', '$nombreProducto', '$descripcionProducto', '$precioProducto', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: gestionProductos.php");
                exit();
            } else {
                echo "Error al guardar el producto en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al subir la imagen.";
        }
    }
}

$conn->close();
?>