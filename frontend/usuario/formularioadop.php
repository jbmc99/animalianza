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
    <!--formulario de adopción-->
    <div class="container mt-4">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h2 class="text-center mb-5">FORMULARIO DE ADOPCIÓN</h2>
            <form>
              <div class="form-group row mb-4">
                <label for="nombreApellidos" class="col-sm-4 col-form-label">Nombre y apellidos</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nombreApellidos" placeholder="Introduce tu nombre completo">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" placeholder="Introduzca su correo electrónico">
                </div>
              </div>
              <fieldset class="form-group">
                <div class="row mb-5">
                  <legend class="col-form-label col-sm-4 pt-0">¿A cuál de nuestros animales deseas adoptar?</legend>
                  <div class="col-sm-8">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="radio1" value="option1" checked>
                      <label class="form-check-label" for="radio1">
                        Perro
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="radio2" value="option2">
                      <label class="form-check-label" for="radio2">
                        Gato
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-4"></div>
                  <div class="col-sm-8">
                    <select class="form-select mt-2 mb-2" aria-label="Seleccione la protectora del animal">
                      <option selected disabled>Seleccione la protectora a la que pertenece</option>
                      <option value="Protectora A">Protectora A</option>
                      <option value="Protectora B">Protectora B</option>
                      <option value="Protectora C">Protectora C</option>
                    </select>
                    <select class="form-select mt-2" aria-label="Seleccione el nombre del animal">
                      <option selected disabled>Seleccione el nombre del animal</option>
                      <option value="animal 1">Lassie</option>
                      <option value="animal 2">Lasilla</option>
                      <option value="animal 3">Lasito</option>
                    </select>
                  </div>
                </div>
              </fieldset>
              
              <div class="form-group row mb-4">
                <label for="numeroTelefono" class="col-sm-4 col-form-label">Número de teléfono</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="numeroTelefono" placeholder="Introduzca su número de teléfono">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label for="direccion" class="col-sm-4 col-form-label">Dirección Completa</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nombreApellidos" placeholder="Introduzca su dirección">
                </div>
              </div>
             
              <fieldset class="form-group">
                <div class="row mb-5">
                  <legend class="col-form-label col-sm-4 pt-0">¿Es propietario o inquilino?</legend>
                  <div class="col-sm-8">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="radio1" value="option1" checked>
                      <label class="form-check-label" for="radio1">
                        Propietario
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="radio2" value="option2">
                      <label class="form-check-label" for="radio2">
                        Inquilino
                      </label>
                    </div>
                  </div>
              </fieldset>
              <fieldset class="form-group">
                <div class="row mb-5">
                  <legend class="col-form-label col-sm-4 pt-0">En caso de ser inquilino, ¿se le permite tener mascotas?</legend>
                  <div class="col-sm-8">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="radio1" value="option1" checked>
                      <label class="form-check-label" for="radio1">
                        Sí
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="radio2" value="option2">
                      <label class="form-check-label" for="radio2">
                        No
                      </label>
                    </div>
                  </div>
              </fieldset>
              <div class="form-group row mb-4">
                <label for="motivacionesAdoptar" class="col-sm-4 col-form-label">¿Cuáles son sus motivaciones para adoptar?</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="motivacionesAdoptar" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="infoFamilia" class="col-sm-4 col-form-label">Proporcione información sobre familia y estilo de vida</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="infoFamilia" rows="4"></textarea>
                </div>
            </div>

              <div class="form-group row text-center mt-5">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success">Solicitar adopción</button>
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