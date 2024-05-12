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

<!-- Constructor para añadir animales -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Añade un animal</h2>
            <form action="procesar_animal.php" method="POST" enctype="multipart/form-data">
                <!-- Campo oculto para almacenar la id_protectora -->
                <input type="hidden" name="id_protectora" value="<?php echo $id_protectora; ?>">
                <div class="form-group row mb-4">
                    <label for="nombreAnimal" class="col-sm-4 col-form-label">Nombre del Animal</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreAnimal" name="nombreAnimal" placeholder="Introduzca el nombre del animal">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="especieAnimal" class="col-sm-4 col-form-label">Especie</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="especieAnimal" name="especieAnimal">
                            <option value="perro">Perro</option>
                            <option value="gato">Gato</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="razaAnimal" class="col-sm-4 col-form-label">Raza</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="razaAnimal" name="razaAnimal" placeholder="Introduzca la raza del animal">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="edadAnimal" class="col-sm-4 col-form-label">Edad</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edadAnimal" name="edadAnimal" placeholder="Introduzca la edad del animal">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="infoAnimal" class="col-sm-4 col-form-label">Información Adicional</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="infoAnimal" name="infoAnimal" rows="4" placeholder="Proporcione información adicional sobre el animal"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-4 col-form-label">¿Es un caso especial?</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="casoEspecial" id="siCasoEspecial" value="si">
                            <label class="form-check-label" for="siCasoEspecial">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="casoEspecial" id="noCasoEspecial" value="no" checked>
                            <label class="form-check-label" for="noCasoEspecial">No</label>
                        </div>
                    </div>
                </div>
                <!-- Campo de carga de archivos para la foto del animal -->
                <div class="form-group">
                    <label for="fotoAnimal">Foto del Animal</label>
                    <input type="file" class="form-control-file" id="fotoAnimal" name="fotoAnimal">
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Añadir Animal</button>
                    </div>
                </div>
            </form>
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