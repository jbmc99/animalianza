<?php
// Conectar a la base de datos
require_once('conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtener el ID del animal desde la solicitud POST
$idAnimal = $_POST['id_animal'];

// Preparar la consulta SQL para eliminar el animal
$sqlEliminar = "DELETE FROM animal WHERE id_animal = ?";
$stmtEliminar = $conn->prepare($sqlEliminar);
$stmtEliminar->bind_param('i', $idAnimal);

// Ejecutar la consulta para eliminar el animal
if ($stmtEliminar->execute()) {
    // Consulta SQL para obtener los nombres y las imágenes de los animales actualizados
    $sql = "SELECT id_animal, nombre FROM animal";
    $resultado = $conn->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado === false) {
        die('Error en la consulta: ' . $conn->error);
    }

    // Crear un array para almacenar los datos de los animales
    $animales = array();

    // Recorrer los resultados y agregarlos al array
    while ($fila = $resultado->fetch_assoc()) {
        $animales[] = $fila;
    }

    // Convertir el array a formato JSON y devolverlo como respuesta
    echo json_encode($animales);
} else {
    echo 'error';
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
