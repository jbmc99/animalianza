<?php
// Incluir archivo de conexión
require_once('../protectora/conexion.php');

// Iniciar sesión si aún no está iniciada
session_start();

// Obtener el ID de la protectora seleccionada
$id_protectora = $_POST['id_protectora'];

// Almacenar el ID de la protectora en la sesión
$_SESSION['id_protectora'] = $id_protectora;

// Consultar la base de datos para obtener los perros de la protectora seleccionada
$sql = "SELECT * FROM animal WHERE especie = 'perro' AND id_protectora = $id_protectora";
$resultado = $conn->query($sql);

// Verificar si se encontraron perros
if ($resultado->num_rows > 0) {
    // Contenedor y fila fuera del bucle
    echo '<div class="container mt-5">';
    echo '<div class="row justify-content-center">'; // Añadimos la clase justify-content-center para centrar las tarjetas
    
    // Mostrar todas las tarjetas de perros
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="col-md-3 mb-3">'; // Asignamos una columna con el mismo ancho para cada card
        echo '<div class="card bg-transparent border-0 h-100">';
        echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; // Enlace a la página de detalles del perro
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

    // Cerrar contenedor y fila
    echo '</div>';
    echo '</div>';
} else {
    echo "No se encontraron perros para adopción en esta protectora.";
}
// Cerrar la conexión a la base de datos
$conn->close();
?>