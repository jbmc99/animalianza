<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreUsuarioProte = $conn->real_escape_string($_POST['nombreUsuarioProte']);
    $passwordProte = $conn->real_escape_string($_POST['passwordProte']);
    $nombreProte = $conn->real_escape_string($_POST['nombreProte']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $emailContacto = $conn->real_escape_string($_POST['emailContacto']);
    $numeroRegistro = $conn->real_escape_string($_POST['numeroRegistro']);
    $infoProte = $conn->real_escape_string($_POST['infoProte']);
    $infoFamilia = $conn->real_escape_string($_POST['infoFamilia']);

    // Insertar datos en la tabla login
    $sql_login = "INSERT INTO login (username, password, tipo_login) VALUES ('$nombreUsuarioProte', '$passwordProte', 'protectora')";
    if (!$conn->query($sql_login)) {
        $error_message = 'Error al registrar el nombre de usuario y la contraseña: ' . $conn->error;
        header("Location: registro_protectora.php?error_message=" . urlencode($error_message));
        exit();
    }

    // Obtener el ID de login recién insertado
    $id_login = $conn->insert_id;

    // Insertar datos en la tabla protectora
    $sql_protectora = "INSERT INTO protectora (nombre, direccion, telefono, email, acepta_adopciones, acepta_acogidas, acepta_voluntarios, id_login) 
    VALUES ('$nombreProte', '$direccion', NULL, '$emailContacto', NULL, NULL, NULL, '$id_login')";
    
    if ($conn->query($sql_protectora)) {
        // Registro exitoso, redirigir a una página de confirmación o a donde desees
        echo '<script>alert("Has sido registrado con éxito.");</script>';
        echo '<script>window.location.href = "inicioProtectora.php";</script>';
        exit();
    } else {
        // Si hay un error al insertar en la tabla protectora, eliminar el registro de la tabla login correspondiente
        $error_message = 'Error al registrar la protectora: ' . $conn->error;
        $sql_delete_login = "DELETE FROM login WHERE id_login = '$id_login'";
        $conn->query($sql_delete_login);
        header("Location: registro_protectora.php?error_message=" . urlencode($error_message));
        exit();
    }
}

// Cerrar conexión a la base de datos
$conn->close();
?>
