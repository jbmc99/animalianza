<?php
// Incluir archivo de conexión a la base de datos
require_once('../protectora/conexion.php');

// Obtener el ID de la protectora de la URL
$id_protectora = isset($_GET['id_protectora']) ? intval($_GET['id_protectora']) : 0;

// Validar el ID de la protectora
if ($id_protectora <= 0) {
    echo "ID de protectora no válido.";
    exit;
}

// Consultar la base de datos para obtener los productos de la protectora
$sql = "SELECT id_producto, nombre, descripcion, precio, ruta_imagen FROM producto WHERE id_protectora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_protectora);
$stmt->execute();
$result = $stmt->get_result();

// Depuración: Imprimir número de filas obtenidas
if ($result->num_rows > 0) {
    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    echo "<p class='text-center'>No se encontraron productos para esta protectora.</p>";
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
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
    <h1 class="text-center mb-5">Productos benéficos</h1>
    <div class="row justify-content-center">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="col-lg-3 mb-4 me-5">
                    <div class="card border-0 rounded-3 shadow-sm">
                        <?php if (file_exists($producto['ruta_imagen'])): ?>
                            <img src="<?php echo htmlspecialchars($producto['ruta_imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                        <?php else: ?>
                            <p class="text-muted">No hay imagen disponible para este producto.</p>
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">€<?php echo htmlspecialchars($producto['precio']); ?></h6>
                            <a href="../usuario/infoproducto.php?id_producto=<?php echo htmlspecialchars($producto['id_producto']); ?>" class="btn btn-success">Más información</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No se encontraron productos para esta protectora.</p>
        <?php endif; ?>
    </div>
</div>
  
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>