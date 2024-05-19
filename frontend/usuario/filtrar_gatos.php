<?php
// Incluir archivo de conexión
require_once('../protectora/conexion.php');

// Obtener el ID de la protectora seleccionada
$id_protectora = $_POST['id_protectora'];

// Consultar la base de datos para obtener los gatos de la protectora seleccionada
$sql = "SELECT * FROM animal WHERE especie = 'gato' AND id_protectora = $id_protectora";
$resultado = $conn->query($sql);

// Verificar si se encontraron gatos
if ($resultado->num_rows > 0) {
    // Contenedor y fila fuera del bucle
    echo '<div class="container mt-5">';
    echo '<div class="row justify-content-center">';
    
    // Mostrar todas las tarjetas de gatos
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="col-md-3 mb-3">'; // Asignamos una columna con el mismo ancho para cada card
        echo '<div class="card bg-transparent border-0 h-100">';
        echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; // Enlace a la página de detalles del gato
        echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Foto del gato">';
        echo '</a>';
        echo '<div class="card-body text-center">';
        echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-link text-dark text-decoration-none">';
        echo '<h3>' . $fila['nombre'] . '</h3>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    // Cerrar contenedor y fila
    echo '</div>';
    echo '</div>';
} else {
    echo "No se encontraron gatos para adopción en esta protectora.";
}
// Cerrar la conexión a la base de datos
$conn->close();
?>
