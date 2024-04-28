<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
require_once('../protectora/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreUsuario = $conn->real_escape_string($_POST['nombreUsuario']);
    $passwordUsuario = $conn->real_escape_string($_POST['passwordUsuario']);
    $emailContacto = $conn->real_escape_string($_POST['emailContacto']);
    $telefonoContacto = $conn->real_escape_string($_POST['telefonoContacto']);
    $infoAdicional = $conn->real_escape_string($_POST['infoAdicional']);

    // Insertar datos en la tabla login
    $sql_login = "INSERT INTO login (username, password, tipo_login) VALUES ('$nombreUsuario', '$passwordUsuario', 'usuario')";
    if (!$conn->query($sql_login)) {
        $error_message = 'Error al registrar el nombre de usuario y la contraseña: ' . $conn->error;
        header("Location: registro_usuario.php?error_message=" . urlencode($error_message));
        exit();
    }

    // Obtener el ID de login recién insertado
    $id_login = $conn->insert_id;

    // Insertar datos en la tabla usuario
    $sql_usuario = "INSERT INTO usuario (nombre, direccion, telefono, email, id_login) 
                VALUES ('$nombreUsuario', '$direccion', '$telefonoContacto', '$emailContacto', '$id_login')";

    if ($conn->query($sql_usuario)) {
        // Registro exitoso, redirigir a una página de confirmación o a donde desees
        echo '<script>alert("Has sido registrado con éxito.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        // Si hay un error al insertar en la tabla usuario, eliminar el registro de la tabla login correspondiente
        $error_message = 'Error al registrar el usuario: ' . $conn->error;
        $sql_delete_login = "DELETE FROM login WHERE id_login = '$id_login'";
        $conn->query($sql_delete_login);
        header("Location: registro_usuario.php?error_message=" . urlencode($error_message));
        exit();
    }
}

// Cerrar conexión a la base de datos
$conn->close();
?>
