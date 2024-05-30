<?php
require_once('conexion.php');

//comprobamos si se recibieron los valores de acepta_acogidas e id_protectora
if (isset($_GET['acepta_acogidas']) && isset($_GET['id_protectora'])) {
    $acepta_acogidas = $_GET['acepta_acogidas'];
    $id_protectora = $_GET['id_protectora'];

    //las consultas preparadas no son necesarias pero son una buena práctica
    $stmt = $conn->prepare("UPDATE protectora SET acepta_acogidas = ? WHERE id_protectora = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param('si', $acepta_acogidas, $id_protectora);

    //ejecutamos la consulta
    if ($stmt->execute() === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    } else {
        echo "Actualización exitosa";
    }
} else {
    echo "Error: No se recibió el valor de aceptación de acogidas o el ID de la protectora";
}

$conn->close();
?>

