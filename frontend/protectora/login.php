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
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../images/logueto.png" alt="Logo" height="40" class="d-inline-block align-text-center">
        ANIMALIANZA
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
        </ul>
      </div>
    </div>
  </nav>
  <!-- Fin de Navbar -->



  
  <div class="container text-center mb-5">
    <div class="col align-self-center mt-3">
      <h1><b>ANIMALIANZA</h1></b>
    </div>
    <div>
      <img src="../images/logueto.png" class="rounded mx-auto d-block" id="logueto" alt="...">
    </div>
    </div>
  </div>
  
  <!-- Contenido principal -->
  <div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <form action="../protectora/procesar_login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_login" class="form-label">Tipo de Login</label>
                            <select class="form-select" id="tipo_login" name="tipo_login" required>
                               <option value="usuario">Usuario</option>
                               <option value="protectora">Protectora</option>
</select>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-5 mt-5">
        <h3 class="mb-4">¿Perteneces a una protectora y quieres unirte a nosotros?</h3>
        <h4 class="mb-4">Disfruta de las siguientes ventajas:</h4>
        <ul class="text-start">
          <li>Mayor visibilidad y alcance: Al unirse, las protectoras pueden llegar a más personas y aumentar las adopciones mediante campañas conjuntas y presencia compartida en redes sociales.</li>
          <li>Recursos compartidos: Compartir recursos como materiales de promoción y equipos reduce costos individuales y brinda acceso a recursos que podrían ser costosos de obtener por separado.</li>
          <li>Colaboración en programas de adopción: Coordinar programas de adopción conjuntos aumenta las oportunidades de encontrar hogares para los animales y garantiza un seguimiento post-adopción más efectivo.</li>
          <li>Apoyo y orientación: Las protectoras reciben apoyo, asesoramiento y orientación de otras con más experiencia en áreas como cuidado animal, recaudación de fondos y gestión de voluntarios.</li>
          <li>Influencia política y defensa: Unirse fortalece la voz colectiva para abogar por leyes y políticas que beneficien a los animales y permite abordar problemas específicos en la comunidad.</li>
          <li>Formación y desarrollo profesional: Se ofrecen oportunidades de capacitación y desarrollo para mejorar habilidades y conocimientos en áreas relevantes.</li>
        </ul>
        <a href="../protectora/formularioprote.php" class="btn btn-success mt-5">¡Únete como protectora!</a>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-5 mt-5">
        <h3 class="mb-4">¿Quieres ser parte de la asociación?</h3>
        <h4 class="mb-4">Descubre los beneficios de unirte como posible adoptante:</h4>
        <ul class="text-start">
          <li>Encuentra tu compañero ideal: Al unirte, tendrás acceso a una amplia variedad de animales que buscan un hogar amoroso, aumentando tus posibilidades de encontrar tu compañero perfecto.</li>
          <li>Apoyo y orientación personalizados: Recibirás orientación y apoyo de profesionales y voluntarios dedicados, quienes te ayudarán en cada paso del proceso de adopción.</li>
          <li>Participación en eventos y programas especiales: Como miembro, podrás participar en eventos de adopción exclusivos y programas especiales que brindan oportunidades únicas para conectar con animales necesitados.</li>
          <li>Comunidad comprometida: Únete a una comunidad de amantes de los animales que comparten tu pasión por el bienestar animal y te brindarán apoyo continuo en tu viaje de adopción.</li>
          <li>Oportunidades de aprendizaje y desarrollo: Accede a recursos educativos y programas de capacitación para mejorar tus habilidades como cuidador de animales y fortalecer tu conexión con tu nueva mascota.</li>
          <li>Impacto positivo: Al adoptar, no solo cambiarás la vida de un animal, sino que también estarás contribuyendo a la reducción del problema de la sobrepoblación y el abandono de mascotas en tu comunidad.</li>
        </ul>
        <a href="../usuario/formulariousuario.php" class="btn btn-success mt-5">¡Regístrate como posible adoptante!</a>
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