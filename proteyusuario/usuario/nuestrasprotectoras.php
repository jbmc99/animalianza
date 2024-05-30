<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
include('navbar_usuario.php');
?>
  
 
<?php
// Incluir archivo de conexión a la base de datos
require_once('../protectora/conexion.php');

// Consultar la base de datos para obtener la información de las protectoras
$sql = "SELECT id_protectora, nombre, info_prote, info_relevante, ruta_imagen FROM protectora";
$resultado = $conn->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    echo '<h1 class="text-center mt-5 mb-5">Nuestras protectoras</h1>'; // Título centrado
    echo '<div class="row justify-content-center">'; // Apertura de row y centrado de las tarjetas

    // Iterar sobre los resultados y generar el HTML para cada card
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="col-lg-4 mb-4 d-flex justify-content-center">'; // Cambiado a d-flex justify-content-center
        echo '<div class="card border-0 rounded-3 shadow-sm cardProtectora d-flex flex-column">'; // Añadido d-flex flex-column a la tarjeta
        
        // Verificar si el archivo de imagen existe
        $image_path = $fila['ruta_imagen'];
        if (file_exists($image_path)) {
            echo '<img src="' . $image_path . '" class="card-img-top imagenProtectora" alt="Imagen de la protectora">'; // Añadido la clase 'imagenProtectora'
        } else {
            echo '<p class="text-muted">No hay imagen disponible para esta protectora.</p>'; // Mensaje de imagen no disponible
        }
        echo '<div class="card-body text-center d-flex flex-column">'; // Añadido d-flex flex-column al card-body
        echo '<h5 class="card-title">' . $fila['nombre'] . '</h5>';
        echo '<a href="prote1.php?id_protectora=' . $fila['id_protectora'] . '" class="btn btn-success mt-auto mx-auto w-75">Más información</a>'; // Añadido mt-auto mx-auto w-75 al botón
        echo '</div>'; // Cierre de card-body
        echo '</div>'; // Cierre de card
        echo '</div>'; // Cierre de col-lg-4
    }

    echo '</div>'; // Cierre de row
} else {
    echo "No se encontraron protectoras.";
}


// Cerrar la conexión a la base de datos
$conn->close();
?>


 
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>