
<?php
include('header.php');
include('navbar_usuario.php');
?>

<?php
//se verifica si se ha proporcionado un ID de evento válido en la URL
if (isset($_GET['id_evento']) && is_numeric($_GET['id_evento'])) {
  //ahora se obtiene de la URL el ID del evento
  $id_evento = $_GET['id_evento'];

  require_once('../protectora/conexion.php');

  //preparamos la consulta para obtener los datos del evento
  $stmt = $conn->prepare("SELECT * FROM evento WHERE id_evento = ?");
  $stmt->bind_param("i", $id_evento);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
      $datos = $resultado->fetch_object();
      $ruta_imagen = $datos->ruta_imagen;
?>
      <div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="card-title mb-4"><?php echo $datos->nombre; ?></h2>
            <p class="card-text"><strong>Descripción:</strong> <?php echo $datos->descripcion; ?></p>
            <p class="card-text"><strong>Fecha:</strong> <?php echo $datos->fecha; ?></p>
            <img src="<?php echo $ruta_imagen; ?>" width="400px" alt="Imagen del Evento">
        </div>
    </div>
</div>

<?php
  } else {
      echo "<p>No se encontraron detalles del evento.</p>";
  }

  $conn->close();
} else {
  echo "<p>No se proporcionó un ID de evento válido.</p>";
}
?>

<?php
    include('footer.php');
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>