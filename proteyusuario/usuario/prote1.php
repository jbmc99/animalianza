<?php
include('header.php');
include('navbar_usuario.php');
?>
  
 
<?php
if (isset($_GET['id_protectora'])) {
    $id_protectora = $_GET['id_protectora'];

    require_once('../protectora/conexion.php');

    $sql = "SELECT * FROM protectora WHERE id_protectora = $id_protectora";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $datos = $resultado->fetch_assoc();
        $ruta_imagen = $datos['ruta_imagen'];

        ?>
<div class="container mt-5">
<div class="row justify-content-center">
    <div class="text-center">
        <h2><?php echo $datos['nombre']; ?></h2>
        <div class="col-md-6 mx-auto">
            <p><strong>Información:</strong> <?php echo $datos['info_prote']; ?></p>
        </div>
    </div>
</div>
            
<?php if (!empty($ruta_imagen)) : ?>
    <div class="d-flex justify-content-center">
        <img src="<?php echo $ruta_imagen; ?>" class="img-fluid mb-3" alt="Imagen de la Protectora" style="max-width: 400px;">
    </div>
<?php else : ?>
    <p class="text-muted">No hay imagen disponible para esta protectora.</p>
<?php endif; ?>
</div>
</div>
</div>
        <?php
    } else {
        echo "<p>No se encontraron detalles de la protectora.</p>";
    }
    $conn->close();
} else {
    echo "<p>No se proporcionó un ID de protectora.</p>";
}
?>

  
 
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>