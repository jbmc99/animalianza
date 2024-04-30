<?php
// Conectar a la base de datos
require_once('conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Consulta SQL para obtener la lista de animales
$sql = "SELECT id_animal, nombre FROM animal";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Iterar sobre los resultados y crear las opciones para el select
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_animal'] . '">' . $row['nombre'] . '</option>';
    }
} else {
    echo '<option value="" disabled selected>No hay animales disponibles</option>';
}

// Cerrar la conexión
$conn->close();
?>