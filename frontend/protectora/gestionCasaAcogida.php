<!-- Obtener el id_protectora de la sesión -->
<?php
// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el id_protectora está almacenado en la sesión
if (!isset($_SESSION['id_protectora'])) {
    // Si no está almacenado, redirigir a la página de inicio de sesión
    header("Location: login.php"); // Cambiar 'login.php' por la página de inicio de sesión
    exit();
}

// Obtener el id_protectora de la sesión
$id_protectora = $_SESSION['id_protectora'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de casas de acogida</title>
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
          <a class="nav-link" href="../protectora/inicioProtectora.php">Inicio</a>
        </li>
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

  <div class="container mt-5 mb-5 text-center">
    <h1>Gestión de casas de acogida</h1>
  </div>

  <!-- Content -->
  <div class="container mt-3">
  <div class="row">
    <!-- Sección para aceptar adopciones -->
    <div class="col-md-6 mb-4 protectora-row" data-id_protectora="<?php echo $id_protectora; ?>">
      <h2 class="text-center mb-3">¿Aceptáis acogidas en este momento?</h2>
      <div class="d-flex justify-content-center mb-3">
        <select class="form-select me-2 acepta_acogidas_select">
          <option value="1">Sí</option>
          <option value="0">No</option>
        </select>
        <button class="btn btn-success confirmarBtn">Confirmar</button>
      </div>
    </div>


<!-- Sección para ver solicitudes de casa de acogida -->
<div class="col-md-6">
    <h2 class="text-center mb-3">Solicitudes de casa de acogida</h2>
    <ul class="list-group">
        <?php
        // Incluir archivo de conexión a la base de datos
        require_once('../protectora/conexion.php');

        // Preparar la consulta SQL para obtener todas las solicitudes de casa de acogida
        $sql = "SELECT solicitud_acogida.*, animal.nombre AS nombre_animal FROM solicitud_acogida JOIN animal ON solicitud_acogida.id_animal = animal.id_animal WHERE solicitud_acogida.id_protectora = $id_protectora";

        // Ejecutar la consulta
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Recorrer cada fila de resultados
            while($row = $result->fetch_assoc()) {
                echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#solicitudModal'.$row["id_solicitud_acogida"].'">';
                echo $row["nombre_animal"];
                echo '<span class="badge bg-success rounded-pill" style="cursor:pointer;">Más información</span>';
                echo '</li>';

                echo '<div class="modal fade" id="solicitudModal'.$row["id_solicitud_acogida"].'" tabindex="-1" aria-labelledby="solicitudModalLabel'.$row["id_solicitud_acogida"].'" aria-hidden="true">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="solicitudModalLabel'.$row["id_solicitud_acogida"].'">Detalles de la solicitud</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<p>Nombre: '.$row["nombre_apellidos"].'</p>';
                echo '<p>Email: '.$row["email"].'</p>';
                echo '<p>ID Protectora: '.$row["id_protectora"].'</p>';
                echo '<p>ID Animal: '.$row["id_animal"].'</p>';
                echo '<p>Número de Teléfono: '.$row["telefono"].'</p>';
                echo '<p>Dirección: '.$row["direccion"].'</p>';
                echo '<p>Motivaciones para la acogida: '.$row["motivaciones"].'</p>';
                echo '<p>Información del hogar y estilo de vida: '.$row["estilo_vida"].'</p>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                echo '<button type="button" class="btn btn-success">Aceptar</button>';
                echo '<button type="button" class="btn btn-danger">Denegar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
        } else {
            echo '<li class="list-group-item">No hay solicitudes de casa de acogida.</li>';
        }
        ?>
    </ul>
</div>
      </div>
      </div>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
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
  
 <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Obtener el valor del select y el ID de la protectora
    $(".confirmarBtn").on("click", function() {
        var acepta_acogidas = $(this).siblings(".acepta_acogidas_select").val();
        var id_protectora = $(this).closest(".protectora-row").data("id_protectora");

        // Imprimir los valores antes de enviar la solicitud AJAX
        console.log("Valor de acepta_acogidas:", acepta_acogidas);
        console.log("Valor de id_protectora:", id_protectora);

        // Enviar los datos al script PHP mediante Ajax
        $.ajax({
            url: "actualizar_acogida.php",
            method: "GET",
            data: {
                acepta_acogidas: acepta_acogidas,
                id_protectora: id_protectora
            },
            success: function(response) {
                // Mostrar un alert para notificar al usuario
                alert("El estado se ha actualizado correctamente.");

                console.log(response); // Maneja la respuesta del servidor según sea necesario
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Maneja los errores de Ajax
            }
        });
    });
</script>

</script>

</body>
</html>

