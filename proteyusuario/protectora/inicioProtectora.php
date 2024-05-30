<!--accedemos a las variables de sesión y comprobamos q id_protectora está en la sesión 
si no está redirigimos a login.php-->
<?php
session_start();

if (!isset($_SESSION['id_protectora'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
include('../usuario/header.php');
include('navbar_protectora.php');
?>
  


<div class="container mt-5">
  <h1 class="text-center mb-4">¡BIENVENID@!</h1>
  <h3 class="text-center mb-4">¿Qué deseas hacer hoy?</h3>
  <div class="row justify-content-center">
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

<?php
    include('../usuario/footer.php');
    ?>

  
  
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>