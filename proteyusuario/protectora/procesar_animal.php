<?php
//esto no es necesario pero es una buena práctica para evitar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('conexion.php');

$errors = [];

//verificamos si recibimos datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //y verificamos si recibimos el id de la protectora
    if (isset($_POST['id_protectora']) && is_numeric($_POST['id_protectora'])) {
        $id_protectora = $conn->real_escape_string($_POST['id_protectora']);

        //ahora se obtienen los datos del formulario
        $nombre = $conn->real_escape_string($_POST['nombreAnimal']);
        $especie = $conn->real_escape_string($_POST['especieAnimal']);
        $raza = $conn->real_escape_string($_POST['razaAnimal']);
        $edad = $conn->real_escape_string($_POST['edadAnimal']);
        $sexo = isset($_POST['sexoAnimal']) ? $conn->real_escape_string($_POST['sexoAnimal']) : ''; // Asegurarse de manejar correctamente la posible falta de este campo
        $info_adicional = isset($_POST['infoAnimal']) ? $conn->real_escape_string($_POST['infoAnimal']) : ''; // Asegurarse de manejar correctamente la posible falta de este campo

        if (isset($_FILES["fotoAnimal"]) && $_FILES["fotoAnimal"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "../images/uploads/";
            $target_file = $target_dir . basename($_FILES["fotoAnimal"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["fotoAnimal"]["tmp_name"]);
            if ($check === false) {
                $errors[] = "El archivo no es una imagen válida.";
            } else {
                $allowed_formats = array("jpg", "jpeg", "png", "gif");
                if (!in_array($imageFileType, $allowed_formats)) {
                    $errors[] = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                } else {
                    if ($_FILES["fotoAnimal"]["size"] > 5 * 1024 * 1024) {
                        $errors[] = "El tamaño del archivo es demasiado grande.";
                    } else {
                        if (!move_uploaded_file($_FILES["fotoAnimal"]["tmp_name"], $target_file)) {
                            $errors[] = "Error al subir la imagen.";
                        }
                    }
                }
            }
        }

        //insertamos o actualizamos el animal en la base de datos
        if (empty($errors)) {
            if (isset($_POST['id_animal']) && is_numeric($_POST['id_animal'])) {
                $id_animal = $conn->real_escape_string($_POST['id_animal']);
                if (isset($target_file)) {
                    $sql = "UPDATE animal SET nombre = '$nombre', especie = '$especie', raza = '$raza', edad = '$edad', sexo = '$sexo', info_adicional = '$info_adicional', ruta_imagen = '$target_file' WHERE id_animal = '$id_animal' AND id_protectora = '$id_protectora'";
                } else {
                    $sql = "UPDATE animal SET nombre = '$nombre', especie = '$especie', raza = '$raza', edad = '$edad', sexo = '$sexo', info_adicional = '$info_adicional' WHERE id_animal = '$id_animal' AND id_protectora = '$id_protectora'";
                }
            } else {
                $sql = "INSERT INTO animal (id_protectora, nombre, especie, raza, edad, sexo, info_adicional, ruta_imagen) VALUES ('$id_protectora', '$nombre', '$especie', '$raza', '$edad', '$sexo', '$info_adicional', '$target_file')";
            }

            if ($conn->query($sql)) {
                header("Location: gestionAnimales.php");
                exit(); 
            } else {
                $errors[] = "Error al insertar o actualizar el animal en la base de datos: " . $conn->error;
            }
        }
    } else {
        $errors[] = "ID de protectora no válida.";
    }
} else {
    $errors[] = "No se recibieron datos del formulario.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p>Error: $error</p>";
    }
}

$conn->close();
?>