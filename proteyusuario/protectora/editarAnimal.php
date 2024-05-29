<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión contiene el ID de protectora
if (!isset($_SESSION['id_protectora'])) {
    // Si el ID de protectora no está establecido en la sesión, redirigir a la página de inicio de sesión
    header('Location: iniciar_sesion.php');
    exit(); // Salir del script para evitar ejecución adicional
}

// Obtener el ID de protectora de la sesión
$id_protectora = $_SESSION['id_protectora'];

// Verificar si se han recibido los datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_animal'])) {
    // Incluir archivo de conexión
    require_once('conexion.php');

    // Obtener los datos del formulario y limpiarlos para evitar inyección SQL
    $id_animal = $conn->real_escape_string($_POST['id_animal']);
    $nombreAnimal = $conn->real_escape_string($_POST['nombreAnimal']);
    $especieAnimal = $conn->real_escape_string($_POST['especieAnimal']);
    $razaAnimal = $conn->real_escape_string($_POST['razaAnimal']);
    $edadAnimal = $conn->real_escape_string($_POST['edadAnimal']);
    $sexoAnimal = $conn->real_escape_string($_POST['sexoAnimal']);
    $info_adicional = $conn->real_escape_string($_POST['info_adicional']);

    // Verificar si se ha subido una nueva imagen
    if ($_FILES['fotoAnimal']['size'] > 0) {
        // Manejar la subida de la nueva imagen
        $target_dir = "../images/uploads/";
        $target_file = $target_dir . basename($_FILES["fotoAnimal"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        $check = getimagesize($_FILES["fotoAnimal"]["tmp_name"]);
        if ($check === false) {
            echo "El archivo no es una imagen válida.";
            exit();
        }

        // Permitir solo ciertos formatos de imagen
        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_formats)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit();
        }

        // Verificar el tamaño del archivo
        if ($_FILES["fotoAnimal"]["size"] > 5 * 1024 * 1024) {
            echo "El tamaño del archivo es demasiado grande.";
            exit();
        }

        // Mover el archivo subido al directorio de imágenes
        if (!move_uploaded_file($_FILES["fotoAnimal"]["tmp_name"], $target_file)) {
            echo "Error al subir la imagen.";
            exit();
        }

        // Actualizar la ruta de la imagen en la base de datos
        $ruta_imagen = $target_file;
        $sql_imagen = ", ruta_imagen='$ruta_imagen'";
    } else {
        $sql_imagen = ""; // No actualizar la imagen si no se subió una nueva
    }

    // Construir la consulta SQL para actualizar el animal
    $sql = "UPDATE animal SET nombre='$nombreAnimal', especie='$especieAnimal', raza='$razaAnimal', edad='$edadAnimal', sexo='$sexoAnimal', info_adicional='$info_adicional'" . $sql_imagen . " WHERE id_animal = $id_animal";

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
