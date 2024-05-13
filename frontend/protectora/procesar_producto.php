<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Mensajes de error
$errors = [];

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos requeridos no estén vacíos
    if (empty($_POST['nombreProducto']) || empty($_POST['descripcionProducto']) || empty($_POST['precioProducto'])) {
        $errors[] = "Todos los campos son requeridos.";
    } else {
        // Obtener los datos del formulario
        $nombreProducto = $conn->real_escape_string($_POST['nombreProducto']);
        $descripcionProducto = $conn->real_escape_string($_POST['descripcionProducto']);
        $precioProducto = $conn->real_escape_string($_POST['precioProducto']);

        // Verificar si se recibió una nueva imagen
        if (isset($_FILES["fotoProducto"]) && $_FILES["fotoProducto"]["error"] === UPLOAD_ERR_OK) {
            // Subir la nueva imagen
            $target_dir = "../images/uploads/";
            $target_file = $target_dir . basename($_FILES["fotoProducto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Verificar si el archivo es una imagen real
            $check = getimagesize($_FILES["fotoProducto"]["tmp_name"]);
            if ($check === false) {
                $errors[] = "El archivo no es una imagen válida.";
            } else {
                // Permitir solo ciertos formatos de imagen
                $allowed_formats = array("jpg", "jpeg", "png", "gif");
                if (!in_array($imageFileType, $allowed_formats)) {
                    $errors[] = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                } else {
                    // Verificar el tamaño del archivo
                    if ($_FILES["fotoProducto"]["size"] > 5 * 1024 * 1024) {
                        $errors[] = "El tamaño del archivo es demasiado grande.";
                    } else {
                        // Mover el archivo subido al directorio de imágenes
                        if (!move_uploaded_file($_FILES["fotoProducto"]["tmp_name"], $target_file)) {
                            $errors[] = "Error al subir la imagen.";
                        }
                    }
                }
            }

            // Insertar los datos en la base de datos junto con la ruta de la imagen
            if (empty($errors)) {
                $sql = "INSERT INTO producto (nombre, descripcion, precio, ruta_imagen) 
                        VALUES ('$nombreProducto', '$descripcionProducto', '$precioProducto', '$target_file')";

                if ($conn->query($sql) === TRUE) {
                    // Redirigir a la página de gestión de productos
                    header("Location: gestionProductos.php");
                    exit();
                } else {
                    // Manejar el caso de error al insertar en la base de datos
                    $errors[] = "Error al guardar el producto en la base de datos: " . $conn->error;
                }
            }
        } else {
            $errors[] = "No se recibió ninguna imagen del producto.";
        }
    }
} else {
    // Si no se recibieron datos del formulario, mostrar un mensaje de error
    $errors[] = "No se recibieron datos del formulario.";
}

// Mostrar mensajes de error si los hay
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p>Error: $error</p>";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
