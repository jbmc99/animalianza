<?php
// Detalles de la conexión
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = ''; // Contraseña de la base de datos
$database = "animalianza"; // Nombre de la base de datos

// Intentar establecer la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>