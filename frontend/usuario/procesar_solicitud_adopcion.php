<?php
session_start(); // Asegúrate de que esto está al principio de tu archivo

print_r($_SESSION); // Imprimir el contenido de la variable de sesión

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $nombreApellidos = htmlspecialchars($_POST["nombreApellidos"]);
    $email = htmlspecialchars($_POST["email"]);
    $idProtectora = htmlspecialchars($_POST["select-protectora"]);
    $idAnimal = htmlspecialchars($_POST["select-nombre-animal"]);
    $numeroTelefono = htmlspecialchars($_POST["numeroTelefono"]);
    $direccion = htmlspecialchars($_POST["direccion"]);
    $propietarioInquilino = htmlspecialchars($_POST["propietarioInquilino"]);
    $permisoMascotas = htmlspecialchars($_POST["permisoMascotas"]);
    $motivacionesAdoptar = htmlspecialchars($_POST["motivacionesAdoptar"]);
    $infoFamilia = htmlspecialchars($_POST["infoFamilia"]);

    // Obtener el ID del usuario de la sesión
    $idUsuario = $_SESSION['id_usuario'];

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Preparar la consulta SQL para insertar la solicitud en la base de datos
    $sql = "INSERT INTO solicitud_adopcion (id_usuario, nombre_apellidos, email, id_protectora, id_animal, numero_telefono, direccion, propietario_inquilino, permiso_mascotas, motivaciones_adoptar, info_familia, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores recibidos
    $stmt->bind_param("issiiisssss", $idUsuario, $nombreApellidos, $email, $idProtectora, $idAnimal, $numeroTelefono, $direccion, $propietarioInquilino, $permisoMascotas, $motivacionesAdoptar, $infoFamilia);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Solicitud de adopción guardada correctamente
        echo "<script>alert('¡La solicitud de adopción ha sido enviada correctamente!'); window.location.href='adopciones.php';</script>";
    } else {
        // Error al guardar la solicitud de adopción
        echo "Error al procesar la solicitud de adopción: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron los datos por POST, redirigir a una página de error o mostrar un mensaje de error
    echo "Error: Los datos del formulario no fueron recibidos correctamente.";
}
?>