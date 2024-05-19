<?php
session_start();

if (!isset($_SESSION['id_protectora'])) {
    header('Location: login.php');
    exit;
}
?>

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
          <a class="nav-link" href="../protectora/inicioProtectora.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionAnimales.php">Gestionar Animales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionAdopciones.php">Adopciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionCasaAcogida.php">Casa de Acogida</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionEventos.php">Eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionProductos.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/gestionVoluntarios.php">Gestión voluntarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../protectora/logout.php">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-5">
  <h1 class="text-center mb-4">¡Bienvenid@!</h1>
  <h3 class="text-center mb-4">¿Qué deseas hacer hoy?</h3>
  <div class="row justify-content-center">
    <!-- Card: Gestionar Animales -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 text-center bg-transparent border-2">
        <div class="card-body">
          <h5 class="card-title">Gestionar Animales</h5>
          <p class="card-text">Añadir un animal nuevo o eliminar uno existente.</p>
        </div>
        <div class="card-footer">
          <a href="../protectora/gestionAnimales.php" class="btn btn-success">Ir a la gestión</a>
        </div>
      </div>
    </div>
    <!-- Card: Adopciones -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 text-center bg-transparent border-2">
        <div class="card-body">
          <h5 class="card-title">Adopciones</h5>
          <p class="card-text">Ver y gestionar procesos de adopción de animales.</p>
        </div>
        <div class="card-footer">
          <a href="../protectora/gestionAdopciones.php" class="btn btn-success">Ir a adopciones</a>
        </div>
      </div>
    </div>
    <!-- Card: Casa de Acogida -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 text-center bg-transparent border-2">
        <div class="card-body">
          <h5 class="card-title">Casa de Acogida</h5>
          <p class="card-text">Administrar animales en casa de acogida.</p>
        </div>
        <div class="card-footer">
          <a href="../protectora/gestionCasaAcogida.php" class="btn btn-success">Ir a casa de acogida</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <!-- Card: Eventos -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 text-center bg-transparent border-2">
        <div class="card-body">
          <h5 class="card-title">Eventos</h5>
          <p class="card-text">Agregar o finalizar eventos relacionados con la protectora.</p>
        </div>
        <div class="card-footer">
          <a href="../protectora/gestionEventos.php" class="btn btn-success">Ir a eventos</a>
        </div>
      </div>
    </div>
    <!-- Card: Productos -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 text-center bg-transparent border-2">
        <div class="card-body">
          <h5 class="card-title">Productos</h5>
          <p class="card-text">Ver y gestionar tus productos.</p>
        </div>
        <div class="card-footer">
          <a href="../protectora/gestionProductos.php" class="btn btn-success">Ir a productos</a>
        </div>
      </div>
    </div>

    <!-- Card: Voluntarios -->
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-100 text-center bg-transparent border-2">
        <div class="card-body">
          <h5 class="card-title">Voluntarios</h5>
          <p class="card-text">Ver y gestionar tus solicitudes de voluntariado</p>
        </div>
        <div class="card-footer">
          <a href="../protectora/gestionVoluntarios.php" class="btn btn-success">Ir a voluntarios</a>
        </div>
      </div>
    </div>
  </div>
</div>


<footer class="footer-custom-bg text-center mt-5">
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