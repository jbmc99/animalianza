<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha recibido el valor de aceptación de adopciones
if (isset($_GET['acepta_adopciones'])) {
    $acepta_adopciones = $_GET['acepta_adopciones'];
    
    // Actualizar el campo en la base de datos
    $sql = "UPDATE protectora SET acepta_adopciones = $acepta_adopciones WHERE id_protectora = 'id_protectora'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Actualización exitosa";
    } else {
        echo "Error al actualizar la base de datos: " . $conn->error;
    }
} else {
    // Si no se recibió el valor esperado, devolver un mensaje de error
    echo "Error: No se recibió el valor de aceptación de adopciones";
}

// Cerrar conexión (esto está en el archivo de conexión)
$conn->close();
?>
