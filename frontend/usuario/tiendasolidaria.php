 
<?php
session_start(); // Iniciar la sesión al principio del archivo

// Verificar si la sesión está iniciada y el usuario está logueado
if (!isset($_SESSION['id_login'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header("Location: login.php");
    exit();
}
?>

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


<div class="container mt-5">
    <h1 class="text-center mb-5">Tienda solidaria</h1>
    <div id="page-content" class="container"> 
        <p class="text-center mb-3">Elige una de nuestras protectoras para ver sus productos disponibles. ¡Todos los beneficios serán por y para ellos!</p>

        <div id="page-content" class="container">
            <!-- Fichas de Protectoras -->
            <div class="row mt-5">
                <?php
                // Incluir archivo de conexión a la base de datos
                require_once('../protectora/conexion.php');

                // Consultar la base de datos para obtener todas las protectoras
                $sql = "SELECT id_protectora, nombre, info_prote, info_relevante, ruta_imagen FROM protectora";
                $result = $conn->query($sql);

                // Verificar si se encontraron protectoras
                if ($result->num_rows > 0) {
                    // Recorrer cada fila de resultados
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-4 mb-4 d-flex justify-content-center">';
                        echo '  <div class="card border-0 rounded-3 shadow-sm cardProtectora d-flex flex-column">';
                        
                        // Verificar si el archivo de imagen existe
                        $image_path = $row['ruta_imagen'];
                        if (file_exists($image_path)) {
                            echo '<img src="' . htmlspecialchars($image_path) . '" class="card-img-top imagenProtectora" alt="Imagen de la protectora">';
                        } else {
                            echo '<p class="text-muted">No hay imagen disponible para esta protectora.</p>';
                        }
                        echo '    <div class="card-body text-center d-flex flex-column">';
                        echo '      <h5 class="card-title">' . htmlspecialchars($row["nombre"]) . '</h5>';
                        echo '      <a href="articulostienda.php?id_protectora=' . htmlspecialchars($row["id_protectora"]) . '" class="btn btn-success mt-auto mx-auto w-75">Ver artículos</a>';
                        echo '    </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p class='text-center'>No se encontraron protectoras.</p>";
                }

                // Cerrar la conexión a la base de datos
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>

 
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>