<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la clave 'tipo_login' está presente en $_POST
    if(isset($_POST['tipo_login'])) {
        // Obtener datos del formulario y escapar caracteres especiales para prevenir inyección SQL
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        $tipo_login = $conn->real_escape_string($_POST['tipo_login']);

        // Consulta preparada para evitar la inyección SQL
        $sql = "SELECT username, password, tipo_login FROM login WHERE username = ? AND password = ?";

        // Verificar si la preparación de la consulta tuvo éxito
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $error_message = 'Error en la preparación de la consulta: ' . $conn->error;
            header("Location: login.php?error_message=" . urlencode($error_message));
            exit();
        }
        
        // Bind de parámetros y ejecución de la consulta
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        // Verificar si se encontró un usuario
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($username_db, $password_db, $tipo_login_db);
            $stmt->fetch();

            // Inicio de sesión exitoso
            $_SESSION['username'] = $username_db;
            $_SESSION['tipo_login'] = $tipo_login_db;

            // Redirigir según el tipo de usuario
            if ($tipo_login_db == 'usuario') {
                header("Location: ../usuario/index.php");
                exit();
            } elseif ($tipo_login_db == 'protectora') {
                header("Location: ../protectora/inicioProtectora.php");
                exit();
            }
        } else {
            //Usuario o contraseña incorrectos
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Si 'tipo_login' no está presente, mostrar un mensaje de error
        header("Location: login.php?error=2"); // Error genérico de inicio de sesión
        exit();
    }
}

// Cerrar declaración de sesión y conexión a la base de datos
session_write_close();
$conn->close();
?>
