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
          <li class="nav-item">
            <a class="nav-link" href="../usuario/eventos.php">Noticias y eventos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--Aqui acaba la navbar-->
  


  <div class="container text-center mb-5">
      <div class="col align-self-center mt-4">
        <h1><b>ANIMALIANZA</h1></b>
      </div>
      <div>
        <img src="../images/logueto.png" class="rounded mx-auto d-block" id="logueto" alt="...">
        </div>
        <div class="container text-center mt-0">
          ¡Por un mundo mejor para nuestros compañeros!
        </div>
      </div>
    </div>
    

    <div class="container text-center mt-5">
      <h2>ÚLTIMAS NOTICIAS</h2>
    <div id="carouselExampleIndicators" class="carousel slide center-caro" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../images/ejemploc1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../images/ejemploc2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../images/ejemploc3.jpeg" class="d-block w-100" alt="...">
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
    <br><br><br>


    <div class="container text-center mt-5 mb-5">
      <h2>¿Por qué adoptar?</h2>
  </div>
  
  <div class="grid text-center" style="--bs-columns: 1; --bs-gap: 1rem;">
      <div class="row">
          <div class="col-md-6 order-md-1 mb-3 mb-md-0">
              <img src="../images/razonesad1.jpg" class="img-fluid" width="400px" height="300px" alt="Descripción de la imagen">
          </div>
          <div class="col-md-6 order-md-1 mb-3 mb-md-0 d-flex align-items-center">
              <p class="px-md-1 me-5" id="primerarazon">Los refugios y organizaciones de rescate albergan una amplia gama de razas, tamaños, edades y personalidades 
                de animales que están esperando ser adoptados. Ya sea que estés buscando un cachorro enérgico, un gato mayor tranquilo o un 
                perro de raza mixta único, es muy probable que encuentres el animal perfecto que se adapte a tu estilo de vida y preferencias 
                en un refugio. Esta diversidad de opciones te permite tomar una decisión informada y seleccionar un compañero que realmente
                encaje con tu hogar y tu familia.</p>
          </div>
      </div>
      <div class="row mt-5 mb-5">
          <div class="col-md-6 order-md-3 text-end d-flex align-items-center">
              <p class="px-md-1 ms-5 pt-3" id="segundarazon">La mayoría de los refugios y organizaciones de rescate se encargan de esterilizar y vacunar a los 
                animales antes de que sean adoptados. Esto significa que tu nuevo compañero peludo ya estará protegido contra 
                enfermedades comunes y habrá sido esterilizado o castrado, lo que ayuda a controlar la población de animales y reduce el 
                riesgo de problemas de salud a largo plazo. Además, esto puede ahorrarte tiempo y dinero en comparación con la compra de 
                un animal de un criador o tienda de mascotas, donde tendrías que ocuparte de estos procedimientos por separado. 
               </p>
          </div>
          <div class="col-md-6 order-md-4">
              <img src="../images/razonesad2.jpeg" class="img-fluid" width="400px" height="300px" alt="Descripción de la imagen">
          </div>
      </div>
      <div class="row">
        <div class="col-md-6 order-md-1 mb-3 mb-md-0">
            <img src="../images/razonesad3.jpg" class="img-fluid" width="400px" height="300px" alt="Descripción de la imagen">
        </div>
        <div class="col-md-6 order-md-1 mb-5 mb-md-0 d-flex align-items-center">
            <p class="px-md-1 me-5" id="primerarazon">Los refugios y organizaciones de rescate albergan una amplia gama de razas, tamaños, edades y personalidades 
              de animales que están esperando ser adoptados. Ya sea que estés buscando un cachorro enérgico, un gato mayor tranquilo o un 
              perro de raza mixta único, es muy probable que encuentres el animal perfecto que se adapte a tu estilo de vida y preferencias 
              en un refugio. Esta diversidad de opciones te permite tomar una decisión informada y seleccionar un compañero que realmente
              encaje con tu hogar y tu familia.</p>
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