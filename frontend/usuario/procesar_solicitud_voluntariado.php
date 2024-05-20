<?php
session_start(); // Asegúrate de que esto está al principio de tu archivo

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $nombreApellidos = htmlspecialchars($_POST["nombreApellidos"]);
    $email = htmlspecialchars($_POST["email"]);
    $numeroTelefono = htmlspecialchars($_POST["numeroTelefono"]);
    $vehiculoPropio = $_POST["vehiculoPropio"] === 'si' ? 1 : 0;  // Convertir 'si'/'no' a 1/0
    $idProtectora = htmlspecialchars($_POST["id_protectora"]);

    // Obtener el ID del usuario de la sesión
    $idLogin = $_SESSION['id_login']; // Asegúrate de que esta variable de sesión está configurada correctamente

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Obtener el id_usuario correspondiente al id_login
    $result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
    $row = $result->fetch_assoc();
    $idUsuario = $row['id_usuario'];

    // Asignar un estado inicial a la solicitud (ej. 'pendiente')
    $estado = 'pendiente';

    // Preparar la consulta SQL para insertar la solicitud en la base de datos
    $sql = "INSERT INTO solicitud_voluntariado (id_usuario, id_protectora, estado, nombre_apellidos, email, numero_telefono, vehiculo_propio) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros con los valores recibidos
        $stmt->bind_param("iissssi", $idUsuario, $idProtectora, $estado, $nombreApellidos, $email, $numeroTelefono, $vehiculoPropio);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Solicitud de voluntariado guardada correctamente
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Solicitud enviada!',
                            text: '¡La solicitud de voluntariado ha sido enviada correctamente!',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'voluntariado.php';
                            }
                        });
                    });
                  </script>";
        } else {
            // Error al guardar la solicitud de voluntariado
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud de voluntariado: " . $conn->error . "',
                            confirmButtonText: 'Aceptar'
                        });
                    });
                  </script>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la preparación de la consulta: " . $conn->error . "',
                        confirmButtonText: 'Aceptar'
                    });
                });
              </script>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se recibieron los datos por POST, redirigir a una página de error o mostrar un mensaje de error
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error: Los datos del formulario no fueron recibidos correctamente.',
                    confirmButtonText: 'Aceptar'
                });
            });
          </script>";
}
?>
