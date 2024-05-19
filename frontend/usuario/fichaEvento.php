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
  <!--NAVBAR-->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../images/logueto.png" alt="Logo" height="40" class="d-inline-block align-text-center">
      ANIMALIANZA
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionAnimales.php">Gestionar Animales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionAdopciones.php">Adopciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionCasaAcogida.php">Casa de Acogida</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionEventos.php">Eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionProductos.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionVoluntarios.php">Gestión voluntarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/logout.php">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
// Verificar si se ha proporcionado un ID de evento en la URL
if (isset($_GET['id_evento']) && is_numeric($_GET['id_evento'])) {
  // Obtener el ID del evento de la URL
  $id_evento = $_GET['id_evento'];

  // Incluir archivo de conexión a la base de datos
  require_once('../protectora/conexion.php');

  // Preparar la consulta SQL para obtener los detalles del evento con el ID proporcionado
  $stmt = $conn->prepare("SELECT * FROM evento WHERE id_evento = ?");
  $stmt->bind_param("i", $id_evento);

  // Ejecutar la consulta
  $stmt->execute();

  // Obtener el resultado
  $resultado = $stmt->get_result();

  // Verificar si se encontraron datos del evento
  if ($resultado->num_rows > 0) {
      $datos = $resultado->fetch_object();
      // Construir la ruta completa de la imagen
      $ruta_imagen = $datos->ruta_imagen;
?>
      <div class="container mt-5 ">
    <div class="row justify-content-center">
        <!-- Información del evento -->
        <div class="col-md-8 text-center">
            <h2 class="card-title mb-4"><?php echo $datos->nombre; ?></h2>
            <p class="card-text"><strong>Descripción:</strong> <?php echo $datos->descripcion; ?></p>
            <p class="card-text"><strong>Fecha:</strong> <?php echo $datos->fecha; ?></p>
            <!-- Mostrar la imagen -->
            <img src="<?php echo $ruta_imagen; ?>" width="400px" alt="Imagen del Evento">
        </div>
    </div>
</div>

<?php
  } else {
      // Mostrar un mensaje si no se encontraron datos del evento
      echo "<p>No se encontraron detalles del evento.</p>";
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
} else {
  // Mostrar un mensaje si no se proporcionó un ID de evento válido en la URL
  echo "<p>No se proporcionó un ID de evento válido.</p>";
}
?>



<!--FOOTER-->
<!--FOOTER-->
<footer class="footer-custom-bg text-center mt-5">
  <div class="container p-4 pb-0">
    <h4>¡Contacta con nosotros!</h4>
  </div>

  <div class="container p-4 pb-0">
    <section class="mb-4">
      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #3b5998;"
        href="#!"
        role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #55acee;"
        href="#!"
        role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #dd4b39;"
        href="#!"
        role="button"
        ><i class="fab fa-google"></i
      ></a>

      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #ac2bac;"
        href="#!"
        role="button"
        ><i class="fab fa-instagram"></i
      ></a>
    </section>

  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright: Animalianza
    <a class="text-body" href="https://animalianza.com/"> Animalianza.com</a>
  </div>

</footer>
<!-- Footer -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>