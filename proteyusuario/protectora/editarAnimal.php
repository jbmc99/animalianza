<?php
session_start();

if (!isset($_SESSION['id_protectora'])) {
    header('Location: iniciar_sesion.php');
    exit(); 
}

$id_protectora = $_SESSION['id_protectora'];

//verificamos si se han recibido los datos esperados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_animal'])) {
    require_once('conexion.php');

    //obtenemos los datos del formulario y los limpiamos para evitar inyecciones de SQL (aunque no es necesario en este caso, ya que no se muestran en la página)
    $id_animal = $conn->real_escape_string($_POST['id_animal']);
    $nombreAnimal = $conn->real_escape_string($_POST['nombreAnimal']);
    $especieAnimal = $conn->real_escape_string($_POST['especieAnimal']);
    $razaAnimal = $conn->real_escape_string($_POST['razaAnimal']);
    $edadAnimal = $conn->real_escape_string($_POST['edadAnimal']);
    $sexoAnimal = $conn->real_escape_string($_POST['sexoAnimal']);
    $info_adicional = $conn->real_escape_string($_POST['info_adicional']);

    if ($_FILES['fotoAnimal']['size'] > 0) {
        $target_dir = "../images/uploads/";
        $target_file = $target_dir . basename($_FILES["fotoAnimal"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fotoAnimal"]["tmp_name"]);
        if ($check === false) {
            echo "El archivo no es una imagen válida.";
            exit();
        }

        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_formats)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit();
        }

        if ($_FILES["fotoAnimal"]["size"] > 5 * 1024 * 1024) {
            echo "El tamaño del archivo es demasiado grande.";
            exit();
        }

        if (!move_uploaded_file($_FILES["fotoAnimal"]["tmp_name"], $target_file)) {
            echo "Error al subir la imagen.";
            exit();
        }

        $ruta_imagen = $target_file;
        $sql_imagen = ", ruta_imagen='$ruta_imagen'";
    } else {
        $sql_imagen = ""; 
    }

    //consulta sql para actualizar los datos del animal
    $sql = "UPDATE animal SET nombre='$nombreAnimal', especie='$especieAnimal', raza='$razaAnimal', edad='$edadAnimal', sexo='$sexoAnimal', info_adicional='$info_adicional'" . $sql_imagen . " WHERE id_animal = $id_animal";
    if ($conn->query($sql) === TRUE) {
        header('Location: gestionAnimales.php');
        exit();
    } else {
        echo "Error al actualizar el animal: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: gestionAnimales.php');
    exit();
}
?>
