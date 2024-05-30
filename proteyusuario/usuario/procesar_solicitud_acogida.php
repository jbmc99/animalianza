<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $numeroTelefono = htmlspecialchars($_POST["telefono"]);
    $direccion = htmlspecialchars($_POST["direccion"]);
    $idProtectora = htmlspecialchars($_POST["id_protectora"]);
    $idAnimal = htmlspecialchars($_POST["id_animal"]);
    $motivacionesAcogida = htmlspecialchars($_POST["motivaciones"]);
    $infoHogar = htmlspecialchars($_POST["estilo_vida"]);
    $idLogin = $_SESSION['id_login'];

    require_once('../protectora/conexion.php');

    $result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
    $row = $result->fetch_assoc();
    $idUsuario = $row['id_usuario'];
    $sql = "INSERT INTO solicitud_acogida (id_usuario, email, telefono, direccion, id_protectora, id_animal, motivaciones, estilo_vida, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isssiiss", $idUsuario, $email, $numeroTelefono, $direccion, $idProtectora, $idAnimal, $motivacionesAcogida, $infoHogar);

        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<link rel='stylesheet' href='style.css'>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Solicitud enviada!',
                            text: '¡La solicitud de acogida ha sido enviada correctamente!',
                            confirmButtonText: 'Aceptar',
                            customClass: {
                                confirmButton: 'btn btn-success',
                                content: 'bootstrap-font',
                                title: 'bootstrap-font'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'casaacogida.php';
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
                            text: 'Error al procesar la solicitud de acogida: " . $conn->error . "',
                            confirmButtonText: 'Aceptar',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                content: 'bootstrap-font'
                            }
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
                confirmButtonText: 'Aceptar',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    content: 'bootstrap-font'
                }
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
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        content: 'bootstrap-font'
                    }
                });
            });
          </script>";
}
?>
