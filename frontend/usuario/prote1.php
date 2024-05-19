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
// Verificar si se ha proporcionado un ID de protectora en la URL
if (isset($_GET['id_protectora'])) {
    // Obtener el ID de la protectora de la URL
    $id_protectora = $_GET['id_protectora'];

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Consultar la base de datos para obtener los detalles de la protectora con el ID proporcionado
    $sql = "SELECT * FROM protectora WHERE id_protectora = $id_protectora";
    $resultado = $conn->query($sql);

    // Verificar si se encontraron datos de la protectora
    if ($resultado->num_rows > 0) {
        $datos = $resultado->fetch_assoc();
        // Construir la ruta completa de la imagen
        $ruta_imagen = $datos['ruta_imagen']; // La ruta ya incluye la carpeta "uploads"

        ?>
        <div class="container mt-5">
            <div class="row">
                <!-- Información de la protectora -->
                <div class="card-body text-center">
                    <h2 class="card-title"><?php echo $datos['nombre']; ?></h2>
                    <p class="card-text"><strong>Información:</strong> <?php echo $datos['info_prote']; ?></p>
                    <p class="card-text"><strong>Información relevante:</strong> <?php echo $datos['info_relevante']; ?></p>
                    <!-- Mostrar la imagen de la protectora -->
                    <?php if (!empty($ruta_imagen)) : ?>
                        <img src="<?php echo $ruta_imagen; ?>" class="img-fluid mb-3" alt="Imagen de la Protectora" style="max-width: 200px;">
                    <?php else : ?>
                        <p class="text-muted">No hay imagen disponible para esta protectora.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php
    } else {
        // Mostrar un mensaje si no se encontraron datos de la protectora
        echo "<p>No se encontraron detalles de la protectora.</p>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Mostrar un mensaje si no se proporcionó un ID de protectora en la URL
    echo "<p>No se proporcionó un ID de protectora.</p>";
}
?>

  
 
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>