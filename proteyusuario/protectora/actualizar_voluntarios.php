<?php
require_once('conexion.php');
//aqui se hace lo mismo q en actualizar_acogida y actualizar_adopcion pero con el voluntariado
if (isset($_GET['acepta_voluntarios']) && isset($_GET['id_protectora'])) {
    $acepta_voluntarios = $_GET['acepta_voluntarios'];
    $id_protectora = $_GET['id_protectora'];

    $stmt = $conn->prepare("UPDATE protectora SET acepta_voluntarios = ? WHERE id_protectora = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param('si', $acepta_voluntarios, $id_protectora);
    if ($stmt->execute() === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    } else {
        echo "Actualización exitosa";
    }
} else {
    echo "Error: No se recibió el valor de aceptación de voluntarios o el ID de la protectora";
}

$conn->close();
?>
