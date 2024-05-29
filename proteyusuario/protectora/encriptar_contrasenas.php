<?php
// Incluir el archivo de conexión a la base de datos
include '../protectora/conexion.php';

// Obtener todas las contraseñas sin encriptar de la tabla login
$result = $conn->query("SELECT id_login, password FROM login");
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Recorrer cada fila del resultado
while ($row = $result->fetch_assoc()) {
    // Encriptar la contraseña
    $passwordEncriptada = password_hash($row['password'], PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $stmt = $conn->prepare("UPDATE login SET password = ? WHERE id_login = ?");
    if (!$stmt) {
        die("Error en la preparación de la consulta de actualización: " . $conn->error);
    }

    $stmt->bind_param("si", $passwordEncriptada, $row['id_login']);
    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta de actualización: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>