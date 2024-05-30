<?php
require_once('conexion.php');


//verificamos si se ha recibido el id del animal
if (!isset($_GET['id'])) {
    die("No se proporcionó un ID de animal.");
}

// lo ontenemos de la URL
$animal_id = $_GET['id'];

//consultamos la base de datos para obtener la información del animal
$sql = "SELECT * FROM animal WHERE id_animal = $animal_id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    //si el animal existe, mostramos su información
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
        echo "<img src='" . $fila['ruta_imagen'] . "' alt='Foto del animal' class='img-fluid mx-auto d-block' style='max-width: 300px;'>";
        echo "</div>";
        echo "</div>";
        
        //aqui, si el usuario ha iniciado sesión, mostramos el botón para solicitar adopción 
        //porque no tiene sentido que la protectora solicite adopción de sus propios animales
        if (isset($_SESSION['tipo_login']) && $_SESSION['tipo_login'] == 'usuario') {
            echo "<div class='text-center mt-4'>";
            echo "<a href='formularioadop.php?id=$animal_id' class='btn'>Solicitar Adopción</a>";
            echo "</div>";
        }
        
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }
} else {
    echo "No se encontró el animal.";
}

$conn->close();
?>
