<?php
session_start();
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $tipo_login = $conn->real_escape_string($_POST['tipo_login']);
    $sql = "SELECT l.id_login, l.username, l.password, l.tipo_login, p.id_protectora, u.id_usuario 
            FROM login l 
            LEFT JOIN protectora p ON l.id_login = p.id_login 
            LEFT JOIN usuario u ON l.id_login = u.id_login
            WHERE l.username = ? AND l.tipo_login = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $tipo_login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($idLogin_db, $username_db, $password_db, $tipo_login_db, $idProtectora_db, $idUsuario_db);
        $stmt->fetch();

        if (password_verify($password, $password_db)) {
            $_SESSION['id_login'] = $idLogin_db;
            $_SESSION['username'] = $username_db;
            $_SESSION['tipo_login'] = $tipo_login_db;
            $_SESSION['login_exitoso'] = true; 

            if ($tipo_login_db == 'protectora') {
                $_SESSION['id_protectora'] = $idProtectora_db;
                header("Location: ../protectora/inicioProtectora.php");
                exit();
            } elseif ($tipo_login_db == 'usuario') {
                header("Location: ../usuario/index.php");
                exit();
            }
        } else {
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}
session_write_close();
$conn->close();
?>
