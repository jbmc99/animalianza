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
            <a class="nav-link" href="../usuario/index.html">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../usuario/adopciones.html">Adopciones</a>
          </li>
          <li class="nav-item dropdown" id="desplegableNavbar">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ¿Cómo ayudar?
            </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="../usuario/voluntariado.html">Voluntariado</a></li>
        <li><a class="dropdown-item" href="../usuario/donaciones.html">Donaciones</a></li>
        <li><a class="dropdown-item" href="../usuario/casaacogida.html">Casa de acogida</a></li>

    </ul>
</li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/tiendasolidaria.html">Tienda solidaria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/nuestrasprotectoras.html">Nuestras protectoras</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!--Aquí acaba la navbar-->

  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-2 mt-5">
        <h2>¿Deseas ser casa de acogida?</h2>
      </div>
    </div>
  </div>
  
  <div id="page-content" class="container">
    <!-- Descripción -->
    <div class="row mt-1">
      <div class="col-lg-8 offset-lg-2">
        <div class="card mb-2 bg-transparent border-0">
          <div class="card-body text-center">
            <p>Ser casa de acogida para una protectora de animales es una labor increíblemente valiosa. Consiste en brindar temporalmente un hogar a animales rescatados que necesitan cuidados adicionales antes de ser adoptados de forma permanente. Como casa de acogida, no solo les proporcionarás refugio y alimentación, sino que también les darás amor, atención y posiblemente los prepararás para su futura adopción.</p>
          </div>
        </div>
      </div>
    </div>
    
    <!--Imagen-->
    <div class="container mt-3">
      <div class="row">
        <div class="col-12 text-center">
          <img src="../images/casadeacogida.jpg" class="img-fluid" id="casaacogida" alt="Casa de acogida">
        </div>
      </div>
    </div>
    
    <!-- Razones para ser casa de acogida -->
    <div class="row mt-5">
      <div class="col-lg-8 offset-lg-2">
        <div class="card mb-3 bg-transparent border-0">
          <div class="card-body text-center">
            <h4>Razones para ser casa de acogida</h4>
            <ol>
              <li>Brindar un hogar temporal a animales necesitados y ayudarles en su proceso de rehabilitación.</li>
              <li>Contribuir al bienestar animal y hacer una diferencia real en la vida de los animales en situación de abandono.</li>
              <li>Experimentar la gratificación emocional de cuidar y ver crecer a un animal que luego encontrará un hogar permanente.</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-3 mt-5">
        <h2>Protectoras que aceptan acogidas en este momento</h2>
      </div>
    </div>
  </div>
  
  <div id="page-content" class="container">
    <!-- Fichas de Protectoras -->
    <div class="row mt-5">
      <!-- Protectora 1 -->
      <div class="col-lg-6 mb-3">
        <div class="card bg-transparent border-0">
          <img src="../images/ejemploprote1.jpg" class="card-img-top img-fluid" id="prote1" alt="...">
          <div class="card-body text-center">
            <h5 class="card-title">Rescate Animal Granada</h5>
            <a href="prote1.html" class="btn btn-success btn-block">Más información</a>
          </div>
        </div>
      </div>
      
      <!-- Protectora 2 -->
      <div class="col-lg-6 mb-3">
        <div class="card bg-transparent border-0">
          <img src="../images/ejemploprote2.jpg" class="card-img-top img-fluid" id="prote2" alt="...">
          <div class="card-body text-center">
            <h5 class="card-title">Amigos de los Animales Granada</h5>
            <a href="pagina2.html" class="btn btn-success btn-block">Más información</a>
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