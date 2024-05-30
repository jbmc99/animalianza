 
<?php
session_start(); 

if (!isset($_SESSION['id_login'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include('header.php');
include('navbar_usuario.php');
?>


<div class="container mt-5">
    <h1 class="text-center mb-5">Tienda solidaria</h1>
    <div id="page-content" class="container"> 
        <p class="text-center mb-3">Elige una de nuestras protectoras para ver sus productos disponibles. ¡Todos los beneficios serán por y para ellos!</p>

        <div id="page-content" class="container">
            <div class="row mt-5">
                <?php
                require_once('../protectora/conexion.php');

                $sql = "SELECT id_protectora, nombre, info_prote, info_relevante, ruta_imagen FROM protectora";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-4 mb-4 d-flex justify-content-center">';
                        echo '  <div class="card border-0 rounded-3 shadow-sm cardProtectora d-flex flex-column">';
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