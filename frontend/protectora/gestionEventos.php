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

<!-- Contenido principal -->
<div class="container">
    <!-- Título -->
    <h2 class="text-center mt-5 mb-5">Gestión de eventos</h2>

    <!-- Contenedor de eventos actuales -->
    <h2 class="text-center mt-5 mb-3">Eventos actuales:</h2>
    <div class="row justify-content-center">
        <?php
        require_once('conexion.php');

        // Consulta SQL para eventos actuales
        $sql = "SELECT * FROM evento WHERE estado = 'actual'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                // Aquí se muestra cada evento actual
                echo "<div class='col-md-4 mb-5'>";
                echo "<div class='card border-1 shadow'>";
                echo "<div class='card-body text-center'>";
                echo "<h5 class='card-title'>" . $fila['nombre'] . "</h5>";
                echo "<p class='card-text'>" . $fila['descripcion'] . "</p>";
                echo "<p class='card-text'><strong>Fecha:</strong> " . $fila['fecha'] . "</p>";

                // Mostrar la foto del evento si existe
                if (!empty($fila['ruta_imagen'])) {
                    echo "<img src='" . $fila['ruta_imagen'] . "' class='img-fluid mb-3' alt='Foto del Evento'>";
                } else {
                    echo "<p class='text-muted'>No hay foto disponible para este evento.</p>";
                }

                echo "<a href='../usuario/fichaEvento.php?id=" . $fila['id_evento'] . "' class='btn btn-success me-1'>Más detalles</a>";
                // Botón para editar evento
                echo "<button type='button' class='btn btn-success ms-1' data-bs-toggle='modal' data-bs-target='#editarEventoModal" . $fila['id_evento'] . "'>Editar</button>";                
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Modal para editar evento
                echo "<div class='modal fade' id='editarEventoModal" . $fila['id_evento'] . "' tabindex='-1' aria-labelledby='editarEventoModalLabel" . $fila['id_evento'] . "' aria-hidden='true'>";
                echo "<div class='modal-dialog'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='editarEventoModalLabel" . $fila['id_evento'] . "'>Editar evento: " . $fila['nombre'] . "</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                // Formulario para editar el evento
                echo "<form action='editarEvento.php' method='post' enctype='multipart/form-data'>";
                echo "<input type='hidden' name='id_evento' value='" . $fila['id_evento'] . "'>";
                echo "<div class='form-group'>";
                echo "<label for='nombreEvento'>Nombre:</label>";
                echo "<input type='text' class='form-control' id='nombreEvento' name='nombreEvento' value='" . $fila['nombre'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='descripcionEvento'>Descripción:</label>";
                echo "<textarea class='form-control' id='descripcionEvento' name='descripcionEvento'>" . $fila['descripcion'] . "</textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='fechaEvento'>Fecha:</label>";
                echo "<input type='date' class='form-control' id='fechaEvento' name='fechaEvento' value='" . $fila['fecha'] . "'>";
                echo "</div>";

                // Campo de carga de archivos para la foto del evento
                echo "<div class='form-group'>";
                echo "<label for='fotoEvento'>Foto del Evento:</label>";
                echo "<input type='file' class='form-control-file' id='fotoEvento' name='fotoEvento'>";
                echo "</div>";

                echo "<button type='submit' class='btn btn-primary'>Guardar cambios</button>";
                echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

            }
        } else {
            echo "<p class='text-center'>No se encontraron eventos actuales.</p>";
        }
        ?>
    </div>

    <!-- Contenedor de eventos pasados -->
    <h2 class="text-center mt-5 mb-3">Eventos pasados:</h2>
    <div class="row justify-content-center">
        <?php
        // Consulta SQL para eventos pasados
        $sql = "SELECT * FROM evento WHERE estado = 'pasado'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                // Aquí se muestra cada evento pasado
                echo "<div class='col-md-4 mb-5'>";
                echo "<div class='card border-1 shadow'>";
                echo "<div class='card-body text-center'>";
                echo "<h5 class='card-title'>" . $fila['nombre'] . "</h5>";
                echo "<p class='card-text'>" . $fila['descripcion'] . "</p>";
                echo "<p class='card-text'><strong>Fecha:</strong> " . $fila['fecha'] . "</p>";

                // Mostrar la foto del evento si existe
                if (!empty($fila['ruta_imagen'])) {
                    echo "<img src='" . $fila['ruta_imagen'] . "' class='img-fluid mb-3' alt='Foto del Evento'>";
                } else {
                    echo "<p class='text-muted'>No hay foto disponible para este evento.</p>";
                }

                echo "<a href='../usuario/fichaEvento.php?id=" . $fila['id_evento'] . "' class='btn btn-success me-1'>Más detalles</a>";
                // Botón para editar evento
                echo "<button type='button' class='btn btn-success ms-1' data-bs-toggle='modal' data-bs-target='#editarEventoModal" . $fila['id_evento'] . "'>Editar</button>";                
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Modal para editar evento
                echo "<div class='modal fade' id='editarEventoModal" . $fila['id_evento'] . "' tabindex='-1' aria-labelledby='editarEventoModalLabel" . $fila['id_evento'] . "' aria-hidden='true'>";
                echo "<div class='modal-dialog'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='editarEventoModalLabel" . $fila['id_evento'] . "'>Editar evento: " . $fila['nombre'] . "</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                // Formulario para editar el evento
                echo "<form action='editarEvento.php' method='post'>";
                echo "<input type='hidden' name='id_evento' value='" . $fila['id_evento'] . "'>";
                echo "<div class='form-group'>";
                echo "<label for='nombreEvento'>Nombre:</label>";
                echo "<input type='text' class='form-control' id='nombreEvento' name='nombreEvento' value='" . $fila['nombre'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='descripcionEvento'>Descripción:</label>";
                echo "<textarea class='form-control' id='descripcionEvento' name='descripcionEvento'>" . $fila['descripcion'] . "</textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='fechaEvento'>Fecha:</label>";
                echo "<input type='date' class='form-control' id='fechaEvento' name='fechaEvento' value='" . $fila['fecha'] . "'>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-primary'>Guardar cambios</button>";
                echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>No se encontraron eventos pasados.</p>";
        }
        ?>
    </div>
</div>

<div class="text-center mt-1">
    <p>¿Qué deseas hacer?</p>
    <div class="d-flex justify-content-center mt-1">
        <a href="constructorEvento.php" class="btn btn-success me-2">Añadir evento</a>
        <!-- Botón para eliminar evento -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eliminarEventoModal">Eliminar evento</button>
    </div>
</div>


<!-- Modal para eliminar evento -->
<div class="modal fade" id="eliminarEventoModal" tabindex="-1" aria-labelledby="eliminarEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarEventoModalLabel">¿Qué evento deseas eliminar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para seleccionar el evento a eliminar -->
                <form action="eliminarEvento.php" method="post">
                    <div class="form-group">
                        <label for="eventoSelect">Selecciona el evento a eliminar:</label>
                        <select class="form-select" id="eventoSelect" name="id_evento">
                            <option selected disabled>Seleccione un evento...</option>
                            <?php
                            // Mostrar opciones dinámicamente
                            $sql = "SELECT * FROM evento";
                            $resultado = $conn->query($sql);
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "<option value='" . $fila['id_evento'] . "'>" . $fila['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
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
  
  
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>