
<?php
include('../usuario/header.php');
?>
<!--esta navbar es diferente de las q ponemos con include, porq no tienen secciones-->
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

      </div>
    </div>
  </nav>

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

<?php include('../usuario/footer.php'); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>