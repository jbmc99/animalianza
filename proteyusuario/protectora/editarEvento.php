<?php
//verificamos los datos recibidos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
    //obtenemos los datos del formulario
    $id_evento = $_POST['id_evento'];
    $nombreEvento = $_POST['nombreEvento'];
    $descripcionEvento = $_POST['descripcionEvento'];
    $fechaEvento = $_POST['fechaEvento'];

    require_once('conexion.php');

    if ($_FILES['fotoEvento']['size'] > 0) {
        $target_dir = "../images/uploads/";
        $target_file = $target_dir . basename($_FILES["fotoEvento"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
                $ruta_imagen = $target_file;
            } else {
                echo "Error al subir la imagen.";
                exit(); 
            }
        }
    }

    //hacemos la consulta sql para actualizar los datos del evento en la bd
    $sql = "UPDATE evento SET nombre='$nombreEvento', descripcion='$descripcionEvento', fecha='$fechaEvento'";
    if (isset($ruta_imagen)) {
        $sql .= ", ruta_imagen='$ruta_imagen'";
    }
    $sql .= " WHERE id_evento = $id_evento";
    if ($conn->query($sql) === TRUE) {
        header('Location: gestionEventos.php');
        exit();
    } else {
        echo "Error al actualizar el evento: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: gestionEventos.php');
    exit();
}
?>
