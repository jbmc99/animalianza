
<?php
include('header.php');
include('navbar_usuario.php');
?>

<?php
// Verificar si se ha proporcionado un ID de producto en la URL
if (isset($_GET['id_producto'])) {
    // Obtener el ID del producto de la URL
    $id_producto = $_GET['id_producto'];

    // Incluir archivo de conexión a la base de datos
    require_once('../protectora/conexion.php');

    // Consultar la base de datos para obtener los detalles del producto con el ID proporcionado
    $sql = "SELECT * FROM producto WHERE id_producto = $id_producto";
    $resultado = $conn->query($sql);

    // Verificar si se encontraron datos del producto
    if ($resultado->num_rows > 0) {
        $datos = $resultado->fetch_object();
?>
     <div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Información del producto -->
        <div class="col-md-6 text-center">
            <h2><?php echo $datos->nombre; ?></h2>
            <p><strong>Descripción:</strong> <?php echo $datos->descripcion; ?></p>
            <p><strong>Precio:</strong> <?php echo $datos->precio; ?></p>
            <!-- Mostrar la imagen del producto -->
            <?php if (!empty($datos->ruta_imagen)) : ?>
                <img src="<?php echo $datos->ruta_imagen; ?>" class="img-fluid mb-3" alt="Imagen del Producto" style="max-width: 200px;">
            <?php else : ?>
                <p class="text-muted">No hay imagen disponible para este producto.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    } else {
        // Mostrar un mensaje si no se encontraron datos del producto
        echo "<p>No se encontraron detalles del producto.</p>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Mostrar un mensaje si no se proporcionó un ID de producto en la URL
    echo "<p>No se proporcionó un ID de producto.</p>";
}
?>


  
 
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>