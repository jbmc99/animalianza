<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y escapar caracteres especiales para prevenir inyección SQL
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $tipo_login = $conn->real_escape_string($_POST['tipo_login']);

    // Consulta preparada para evitar la inyección SQL
    $sql = "SELECT l.id_login, l.username, l.password, l.tipo_login, p.id_protectora, u.id_usuario 
            FROM login l 
            LEFT JOIN protectora p ON l.id_login = p.id_login 
            LEFT JOIN usuario u ON l.id_login = u.id_login
            WHERE l.username = ? AND l.tipo_login = ?";

    // Ejecutar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $tipo_login);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontró un usuario
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($idLogin_db, $username_db, $password_db, $tipo_login_db, $idProtectora_db, $idUsuario_db);
        $stmt->fetch();

        // Verificar la contraseña utilizando password_verify
        if (password_verify($password, $password_db)) {
            // Inicio de sesión exitoso
            $_SESSION['id_login'] = $idLogin_db;
            $_SESSION['username'] = $username_db;
            $_SESSION['tipo_login'] = $tipo_login_db;
            $_SESSION['login_exitoso'] = true; 

            // Si el usuario es una protectora, también almacenar el id_protectora en la sesión
            if ($tipo_login_db == 'protectora') {
                $_SESSION['id_protectora'] = $idProtectora_db;
                header("Location: ../protectora/inicioProtectora.php");
                exit();
            } elseif ($tipo_login_db == 'usuario') {
                header("Location: ../usuario/index.php");
                exit();
            }
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: login.php?error=1");
        exit();
    }
}

// Cerrar declaración de sesión y conexión a la base de datos
session_write_close();
$conn->close();
?>
