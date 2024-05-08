<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Mensajes de error
$errors = [];

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombreAnimal']);
    $especie = $conn->real_escape_string($_POST['especieAnimal']);
    $raza = $conn->real_escape_string($_POST['razaAnimal']);
    $edad = $conn->real_escape_string($_POST['edadAnimal']);
    $info_adicional = $conn->real_escape_string($_POST['infoAnimal']);

    // Manejar la subida de la imagen del animal
    $target_dir = "../images/uploads/";
    $target_file = $target_dir . basename($_FILES["fotoAnimal"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["fotoAnimal"]["tmp_name"]);
    if($check !== false) {
        // Permitir solo ciertos formatos de imagen
        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        if(!in_array($imageFileType, $allowed_formats)) {
            $errors[] = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            $uploadOk = 0;
        }
    } else {
        $errors[] = "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo
    if ($_FILES["fotoAnimal"]["size"] > 5 * 1024 * 1024) {
        $errors[] = "El tamaño del archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk está configurado en 0 por un error
    if ($uploadOk == 0) {
        $errors[] = "El archivo no fue subido.";
    // Si todo está bien, intentar subir el archivo
    } else {
        if (move_uploaded_file($_FILES["fotoAnimal"]["tmp_name"], $target_file)) {
            // Insertar los datos en la base de datos junto con la ruta de la imagen
            $sql = "INSERT INTO animal (nombre, especie, raza, edad, info_adicional, ruta_imagen) 
                    VALUES ('$nombre', '$especie', '$raza', '$edad', '$info_adicional', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                // Obtener el ID del animal que acabamos de insertar
                $animal_id = $conn->insert_id;

                // Redirigir a la página de gestión de animales
                header("Location: gestionAnimales.php");
                exit();
            } else {
                // Manejar el caso de error al insertar en la base de datos
                $errors[] = "Error al guardar el animal en la base de datos: " . $conn->error;
            }
        } else {
            // Manejar el caso de error al mover el archivo subido
            $errors[] = "Error al subir la imagen.";
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
