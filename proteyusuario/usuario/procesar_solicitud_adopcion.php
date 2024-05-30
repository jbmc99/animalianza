<?php
session_start(); 


require_once('../protectora/conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreApellidos = isset($_POST["nombreApellidos"]) ? htmlspecialchars($_POST["nombreApellidos"]) : null;
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : null;
    $numeroTelefono = isset($_POST["numeroTelefono"]) ? htmlspecialchars($_POST["numeroTelefono"]) : null;
    $direccion = isset($_POST["direccion"]) ? htmlspecialchars($_POST["direccion"]) : null;
    $propietarioInquilino = isset($_POST["propietarioInquilino"]) ? htmlspecialchars($_POST["propietarioInquilino"]) : null;
    $permisoMascotas = isset($_POST["permisoMascotas"]) ? htmlspecialchars($_POST["permisoMascotas"]) : null;
    $infoFamilia = isset($_POST["infoFamilia"]) ? htmlspecialchars( $_POST["infoFamilia"]) : null;
    $idProtectora = isset($_POST["id-protectora"]) ? htmlspecialchars($_POST["id-protectora"]) : null;
    $idAnimal = isset($_POST["select-nombre-animal"]) ? htmlspecialchars($_POST["select-nombre-animal"]) : null;

if (!$nombreApellidos || !$email || !$numeroTelefono || !$direccion || !$propietarioInquilino || !$permisoMascotas || !$infoFamilia || !$idProtectora || !$idAnimal) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: '<span style=\"font-family: Arial;\">Error</span>', // Cambia 'Arial' por la fuente que prefieras para el título
                    text: '<span style=\"font-family: Arial;\">Por favor, completa todos los campos del formulario.</span>', // Cambia 'Arial' por la fuente que prefieras para el texto
                    html: true,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();
                    }
                });
            });
          </script>";
    exit();
}

    if (!isset($_SESSION['id_login'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se ha encontrado una sesión activa. Por favor, inicia sesión de nuevo.',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login.php'; // Redirigir a la página de inicio de sesión
                        }
                    });
                });
              </script>";
        exit();
    }

    $idLogin = $_SESSION['id_login'];
    require_once('../protectora/conexion.php');

    $result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
    if ($result && $row = $result->fetch_assoc()) {
        $idUsuario = $row['id_usuario'];
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo encontrar el usuario correspondiente.',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.history.back();
                        }
                    });
                });
              </script>";
        exit();
    }
    $sql = "INSERT INTO solicitud_adopcion (id_usuario, email, numero_telefono, direccion, id_protectora, id_animal, info_familia, estado, nombre_apellidos, propietario_inquilino, permiso_mascotas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $estado = 'pendiente';
        $stmt->bind_param("isssiisssss", $idUsuario, $email, $numeroTelefono, $direccion, $idProtectora, $idAnimal, $infoFamilia, $estado, $nombreApellidos, $propietarioInquilino, $permisoMascotas);
        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<link rel='stylesheet' href='../usuario/style.css'>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Solicitud enviada!',
                            text: '¡La solicitud de adopción ha sido enviada correctamente!',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'adopciones.php';
                            }
                        });
                    });
                  </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<link rel='stylesheet' href='style.css'>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud de adopción: " . $conn->error . "',
                            confirmButtonText: 'Aceptar'
                        });
                    });
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<link rel='stylesheet' href='style.css'>";
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
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al procesar la solicitud de adopción.',
                    confirmButtonText: 'Aceptar'
                });
            });
          </script>";
}
?>