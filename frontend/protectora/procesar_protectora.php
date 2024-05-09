<?php
// Incluir archivo de conexión a la base de datos
require_once('conexion.php');
require_once('upload.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreProtectora = $conn->real_escape_string($_POST['nombreProtectora']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $email = $conn->real_escape_string($_POST['email']);
    $aceptaAdopciones = isset($_POST['aceptaAdopciones']) ? 1 : 0;
    $aceptaAcogidas = isset($_POST['aceptaAcogidas']) ? 1 : 0;
    $aceptaVoluntarios = isset($_POST['aceptaVoluntarios']) ? 1 : 0;
    $infoProte = $conn->real_escape_string($_POST['infoProte']);
    $infoRelevante = $conn->real_escape_string($_POST['infoRelevante']);

    // Manejar la subida de la imagen
    $rutaImagenes = "../images/uploads/";
    $mensajeSubida = subirArchivos($_FILES["foto"], $rutaImagenes);

    if (strpos($mensajeSubida, "con éxito") !== false) {
        // Si la subida fue exitosa, obtener la ruta del archivo
        $rutaImagen = $_SESSION["target_file"];

        // Insertar los datos en la base de datos junto con la ruta de la imagen
        $sql = "INSERT INTO protectora (nombre, direccion, telefono, email, acepta_adopciones, acepta_acogidas, acepta_voluntarios, info_prote, info_relevante, ruta_imagen) 
                VALUES ('$nombreProtectora', '$direccion', '$telefono', '$email', '$aceptaAdopciones', '$aceptaAcogidas', '$aceptaVoluntarios', '$infoProte', '$infoRelevante', '$rutaImagen')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirigir a la página de gestión de protectoras
            header("Location: ../usuario/nuestrasprotectoras.php");
            exit();
        } else {
            // Manejar el caso de error al insertar en la base de datos
            echo "Error al guardar la protectora en la base de datos: " . $conn->error;
        }
    } else {
        // Manejar el caso de error en la subida de la imagen
        echo $mensajeSubida;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
