<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreApellidos = htmlspecialchars($_POST["nombreApellidos"]);
    $email = htmlspecialchars($_POST["email"]);
    $numeroTelefono = htmlspecialchars($_POST["numeroTelefono"]);
    $vehiculoPropio = $_POST["vehiculoPropio"] === 'si' ? 1 : 0; 
    $idProtectora = htmlspecialchars($_POST["id_protectora"]);
    $idLogin = $_SESSION['id_login']; 

    require_once('../protectora/conexion.php');

    $result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
    $row = $result->fetch_assoc();
    $idUsuario = $row['id_usuario'];
    $estado = 'pendiente';
    $sql = "INSERT INTO solicitud_voluntariado (id_usuario, id_protectora, estado, nombre_apellidos, email, numero_telefono, vehiculo_propio) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iissssi", $idUsuario, $idProtectora, $estado, $nombreApellidos, $email, $numeroTelefono, $vehiculoPropio);
        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<link rel='stylesheet' href='style.css'>";
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

    $conn->close();
} else {
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
