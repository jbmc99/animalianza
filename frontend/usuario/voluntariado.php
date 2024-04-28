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
  <!--Aquí acaba la navbar-->


 <!-- Contenido de la página -->
 <div class="container mt-5">
    <h1 class="text-center mb-5">VOLUNTARIADO</h1>
    
    <div class="row">
        <div class="col-md-6">
          <h2>Únete como voluntario</h2>
          <p>
            En Animalianza, valoramos enormemente la ayuda de nuestros voluntarios. Como voluntario, tendrás la oportunidad de marcar la diferencia en la vida de los animales necesitados.
          </p>
          <p>
            Nuestros voluntarios desempeñan una variedad de roles, desde cuidar a los animales en nuestros refugios hasta ayudar con eventos de recaudación de fondos y concienciación.
          </p>
          <p>
            Si estás interesado en unirte como voluntario, ¡te animamos a que te pongas en contacto con nosotros para obtener más información!
          </p>
        </div>
        <div class="col-md-6">
          <!-- Carrusel de imágenes -->
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../images/voluntariado1.jpg" class="d-block w-100" id="voluntariadoCarrusel1" alt="Voluntarios en acción">
              </div>
              <div class="carousel-item">
                <img src="../images/voluntariado2.jpg" class="d-block w-100" id="voluntariadoCarrusel2" alt="Voluntarios en acción">
              </div>
              <div class="carousel-item">
                <img src="../images/voluntariado3.jpeg" class="d-block w-100" id="voluntariadoCarrusel3" alt="Voluntarios en acción">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>



      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-2 mt-5">
            <h2>Protectoras que aceptan voluntarios en este momento</h2>
          </div>
        </div>
      </div>
      
      <div id="page-content" class="container">
        <!-- Fichas de Protectoras -->
        <div class="row mt-5">
          <!-- Protectora 1 -->
          <div class="col-12 mb-3">
            <div class="card bg-transparent border-0">
              <img src="../images/ejemploprote1.jpg" class="card-img-top img-fluid" id="prote1" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title">Rescate Animal Granada</h5>
                <a href="prote1.php" class="btn btn-success btn-block">Solicitar voluntariado</a>
              </div>
            </div>
          </div>
          
          <!-- Protectora 2 -->
          <div class="col-12 mb-3">
            <div class="card bg-transparent border-0">
              <img src="../images/ejemploprote2.jpg" class="card-img-top img-fluid" id="prote2" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title">Amigos de los Animales Granada</h5>
                <a href="prote1.php" class="btn btn-success btn-block">Solicitar voluntariado</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Testimonios de voluntarios -->
    <div class="row mt-5">
      <div class="col-md-12">
        <h2>Testimonios de nuestros voluntarios</h2>
        <div class="card-deck">
          <div class="card">
            <div class="card-body">
              <p class="card-text">"Ser voluntario en Animalianza ha sido una experiencia increíble. Me siento honrado de poder contribuir al bienestar de los animales y trabajar con un equipo tan dedicado".</p>
            </div>
            <div class="card-footer" id="experienciaVoluntario">
              <small class="text-muted">- Lucía de Cos</small>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <p class="card-text">"Me encanta pasar tiempo con los animales en el refugio. Ver cómo mejoran y encuentran hogares amorosos es muy gratificante".</p>
            </div>
            <div class="card-footer" id="experienciaVoluntario">
              <small class="text-muted">- Cos de Lucía</small>
            </div>
          </div>
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