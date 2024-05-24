<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

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

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Formulario de Registro de Adoptantes</h2>
            <?php
                // Mostrar mensaje de error si hay alguno
                if (isset($_GET['error_message'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_GET['error_message'] . '</div>';
                }
            ?>
            <form action="procesar_registro_usuario.php" method="post">
                <div class="form-group row mb-4">
                    <label for="nombreUsuario" class="col-sm-4 col-form-label">Nombre de usuario</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Introduce tu nombre de usuario" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="passwordUsuario" class="col-sm-4 col-form-label">Contraseña</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" id="passwordUsuario" name="passwordUsuario" placeholder="Introduce una contraseña" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="emailContacto" class="col-sm-4 col-form-label">Correo electrónico</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="emailContacto" name="emailContacto" placeholder="Introduce tu correo electrónico" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="telefonoContacto" class="col-sm-4 col-form-label">Teléfono de contacto</label>
                    <div class="col-sm-8">
                        <input type="tel" class="form-control" id="telefonoContacto" name="telefonoContacto" placeholder="Introduce tu número de teléfono" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="direccion" class="col-sm-4 col-form-label">Dirección</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduce tu dirección" required>
                    </div>
                </div>

                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success mb-5">¡Registrarse como posible adoptante!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
