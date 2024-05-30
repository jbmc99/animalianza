<?php
session_start();

require_once('conexion.php');
require_once('../../backend/upload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuarioProte = $conn->real_escape_string($_POST['nombreUsuarioProte']);
    $passwordProte = $conn->real_escape_string($_POST['passwordProte']);
    $nombreProte = $conn->real_escape_string($_POST['nombreProte']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $emailContacto = $conn->real_escape_string($_POST['emailContacto']);
    $numeroRegistro = $conn->real_escape_string($_POST['numeroRegistro']);
    $infoProte = $conn->real_escape_string($_POST['infoProte']);
    $passwordProteHash = password_hash($passwordProte, PASSWORD_DEFAULT);
    $rutaImagenes = "../images/uploads/";
    $mensajeSubida = subirArchivos($_FILES["fotoProtectora"], $rutaImagenes);

    if (strpos($mensajeSubida, "con éxito") !== false) {
        $rutaImagen = $_SESSION["target_file"];
        $sql_login = "INSERT INTO login (username, password, tipo_login) VALUES ('$nombreUsuarioProte', '$passwordProteHash', 'protectora')";
        if ($conn->query($sql_login)) {
            $id_login = $conn->insert_id;

            $sql_protectora = "INSERT INTO protectora (nombre, direccion, telefono, email, acepta_adopciones, acepta_acogidas, acepta_voluntarios, id_login, info_prote, info_relevante, ruta_imagen) 
            VALUES ('$nombreProte', '$direccion', NULL, '$emailContacto', NULL, NULL, NULL, '$id_login', '$infoProte', NULL, '$rutaImagen')";

            if ($conn->query($sql_protectora)) {
                echo "<!DOCTYPE html>
                      <html lang='es'>
                      <head>
                          <meta charset='UTF-8'>
                          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                          <title>Registro Protectora</title>
                          <link rel='stylesheet' href='../usuario/style.css'>
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
                                      window.location.href = 'inicioProtectora.php';
                                  }
                              });
                          });
                      </script>
                      </body>
                      </html>";
            } else {
                $error_message = 'Error al registrar la protectora: ' . $conn->error;
                $sql_delete_login = "DELETE FROM login WHERE id_login = '$id_login'";
                $conn->query($sql_delete_login);
                header("Location: registro_protectora.php?error_message=" . urlencode($error_message));
                exit();
            }
        } else {
            $error_message = 'Error al registrar el nombre de usuario y la contraseña: ' . $conn->error;
            header("Location: registro_protectora.php?error_message=" . urlencode($error_message));
            exit();
        }
    } else {
        echo $mensajeSubida;
    }
}
$conn->close();
?>
