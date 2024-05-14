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
            <a class="nav-link" href="../usuario/index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../usuario/adopciones.php">Adopciones</a>
          </li>
          <li class="nav-item dropdown" id="desplegableNavbar">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ¿Cómo ayudar?
            </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="../usuario/voluntariado.php">Voluntariado</a></li>
        <li><a class="dropdown-item" href="../usuario/donaciones.php">Donaciones</a></li>
        <li><a class="dropdown-item" href="../usuario/casaacogida.php">Casa de acogida</a></li>

    </ul>
</li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/tiendasolidaria.php">Tienda solidaria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/nuestrasprotectoras.php">Nuestras protectoras</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  
  
<div class="container text-center mb-5">
    <div class="col align-self-center mt-4 mb-5">
        <h1><b>PERROS Y GATOS</b></h1>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-4 mb-5">
            <select class="form-select" aria-label="Seleccione la protectora">
                <option selected>Seleccione la protectora</option>
                <!-- Aquí puedes agregar opciones de protectoras si es necesario -->
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label="Seleccione el color">
                <option selected>Seleccione el color</option>
                <!-- Aquí puedes agregar opciones de colores si es necesario -->
            </select>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-success">Filtrar</button>
        </div>
    </div>
    <!--CARDS-->
    <div class="d-flex flex-wrap justify-content-center ms-5 me-2">
        <?php
        // Iniciar la sesión
        session_start();

        // Verificar si se ha iniciado sesión y se ha almacenado el ID de la protectora
        if (isset($_SESSION['id_protectora'])) {
            // Obtener el ID de la protectora de la sesión
            $id_protectora = $_SESSION['id_protectora'];

            // Incluir archivo de conexión
            require_once('../protectora/conexion.php');

            // Consultar la base de datos para obtener todas las tarjetas de perros y gatos de la protectora actual
            $sql = "SELECT * FROM animal WHERE (especie = 'Perro' OR especie = 'Gato') AND id_protectora = $id_protectora";
            $resultado = $conn->query($sql);

            // Verificar si se encontraron perros y/o gatos
            if ($resultado->num_rows > 0) {
                // Mostrar todas las tarjetas de perros y gatos de la protectora actual
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="card ms-3 mb-3 me-5 bg-transparent border-0" id="card' . $fila['id_animal'] . '">';
                    echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; // Enlace a la página de detalles del animal
                    echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Foto del animal">';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-link text-dark text-decoration-none">';
                    echo '<h3>' . $fila['nombre'] . '</h3>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron perros ni gatos para adopción.";
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
        } else {
            echo "No se ha iniciado sesión.";
        }
        ?>
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