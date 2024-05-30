<?php
// Incluir archivo de conexión a la base de datos
require_once('../protectora/conexion.php');

// Consultar la base de datos para obtener los eventos
$sql = "SELECT id_evento, nombre, descripcion, fecha, estado, ruta_imagen, id_protectora FROM evento";
$result = $conn->query($sql);

// Inicializar arrays para próximos y pasados eventos
$proximosEventos = [];
$pasadosEventos = [];

// Obtener la fecha actual
$fechaActual = date('Y-m-d');

// Verificar si se encontraron eventos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Clasificar los eventos en próximos y pasados según la fecha
        if ($row['fecha'] >= $fechaActual) {
            $proximosEventos[] = $row;
        } else {
            $pasadosEventos[] = $row;
        }
    }
} else {
    $noHayEventos = true;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>






<?php
include('header.php');
include('navbar_usuario.php');
?>
  


<div class="container mt-5">
    <h1 class="text-center mb-4">EVENTOS SOLIDARIOS</h1>

    <?php if (isset($noHayEventos) && $noHayEventos): ?>
        <p class="text-center">No se encontraron eventos.</p>
    <?php else: ?>

        <!-- Contenedor de los eventos -->
        <h2 class="text-center mt-5 mb-5">Próximos Eventos</h2>
        <div class="row justify-content-center">
            <?php if (!empty($proximosEventos)): ?>
                <?php foreach ($proximosEventos as $evento): ?>
                    <div class="col-md-4 mb-5 me-5">
                        <div class="card border-1 shadow">
                            <?php if (file_exists($evento['ruta_imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($evento['ruta_imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($evento['nombre']); ?>">
                            <?php else: ?>
                                <p class="text-muted">No hay imagen disponible para este evento.</p>
                            <?php endif; ?>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($evento['nombre']); ?></h5>
                                <p class="card-text"><strong>Fecha:</strong> <?php echo htmlspecialchars($evento['fecha']); ?></p>
                                <a href="../usuario/fichaEvento.php?id_evento=<?php echo htmlspecialchars($evento['id_evento']); ?>" class="btn btn-success">Más detalles</a>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No hay próximos eventos.</p>
            <?php endif; ?>
        </div>

        <!-- Contenedor de los eventos pasados -->
        <h2 class="text-center mt-5 mb-5">Eventos Pasados</h2>
        <div class="row justify-content-center">
            <?php if (!empty($pasadosEventos)): ?>
                <?php foreach ($pasadosEventos as $evento): ?>
                    <div class="col-md-4 mb-5 me-5">
                        <div class="card border-1 shadow">
                            <?php if (file_exists($evento['ruta_imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($evento['ruta_imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($evento['nombre']); ?>">
                            <?php else: ?>
                                <p class="text-muted">No hay imagen disponible para este evento.</p>
                            <?php endif; ?>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($evento['nombre']); ?></h5>
                                <p class="card-text"><strong>Fecha:</strong> <?php echo htmlspecialchars($evento['fecha']); ?></p>
                                <a href="../usuario/fichaEvento.php?id_evento=<?php echo htmlspecialchars($evento['id_evento']); ?>" class="btn btn-secondary">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No hay eventos pasados.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

  
 
<?php
    include('footer.php');
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>