<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreProducto = $conn->real_escape_string($_POST['nombreProducto']);
    $descripcionProducto = $conn->real_escape_string($_POST['descripcionProducto']);
    $precioProducto = $conn->real_escape_string($_POST['precioProducto']);

    // Manejar la subida de la imagen
    $target_dir = "../images/uploads/";
    $target_file = $target_dir . basename($_FILES["fotoProducto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
            // Insertar los datos en la base de datos junto con la ruta de la imagen
            $sql = "INSERT INTO producto (nombre, descripcion, precio, ruta_imagen) 
                    VALUES ('$nombreProducto', '$descripcionProducto', '$precioProducto', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                // Redirigir a la página de gestión de productos
                header("Location: gestionProductos.php");
                exit();
            } else {
                // Manejar el caso de error al insertar en la base de datos
                echo "Error al guardar el producto en la base de datos: " . $conn->error;
            }
        } else {
            // Manejar el caso de error al mover el archivo subido
            echo "Error al subir la imagen.";
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
