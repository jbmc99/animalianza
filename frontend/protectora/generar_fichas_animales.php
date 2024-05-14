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
        echo "<h2>Detalles del animal:</h2>";
        echo "<p>Nombre: " . $fila['nombre'] . "</p>";
        echo "<p>Especie: " . $fila['especie'] . "</p>";
        echo "<p>Raza: " . $fila['raza'] . "</p>";
        echo "<p>Edad: " . $fila['edad'] . "</p>";
        // Mostrar la imagen del animal
        echo "<img src='" . $fila['ruta_imagen'] . "' alt='Foto del animal' style='max-width: 300px;'>";
        // Agregar botón de adopción
        echo "<a href='../usuario/formularioadop.php' class='btn btn-success mt-3'>Solicitar adopción</a>";
        // Continuar con otros detalles del animal si los hay
    }
} else {
    echo "No se encontró el animal.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>