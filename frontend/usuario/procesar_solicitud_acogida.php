<?php
session_start(); // Asegúrate de que esto está al principio de tu archivo

print_r($_SESSION); // Imprimir el contenido de la variable de sesión para depuración

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $email = htmlspecialchars($_POST["email"]);
    $numeroTelefono = htmlspecialchars($_POST["telefono"]);
    $direccion = htmlspecialchars($_POST["direccion"]);
    $idProtectora = htmlspecialchars($_POST["id_protectora"]);
    $idAnimal = htmlspecialchars($_POST["id_animal"]);
    $motivacionesAcogida = htmlspecialchars($_POST["motivaciones"]);
    $infoHogar = htmlspecialchars($_POST["estilo_vida"]);

    // Obtener el ID del usuario de la sesión
    $idLogin = $_SESSION['id_login']; // Asegúrate de que esta variable de sesión está configurada correctamente

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Obtener el id_usuario correspondiente al id_login
    $result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
    $row = $result->fetch_assoc();
    $idUsuario = $row['id_usuario'];

    // Preparar la consulta SQL para insertar la solicitud en la base de datos
    $sql = "INSERT INTO solicitud_acogida (id_usuario, email, telefono, direccion, id_protectora, id_animal, motivaciones, estilo_vida, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores recibidos
    $stmt->bind_param("isssiiis", $idUsuario, $email, $numeroTelefono, $direccion, $idProtectora, $idAnimal, $motivacionesAcogida, $infoHogar);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Solicitud de acogida guardada correctamente
        echo "<script>alert('¡La solicitud de acogida ha sido enviada correctamente!'); window.location.href='casaacogida.php';</script>";
    } else {
        // Error al guardar la solicitud de acogida
        echo "Error al procesar la solicitud de acogida: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron los datos por POST, redirigir a una página de error o mostrar un mensaje de error
    echo "Error: Los datos del formulario no fueron recibidos correctamente.";
}
?>