<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
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
<!--formulario de registro-->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">FORMULARIO PROTECTORAS</h2>
            <p class="text-center mt-2 mb-5">¿Deseas unirte a nuestra asociación? ¡Rellena el siguiente formulario y recibirás noticias nuestras!</p>
            <form action="procesar_registro_protectora.php" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-4">
                    <label for="nombreUsuarioProte" class="col-sm-4 col-form-label">Nombre de usuario</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreUsuarioProte" name="nombreUsuarioProte" placeholder="Introduzca el nombre de usuario" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="passwordProte" class="col-sm-4 col-form-label">Contraseña</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="passwordProte" name="passwordProte" placeholder="Introduzca una contraseña" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="nombreProte" class="col-sm-4 col-form-label">Nombre completo de la protectora</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreProte" name="nombreProte" placeholder="Introduzca el nombre completo de la protectora" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="emailContacto" class="col-sm-4 col-form-label">E-mail de contacto</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="emailContacto" name="emailContacto" placeholder="Introduzca un correo electrónico de contacto" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="numeroRegistro" class="col-sm-4 col-form-label">Número de registro como organización sin fines de lucro</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="numeroRegistro" name="numeroRegistro" placeholder="Introduzca el número de registro" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="direccion" class="col-sm-4 col-form-label">Dirección Completa</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca su dirección" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="infoProte" class="col-sm-4 col-form-label">Introduzca información sobre su protectora</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="infoProte" name="infoProte" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="infoRelevante" class="col-sm-4 col-form-label">Proporcione algún dato relevante (redes sociales, teléfono de contacto...)</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="infoRelevante" name="infoRelevante" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fotoProtectora">Subir foto:</label>
                    <input type="file" class="custom-file-upload" id="fotoProtectora" name="fotoProtectora">
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success mb-5">¡Regístrate!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

  
<footer class="footer-custom-bg text-center">
  <div class="container p-4 pb-0">
    <h4>¡Contacta con nosotros!</h4>
  </div>

  <div class="container p-4 pb-0">
    <section class="mb-4">
      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #3b5998;"
        href="#!"
        role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #55acee;"
        href="#!"
        role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #dd4b39;"
        href="#!"
        role="button"
        ><i class="fab fa-google"></i
      ></a>

      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #ac2bac;"
        href="#!"
        role="button"
        ><i class="fab fa-instagram"></i
      ></a>
    </section>

  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright: Animalianza
    <a class="text-body" href="https://animalianza.com/"> Animalianza.com</a>
  </div>

</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>