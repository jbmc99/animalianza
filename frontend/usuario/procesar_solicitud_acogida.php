<?php
session_start(); // Asegúrate de que esto está al principio de tu archivo

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $nombreApellidos = htmlspecialchars($_POST["nombreApellidos"]);
    $email = htmlspecialchars($_POST["email"]);
    $idProtectora = htmlspecialchars($_POST["select-protectora"]);
    $idAnimal = htmlspecialchars($_POST["select-nombre-animal"]);
    $numeroTelefono = htmlspecialchars($_POST["numeroTelefono"]);
    $direccion = htmlspecialchars($_POST["direccion"]);
    $motivacionesAcogida = htmlspecialchars($_POST["motivacionesAcogida"]);
    $infoHogar = htmlspecialchars($_POST["infoHogar"]);

    // Obtener el ID del usuario de la sesión
    $idUsuario = $_SESSION['id_usuario'];

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Preparar la consulta SQL para insertar la solicitud en la base de datos
    $sql = "INSERT INTO solicitud_acogida (id_usuario, id_animal, estado, email, telefono, direccion, id_protectora, motivaciones, estilo_vida) VALUES (?, ?, 'pendiente', ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores recibidos
    $stmt->bind_param("iississ", $idUsuario, $idAnimal, $email, $numeroTelefono, $direccion, $idProtectora, $motivacionesAcogida, $infoHogar);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Solicitud de casa de acogida guardada correctamente
        echo "<script>alert('¡La solicitud de casa de acogida ha sido enviada correctamente!'); window.location.href='casas_acogida.php';</script>";
    } else {
        // Error al guardar la solicitud de casa de acogida
        echo "Error al procesar la solicitud de casa de acogida: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron los datos por POST, redirigir a una página de error o mostrar un mensaje de error
    echo "Error: Los datos del formulario no fueron recibidos correctamente.";
}
?>
