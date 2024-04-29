<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombreAnimal']);
    $especie = $conn->real_escape_string($_POST['especieAnimal']);
    $raza = $conn->real_escape_string($_POST['razaAnimal']);
    $edad = $conn->real_escape_string($_POST['edadAnimal']);
    $info_adicional = $conn->real_escape_string($_POST['infoAnimal']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO animal (nombre, especie, raza, edad, info_adicional) 
            VALUES ('$nombre', '$especie', '$raza', '$edad', '$info_adicional')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del animal que acabamos de insertar
        $animal_id = $conn->insert_id;

        // Redirigir a la página de generación de fichas con el ID del animal
        header("Location: gestionAnimales.php");
        exit();
    } else {
        // Manejar el caso de error al insertar en la base de datos
        echo "Error al guardar el animal en la base de datos: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>