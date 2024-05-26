<?php
// Habilitar la visualización de errores en PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de conexión
require_once('protectora/conexion.php');

// Verificar si se recibió id_protectora
if (isset($_POST['id_protectora']) && is_numeric($_POST['id_protectora'])) {
    $id_protectora = $conn->real_escape_string($_POST['id_protectora']);

    // Crear la consulta SQL
    $sql = "SELECT * FROM animal WHERE id_protectora = '$id_protectora'";

    // Ejecutar la consulta
    if ($result = $conn->query($sql)) {
        // Verificar si la consulta devolvió resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los datos de los animales
            $animales = [];

            // Recorrer los resultados y añadirlos al array
            while($row = $result->fetch_assoc()) {
                $animales[] = $row;
            }

            // Mostrar los datos de los animales en formato JSON
            echo json_encode($animales);
        } else {
            echo json_encode(["error" => "No se encontraron animales para esta protectora."]);
        }
    } else {
        echo json_encode(["error" => "Error al ejecutar la consulta: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "ID de protectora no válida."]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
