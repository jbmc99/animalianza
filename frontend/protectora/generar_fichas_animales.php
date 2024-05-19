<?php
// Incluir archivo de conexión
require_once('conexion.php');

// Verificar si se recibió el ID del animal
if (!isset($_GET['id'])) {
    die("No se proporcionó un ID de animal.");
}

// Obtener el ID del animal de la URL
$animal_id = $_GET['id'];

// Consultar la base de datos para obtener la información del animal con el ID proporcionado
$sql = "SELECT * FROM animal WHERE id_animal = $animal_id";
$resultado = $conn->query($sql);

// Verificar si se encontró el animal
if ($resultado->num_rows > 0) {
    // Mostrar la información del animal
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='container mt-5 mb-5'>";
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-md-8'>";
        echo "<h2 class='text-center mb-4'>Detalles del animal:</h2>";
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p><strong>Nombre:</strong> " . $fila['nombre'] . "</p>";
        echo "<p><strong>Especie:</strong> " . $fila['especie'] . "</p>";
        echo "<p><strong>Raza:</strong> " . $fila['raza'] . "</p>";
        echo "<p><strong>Edad:</strong> " . $fila['edad'] . "</p>";
        echo "<p><strong>Información Adicional:</strong> " . $fila['info_adicional'] . "</p>"; 
        echo "</div>";
        echo "<div class='col-md-6'>";
        // Mostrar la imagen del animal
        echo "<img src='" . $fila['ruta_imagen'] . "' alt='Foto del animal' class='img-fluid mx-auto d-block' style='max-width: 300px;'>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }
} else {
    echo "No se encontró el animal.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>