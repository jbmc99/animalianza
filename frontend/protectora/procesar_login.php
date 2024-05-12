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

        // Determinar la tabla correspondiente según el tipo de usuario
        $login = ($tipo_login == 'usuario') ? 'usuario' : 'protectora';
        
        // Consulta preparada para evitar la inyección SQL
        $sql = "SELECT l.username, l.password, l.tipo_login, p.id_protectora 
                FROM login l 
                INNER JOIN protectora p ON l.id_login = p.id_login 
                WHERE l.username = ? AND l.password = ?";

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
            $stmt->bind_result($username_db, $password_db, $tipo_login_db, $id_protectora);
            $stmt->fetch();

            // Inicio de sesión exitoso
            $_SESSION['username'] = $username_db;
            $_SESSION['tipo_login'] = $tipo_login_db;

            // Si el tipo de login es 'protectora', establecer la variable de sesión 'id_protectora'
            if ($tipo_login_db == 'protectora') {
                $_SESSION['id_protectora'] = $id_protectora;

                // Consulta para obtener los animales de la protectora específica
                $sql = "SELECT * FROM animal WHERE id_protectora = '$id_protectora'";
                $result = $conn->query($sql);

                // Verificar si la consulta se ejecutó correctamente
                if (!$result) {
                    $errors[] = "Error al obtener los animales de la protectora: " . $conn->error;
                }
            }
            
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
