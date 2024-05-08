<?php
// Verificar si se han recibido los datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_animal'])) {
    // Obtener los datos del formulario
    $id_animal = $_POST['id_animal'];
    $nombreAnimal = $_POST['nombreAnimal'];
    // Agrega aquí más campos para obtener los datos del formulario (especie, raza, edad, etc.)

    // Incluir archivo de conexión
    require_once('conexion.php');

    // Verificar si se ha subido una nueva imagen
    if ($_FILES['fotoAnimal']['size'] > 0) {
        // Manejar la subida de la nueva imagen
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
                echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                $uploadOk = 0;
            }
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }

        // Verificar el tamaño del archivo
        if ($_FILES["fotoAnimal"]["size"] > 5 * 1024 * 1024) {
            echo "El tamaño del archivo es demasiado grande.";
            $uploadOk = 0;
        }

        // Verificar si $uploadOk está configurado en 0 por un error
        if ($uploadOk == 0) {
            echo "El archivo no fue subido.";
        // Si todo está bien, intentar subir el archivo
        } else {
            if (move_uploaded_file($_FILES["fotoAnimal"]["tmp_name"], $target_file)) {
                // Actualizar la ruta de la imagen en la base de datos
                $ruta_imagen = $target_file;
            } else {
                // Manejar el caso de error al mover el archivo subido
                echo "Error al subir la imagen.";
                exit(); // Salir del script si hay un error
            }
        }
    }

    // Construir la consulta SQL para actualizar el animal, incluyendo la ruta de la imagen si se actualizó
    $sql = "UPDATE animal SET nombre='$nombreAnimal'";
    // Agrega aquí más campos para actualizar en la base de datos (especie, raza, edad, etc.)
    if (isset($ruta_imagen)) {
        $sql .= ", ruta_imagen='$ruta_imagen'";
    }
    $sql .= " WHERE id_animal = $id_animal";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de gestión de animales
        header('Location: gestionAnimales.php');
        exit();
    } else {
        echo "Error al actualizar el animal: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se han recibido los datos esperados, redirigir a la página de gestión de animales
    header('Location: gestionAnimales.php');
    exit();
}
?>
