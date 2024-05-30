<?php
//esto no es necesario pero es una buena práctica el console.log para comprobar q se obtienen los valores correctos
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../protectora/conexion.php');

//verificamos si se ha enviado el id_protectora
if (isset($_POST['id_protectora']) && is_numeric($_POST['id_protectora'])) {
    $id_protectora = $conn->real_escape_string($_POST['id_protectora']);

    //creamos la consulta para obtener los animales de la protectora
    $sql = "SELECT * FROM animal WHERE id_protectora = '$id_protectora'";
    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            $animales = [];
            while($row = $result->fetch_assoc()) {
                $animales[] = $row;
            }

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

$conn->close();
?>
