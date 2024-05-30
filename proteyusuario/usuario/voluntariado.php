
<?php
include('header.php');
include('navbar_usuario.php');
?>

 <div class="container mt-5">
    <h1 class="text-center mb-5">VOLUNTARIADO</h1>
    
    <div class="row">
        <div class="col-md-6">
          <h2>Únete como voluntario</h2>
          <p>
            En Animalianza, valoramos enormemente la ayuda de nuestros voluntarios. Como voluntario, tendrás la oportunidad de marcar la diferencia en la vida de los animales necesitados.
          </p>
          <p>
            Nuestros voluntarios desempeñan una variedad de roles, desde cuidar a los animales en nuestros refugios hasta ayudar con eventos de recaudación de fondos y concienciación.
          </p>
          <p>
            Si estás interesado en unirte como voluntario, ¡te animamos a que te pongas en contacto con nosotros para obtener más información!
          </p>
        </div>
        <div class="col-md-6">

          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../images/voluntariado1.jpg" class="d-block w-100" id="voluntariadoCarrusel1" alt="Voluntarios en acción">
              </div>
              <div class="carousel-item">
                <img src="../images/voluntariado2.jpg" class="d-block w-100" id="voluntariadoCarrusel2" alt="Voluntarios en acción">
              </div>
              <div class="carousel-item">
                <img src="../images/voluntariado3.jpeg" class="d-block w-100" id="voluntariadoCarrusel3" alt="Voluntarios en acción">
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
      </div>



      <?php

require_once('../protectora/conexion.php');

$sql = "SELECT id_protectora, nombre, info_prote, info_relevante, ruta_imagen FROM protectora WHERE acepta_voluntarios = 1";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-12 text-center mb-2 mt-5">';
  echo '<h2>Protectoras que aceptan voluntarios en este momento</h2>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  
  echo '<div id="page-content" class="container">';
  echo '<div class="row justify-content-center mt-5">';

  while ($fila = $resultado->fetch_assoc()) {
      echo '<div class="col-md-4 mb-3 d-flex align-items-stretch">';
      echo '<div class="card bg-transparent border-0 w-100 d-flex flex-column">';
      $image_path = $fila['ruta_imagen'];
      if (file_exists($image_path)) {
          echo '<img src="' . $image_path . '" class="card-img-top img-fluid" alt="Imagen de la protectora">';
      } else {
          echo '<p class="text-muted">No hay imagen disponible para esta protectora.</p>';
      }
      echo '<div class="card-body text-center d-flex flex-column">';
      echo '<h5 class="card-title">' . $fila['nombre'] . '</h5>';
      echo '<div class="d-grid gap-2 d-flex justify-content-center mt-auto">';
      echo '<a href="formulariovoluntariado.php?id_protectora=' . $fila['id_protectora'] . '" class="btn btn-success w-75">Solicitar voluntariado</a>';
      echo '</div>';
      echo '</div>'; 
      echo '</div>'; 
      echo '</div>'; 
  }
  
  echo '</div>'; 
  echo '</div>'; 
  
} else {
  echo "No se encontraron protectoras que acepten voluntarios en este momento.";
}

$conn->close();
?>

<div class="row mt-5 justify-content-center">
  <div class="col-md-6">
    <h2 class="text-center">Testimonios de nuestros voluntarios</h2>
    <div class="card-deck">
      <div class="card">
        <div class="card-body">
          <p class="card-text">"Ser voluntario ha sido una experiencia increíble. Me siento honrado de poder contribuir al bienestar de los animales y trabajar con un equipo tan dedicado".</p>
        </div>
        <div class="card-footer bg-transparent" >
          <small class="text-muted ">- Lucía de Cos</small>
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-body">
          <p class="card-text">"Me encanta pasar tiempo con los animales en el refugio. Ver cómo mejoran y encuentran hogares amorosos es muy gratificante".</p>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">- Cos de Lucía</small>
        </div>
      </div>
    </div>
  </div> 
</div>
 </div>
  
 
  <?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>