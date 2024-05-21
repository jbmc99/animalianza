<?php
session_start(); // Asegúrate de que esto está al principio de tu archivo

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar y recibir los datos del formulario, si están presentes
    $nombreApellidos = isset($_POST["nombre_apellidos"]) ? htmlspecialchars($_POST["nombre_apellidos"]) : null;
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : null;
    $numeroTelefono = isset($_POST["numero_telefono"]) ? htmlspecialchars($_POST["numero_telefono"]) : null;
    $direccion = isset($_POST["direccion"]) ? htmlspecialchars($_POST["direccion"]) : null;
    $propietarioInquilino = isset($_POST["propietario_inquilino"]) ? htmlspecialchars($_POST["propietario_inquilino"]) : null;
    $permisoMascotas = isset($_POST["permiso_mascotas"]) ? htmlspecialchars($_POST["permiso_mascotas"]) : null;
    $motivacionesAdoptar = isset($_POST["motivaciones_adoptar"]) ? htmlspecialchars($_POST["motivaciones_adoptar"]) : null;
    $infoFamilia = isset($_POST["info_familia"]) ? htmlspecialchars($_POST["info_familia"]) : null;
    $idProtectora = isset($_POST["id_protectora"]) ? htmlspecialchars($_POST["id_protectora"]) : null;
    $idAnimal = isset($_POST["id_animal"]) ? htmlspecialchars($_POST["id_animal"]) : null;

    // Verificar que todos los datos requeridos estén presentes
    if (!$nombreApellidos || !$email || !$numeroTelefono || !$direccion || !$propietarioInquilino || !$permisoMascotas || !$motivacionesAdoptar || !$infoFamilia || !$idProtectora || !$idAnimal) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor, completa todos los campos del formulario.',
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

    // Obtener el ID del usuario de la sesión
    if (!isset($_SESSION['id_login'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
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

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Obtener el id_usuario correspondiente al id_login
    $result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
    if ($result && $row = $result->fetch_assoc()) {
        $idUsuario = $row['id_usuario'];
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
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

    // Preparar la consulta SQL para insertar la solicitud en la base de datos
    $sql = "INSERT INTO solicitud_acogida (id_usuario, email, numero_telefono, direccion, id_protectora, id_animal, motivaciones_adoptar, info_familia, estado, nombre_apellidos, propietario_inquilino, permiso_mascotas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendiente', ?, ?, ?)";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros con los valores recibidos
        $stmt->bind_param("isssiiissss", $idUsuario, $email, $numeroTelefono, $direccion, $idProtectora, $idAnimal, $motivacionesAdoptar, $infoFamilia, $nombreApellidos, $propietarioInquilino, $permisoMascotas);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Solicitud de acogida guardada correctamente
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Solicitud enviada!',
                            text: '¡La solicitud de acogida ha sido enviada correctamente!',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'casaacogida.php';
                            }
                        });
                    });
                  </script>";
        } else {
            // Error al guardar la solicitud de acogida
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud de acogida: " . $conn->error . "',
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
