<!--igual que filtrar_gatos-->
<?php
require_once('../protectora/conexion.php');
session_start();

$id_protectora = $_POST['id_protectora'];
$_SESSION['id_protectora'] = $id_protectora;
$sql = "SELECT * FROM animal WHERE especie = 'perro' AND id_protectora = $id_protectora";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<div class="row justify-content-center">'; 
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="col-md-3 mb-3">'; 
        echo '<div class="card bg-transparent border-0 h-100">';
        echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; 
        echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Foto del perro">';
        echo '</a>';
        echo '<div class="card-body text-center">';
        echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-link text-dark text-decoration-none">';
        echo '<h3>' . $fila['nombre'] . '</h3>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
} else {
    echo "No se encontraron perros para adopción en esta protectora.";
}
$conn->close();
?>