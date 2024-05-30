<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
    $evento_id = $_POST['id_evento'];

    require_once('conexion.php');

    if(isset($_SESSION['id_protectora'])) {
        $id_protectora = $_SESSION['id_protectora'];
        $sql = "DELETE FROM evento WHERE id_evento = $evento_id AND id_protectora = $id_protectora";

        if ($conn->query($sql) === TRUE) {
            header('Location: gestionEventos.php');
            exit();
        } else {
            echo "Error al eliminar el evento: " . $conn->error;
        }
    } else {
        header('Location: login.php');
        exit();
    }

    $conn->close();
} else {
    header('Location: gestionEventos.php');
    exit();
}
?>