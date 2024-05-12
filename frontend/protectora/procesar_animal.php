<?php
// Habilitar la visualización de errores en PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de conexión
require_once('conexion.php');

// Mensajes de error
$errors = [];

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si id_protectora está definida y es válida
    if (isset($_POST['id_protectora']) && is_numeric($_POST['id_protectora'])) {
        $id_protectora = $conn->real_escape_string($_POST['id_protectora']);

        // Obtener los datos del formulario
        $nombre = $conn->real_escape_string($_POST['nombreAnimal']);
        $especie = $conn->real_escape_string($_POST['especieAnimal']);
        $raza = $conn->real_escape_string($_POST['razaAnimal']);
        $edad = $conn->real_escape_string($_POST['edadAnimal']);
        $sexo = isset($_POST['sexoAnimal']) ? $conn->real_escape_string($_POST['sexoAnimal']) : ''; // Asegurarse de manejar correctamente la posible falta de este campo
        $info_adicional = isset($_POST['infoAnimal']) ? $conn->real_escape_string($_POST['infoAnimal']) : ''; // Asegurarse de manejar correctamente la posible falta de este campo

        // Verificar si se recibió una nueva imagen
        if (isset($_FILES["fotoAnimal"]) && $_FILES["fotoAnimal"]["error"] === UPLOAD_ERR_OK) {
            // Subir la nueva imagen
            $target_dir = "../images/uploads/";
            $target_file = $target_dir . basename($_FILES["fotoAnimal"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Verificar si el archivo es una imagen real
            $check = getimagesize($_FILES["fotoAnimal"]["tmp_name"]);
            if ($check === false) {
                $errors[] = "El archivo no es una imagen válida.";
            } else {
                // Permitir solo ciertos formatos de imagen
                $allowed_formats = array("jpg", "jpeg", "png", "gif");
                if (!in_array($imageFileType, $allowed_formats)) {
                    $errors[] = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                } else {
                    // Verificar el tamaño del archivo
                    if ($_FILES["fotoAnimal"]["size"] > 5 * 1024 * 1024) {
                        $errors[] = "El tamaño del archivo es demasiado grande.";
                    } else {
                        // Mover el archivo subido al directorio de imágenes
                        if (!move_uploaded_file($_FILES["fotoAnimal"]["tmp_name"], $target_file)) {
                            $errors[] = "Error al subir la imagen.";
                        }
                    }
                }
            }

            // Insertar el nuevo animal en la base de datos
            if (empty($errors)) {
                $sql_insert = "INSERT INTO animal (id_protectora, nombre, especie, raza, edad, sexo, info_adicional, ruta_imagen) VALUES ('$id_protectora', '$nombre', '$especie', '$raza', '$edad', '$sexo', '$info_adicional', '$target_file')";
                if ($conn->query($sql_insert)) {
                    // Redirigir a gestionAnimales.php
                    header("Location: gestionAnimales.php");
                    exit(); // Asegurar que se detenga la ejecución después de la redirección
                } else {
                    $errors[] = "Error al insertar el animal en la base de datos: " . $conn->error;
                }
            }
        } else {
            $errors[] = "No se recibió ninguna imagen del animal.";
        }
    } else {
        $errors[] = "ID de protectora no válida.";
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
