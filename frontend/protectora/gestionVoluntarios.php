<!-- Obtener el id_protectora de la sesión -->
<?php
// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el id_protectora está almacenado en la sesión
if (!isset($_SESSION['id_protectora'])) {
    // Si no está almacenado, redirigir a la página de inicio de sesión
    header("Location: login.php"); 
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
    <title>Inicio</title>
    <link rel="stylesheet" href="../usuario/style.css">
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
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Adopciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Voluntariado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Donaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Nuestras protectoras</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


<!-- Title -->
<div class="container mt-5 mb-5 text-center">
  <h1>Gestión de voluntarios</h1>
</div>

<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <!-- Sección para aceptar voluntarios -->
        <div class="col-md-6 mb-4 protectora-row" data-id_protectora="<?php echo $id_protectora; ?>">
    <h2 class="text-center mb-3">¿Aceptáis voluntarios en este momento?</h2>
    <div class="d-flex justify-content-center mb-3">
        <select class="form-select me-2 acepta_voluntarios_select">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        <button class="btn btn-success confirmarBtn">Confirmar</button>
    </div>
</div>


<div class="col-md-6">
    <h2 class="text-center mb-3">Solicitudes de voluntariado</h2>
    <ul class="list-group">
        <?php
        // Incluir archivo de conexión a la base de datos
        require_once('../protectora/conexion.php');

        // Obtener el id_protectora de la sesión
        $idProtectora = $_SESSION['id_protectora'];

        // Preparar la consulta SQL para obtener todas las solicitudes de voluntariado
        $sql = "SELECT * FROM solicitud_voluntariado WHERE id_protectora = $idProtectora";
        // Ejecutar la consulta
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Recorrer cada fila de resultados
            while($row = $result->fetch_assoc()) {
                echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#solicitudModal'.$row["id_solicitud_voluntariado"].'">';
                echo $row["nombre_apellidos"];
                echo '<span class="badge bg-success rounded-pill" style="cursor:pointer;">Más información</span>';
                echo '</li>';

                // Generar modal para cada solicitud
                echo '<div class="modal fade" id="solicitudModal'.$row["id_solicitud_voluntariado"].'" tabindex="-1" aria-labelledby="solicitudModalLabel'.$row["id_solicitud_voluntariado"].'" aria-hidden="true">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="solicitudModalLabel'.$row["id_solicitud_voluntariado"].'">Detalles de la solicitud</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<p>Nombre y apellidos: '.$row["nombre_apellidos"].'</p>';
                echo '<p>Email: '.$row["email"].'</p>';
                echo '<p>Número de Teléfono: '.$row["numero_telefono"].'</p>';
                echo '<p>Vehículo Propio: '.($row["vehiculo_propio"] ? 'Sí' : 'No').'</p>';
                echo '<p>Estado: '.$row["estado"].'</p>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                echo '<button type="button" class="btn btn-success">Aceptar</button>';
                echo '<button type="button" class="btn btn-danger">Denegar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay solicitudes de voluntariado.";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
    </ul>
</div>
      </div>
      </div>

 <!--FOOTER-->
 <footer class="text-center text-lg-start bg-body-tertiary text-muted mt-5" id="footer">
    <!-- Redes sociales-->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
    </section>
  
    <!-- Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Company name
            </h6>
            <p>
              Here you can use rows and columns to organize your footer content. Lorem ipsum
              dolor sit amet, consectetur adipisicing elit.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
              <a href="#!" class="text-reset">React</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p>
          </div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
            <p>
              <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Orders</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Help</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              info@example.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
          </div>
        </div>
      </div>
    </section>
  
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
  </footer>
  <!-- Footer -->

      <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Obtener el valor del select y el ID de la protectora
$(".confirmarBtn").on("click", function() {
    // Obtener el valor seleccionado del select
    var acepta_voluntarios = $(this).siblings(".acepta_voluntarios_select").val();
    var id_protectora = $(this).closest(".protectora-row").data("id_protectora");

    // Imprimir los valores antes de enviar la solicitud AJAX
    console.log("Valor de acepta_voluntarios:", acepta_voluntarios);
    console.log("Valor de id_protectora:", id_protectora);

    // Enviar los datos al script PHP mediante Ajax
    $.ajax({
        url: "actualizar_voluntarios.php",
        method: "GET",
        data: {
            acepta_voluntarios: acepta_voluntarios,
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
  </body>
  </html>