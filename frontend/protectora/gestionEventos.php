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
  
    <!-- Contenedor de los eventos -->
    <h2 class="text-center mt-5 mb-5">Eventos actuales:</h2>
    <div class="row justify-content-center">
      <!-- Evento 1 -->
      <div class="col-md-4 mb-5 me-5">
        <div class="card border-1 shadow">
          <img src="../images/evento1.png" class="card-img-top" alt="...">
          <div class="card-body text-center">
            <h5 class="card-title">Nombre del Evento 1</h5>
            <p class="card-text">Descripción del evento.</p>
            <p class="card-text"><strong>Fecha:</strong> 10 de mayo de 2024</p>
            <a href="../usuario/fichaEvento.html" class="btn btn-success">Más detalles</a>
          </div>
        </div>
      </div>
      <!-- Evento 2 -->
      <div class="col-md-4 mb-5 ms-5">
        <div class="card border-0 shadow">
          <img src="../images/evento2.png" class="card-img-top" alt="...">
          <div class="card-body text-center">
            <h5 class="card-title">Nombre del Evento 2</h5>
            <p class="card-text">Descripción del evento.</p>
            <p class="card-text"><strong>Fecha:</strong> 15 de mayo de 2024</p>
            <a href="../usuario/fichaEvento.html" class="btn btn-success">Más detalles</a>
          </div>
        </div>
      </div>
    </div>

  
    <div class="text-center mt-1">
      <p>¿Qué deseas hacer?</p>
      <a href="constructorEvento.html" class="btn btn-success">Añadir evento</a>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eliminarEventoModal">
        Eliminar evento
      </button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#marcarEventoModal">
        Marcar evento como pasado
      </button>
    </div>
  </div>
  <div class="modal fade" id="eliminarAnimalModal" tabindex="-1" aria-labelledby="eliminarAnimalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarAnimalModalLabel">¿A qué animal deseas eliminar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="animalSelect">Selecciona el animal a eliminar:</label>
                    <select class="form-select" id="animalSelect">
                        <option selected>Seleccione un animal...</option>
                        <option value="arya">Arya</option>
                        <option value="candy">Candy</option>
                        <option value="hugo_neo">Hugo y Neo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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