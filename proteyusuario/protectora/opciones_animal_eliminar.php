<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Iniciar la sesión
session_start();

// Verificar si 'id_protectora' está en la sesión
if (!isset($_SESSION['id_protectora'])) {
    // Manejar el caso en que 'id_protectora' no está establecido, por ejemplo, redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener 'id_protectora' de la sesión
$id_protectora = $_SESSION['id_protectora'];

// Consulta SQL para obtener la lista de animales de la protectora
$sql = "SELECT id_animal, nombre FROM animal WHERE id_protectora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_protectora);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar las opciones de animales
    $animales = array();

    // Iterar sobre los resultados y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $animal = array(
            'id' => $row['id_animal'],
            'nombre' => $row['nombre']
        );
        array_push($animales, $animal);
    }

    // Devolver las opciones de animales en formato JSON
    echo json_encode($animales);
} else {
    // Si no hay animales, devolver un array vacío
    echo json_encode(array());
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>
