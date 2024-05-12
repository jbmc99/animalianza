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
    // Obtener el ID del animal a editar
    $id_animal = $conn->real_escape_string($_POST['id_animal']);

    // Obtener el ID de la protectora que ha iniciado sesión (supongamos que el ID se almacena en la sesión)
    session_start();
    $id_protectora = $_SESSION['id_protectora'];

    // Verificar si el animal pertenece a la protectora que ha iniciado sesión
    $sql_check = "SELECT id_protectora FROM animal WHERE id_animal = '$id_animal'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $row_check = $result_check->fetch_assoc();
        if ($row_check['id_protectora'] != $id_protectora) {
            $errors[] = "Este animal no pertenece a tu protectora.";
        }
    } else {
        $errors[] = "No se encontró el animal.";
    }

    if (empty($errors)) {
        // Obtener la información del animal a partir de su ID
        $sql_select = "SELECT ruta_imagen FROM animal WHERE id_animal = '$id_animal'";
        $result_select = $conn->query($sql_select);

        // Verificar si la consulta se ejecutó correctamente
        if ($result_select === false) {
            $errors[] = 'Error al obtener la información del animal: ' . $conn->error;
        } else {
            $row = $result_select->fetch_assoc();
            $ruta_imagen_anterior = $row['ruta_imagen'];

            // Obtener los datos del formulario
            $nombre = $conn->real_escape_string($_POST['nombreAnimal']);
            $especie = $conn->real_escape_string($_POST['especieAnimal']);
            $raza = $conn->real_escape_string($_POST['razaAnimal']);
            $edad = $conn->real_escape_string($_POST['edadAnimal']);
            $sexo = $conn->real_escape_string($_POST['sexoAnimal']);
            $info_adicional = isset($_POST['info_adicional']) ? $conn->real_escape_string($_POST['info_adicional']) : '';

            // Verificar si se recibió una nueva imagen
            if (isset($_FILES["fotoAnimal"]) && $_FILES["fotoAnimal"]["error"] === UPLOAD_ERR_OK) {
                // Eliminar la imagen anterior si existe
                if (!empty($ruta_imagen_anterior) && file_exists($ruta_imagen_anterior)) {
                    unlink($ruta_imagen_anterior);
                }

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

                // Actualizar la información del animal en la base de datos, incluida la nueva imagen
                $sql_update = "UPDATE animal SET nombre = '$nombre', especie = '$especie', raza = '$raza', edad = '$edad', sexo = '$sexo', info_adicional = '$info_adicional', ruta_imagen = '$target_file' WHERE id_animal = '$id_animal'";
            } else {
                // Si no se subió una nueva imagen, actualizar todos los campos excepto la imagen
                $sql_update = "UPDATE animal SET nombre = '$nombre', especie = '$especie', raza = '$raza', edad = '$edad', sexo = '$sexo', info_adicional = '$info_adicional' WHERE id_animal = '$id_animal'";
            }

            // Ejecutar la consulta de actualización
            if (!$conn->query($sql_update)) {
                $errors[] = "Error al actualizar la información del animal: " . $conn->error;
            }
        }
    }

    // Redirigir a la página de gestión de animales
    header("Location: gestionAnimales.php");
    exit();
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
