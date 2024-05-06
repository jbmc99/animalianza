<?php
function subirArchivos($imagen, $rutaImagenes)
{
    if (session_status() == PHP_SESSION_NONE) {
        // Si no está iniciada, iniciarla
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Verificar si se seleccionó un archivo
        if ($imagen['error'] == UPLOAD_ERR_NO_FILE) {
            return "No se ha seleccionado ningún archivo.";
        }

        $target_dir = $rutaImagenes;

        // Verificar si la carpeta existe
        if (!file_exists($target_dir) && !is_dir($target_dir)) {
            mkdir($target_dir);
        }
        // Obtener la extensión del archivo de imagen
        $imageFileType = strtolower(pathinfo($imagen["name"], PATHINFO_EXTENSION));

        // Construir el nombre de archivo único en base a la marca de tiempo y la extensión del archivo
        $target_file = $target_dir . uniqid() . '.' . $imageFileType;
        $_SESSION["target_file"] = $target_file;

        $uploadOk = 1;

        $check = getimagesize($imagen["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }

        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_formats)) {
            $uploadOk = 0;
        }

        if ($imagen["size"] > 5 * 1024 * 1024) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            // Manejo de errores, redirigir a la ubicación deseada
            // header("Location: " . $_POST["ruta"]);
            return "Error al subir el archivo.";
        } else {
            // Intentar mover el archivo subido al directorio de destino
            if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
                // Redirigir a la ubicación deseada si la subida es exitosa
                return "Archivo subido con éxito.";
            } else {
                // Manejo de errores, redirigir a la ubicación deseada
                return "Error al mover el archivo al destino.";
            }
        }
    } else {
        // Si no se recibió un archivo para subir, manejo de errores, redirigir a la ubicación deseada
        return "No se ha recibido ningún archivo para subir.";
    } }