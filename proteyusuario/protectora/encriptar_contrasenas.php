<?php
include '../protectora/conexion.php';

//se obtienen todas las contraseñas de la tabla login q se quieren encriptar
$result = $conn->query("SELECT id_login, password FROM login");
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    //se encripta la contraseña con password_hash
    $passwordEncriptada = password_hash($row['password'], PASSWORD_DEFAULT);

    //actualizamos la contraseña en la base de datos
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