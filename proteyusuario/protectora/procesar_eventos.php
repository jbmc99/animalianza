<?php
session_start();
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_protectora = $_SESSION['id_protectora'];

    $nombreEvento = $conn->real_escape_string($_POST['nombreEvento']);
    $descripcionEvento = $conn->real_escape_string($_POST['descripcionEvento']);
    $fechaEvento = $conn->real_escape_string($_POST['fechaEvento']);
    $estadoEvento = $conn->real_escape_string($_POST['estadoEvento']);
    $target_dir = "../images/uploads/";
    $target_file = $target_dir . basename($_FILES["fotoEvento"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fotoEvento"]["tmp_name"]);
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

    if ($_FILES["fotoEvento"]["size"] > 5 * 1024 * 1024) {
        echo "El tamaño del archivo es demasiado grande.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "El archivo no fue subido.";
    } else {
        if (move_uploaded_file($_FILES["fotoEvento"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO evento (nombre, descripcion, fecha, estado, ruta_imagen, id_protectora) 
            VALUES ('$nombreEvento', '$descripcionEvento', '$fechaEvento', '$estadoEvento', '$target_file', '$id_protectora')";

            if ($conn->query($sql) === TRUE) {
                header("Location: gestionEventos.php");
                exit();
            } else {
                echo "Error al guardar el evento en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al subir la imagen.";
        }
    }
}

$conn->close();
?>