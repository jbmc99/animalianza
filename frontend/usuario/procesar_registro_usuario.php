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
    $direccion = $conn->real_escape_string($_POST['direccion']); // Asegúrate de que esto esté en el formulario

    // Encriptar la contraseña
    $passwordHash = password_hash($passwordUsuario, PASSWORD_DEFAULT);

    // Insertar datos en la tabla login
    $sql_login = "INSERT INTO login (username, password, tipo_login) VALUES ('$nombreUsuario', '$passwordHash', 'usuario')";
    if (!$conn->query($sql_login)) {
        $error_message = 'Error al registrar el nombre de usuario y la contraseña: ' . $conn->error;
        header("Location: registro_usuario.php?error_message=" . urlencode($error_message));
        exit();
    }

    // Obtener el ID de login recién insertado
    $id_login = $conn->insert_id;

    // Insertar datos en la tabla usuario
    $sql_usuario = "INSERT INTO usuario (username, nombre, direccion, telefono, email, id_login) 
                    VALUES ('$nombreUsuario', '$nombreUsuario', '$direccion', '$telefonoContacto', '$emailContacto', '$id_login')";

    if ($conn->query($sql_usuario)) {
        // Obtener el ID de usuario recién insertado
        $id_usuario = $conn->insert_id;

        // Guardar los datos de usuario y login en la sesión
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['id_login'] = $id_login;
        $_SESSION['username'] = $nombreUsuario;
        $_SESSION['tipo_login'] = 'usuario';

        // Mostrar mensaje de éxito
        echo "<!DOCTYPE html>
              <html lang='es'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Registro Usuario</title>
                  <link rel='stylesheet' href='style.css'>
                  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'success',
                          title: '¡Registro exitoso!',
                          text: 'Te has registrado correctamente.',
                          confirmButtonText: 'Aceptar',
                      }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = '../protectora/login.php';
                          }
                      });
                  });
              </script>
              </body>
              </html>";
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
