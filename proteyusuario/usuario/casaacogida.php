<?php
include('navbar_usuario.php');
include('header.php');
?>

  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-2 mt-5">
        <h2>¿Deseas ser casa de acogida?</h2>
      </div>
    </div>
  </div>
  
  <div id="page-content" class="container">
    <div class="row mt-1">
      <div class="col-lg-8 offset-lg-2">
        <div class="text-center">
          <p>Ser casa de acogida para una protectora de animales es una labor increíblemente valiosa. Consiste en brindar temporalmente un hogar a animales rescatados que necesitan cuidados adicionales antes de ser adoptados de forma permanente. Como casa de acogida, no solo les proporcionarás refugio y alimentación, sino que también les darás amor, atención y posiblemente los prepararás para su futura adopción.</p>
        </div>
      </div>
    </div>
</div>
    <div class="container mt-3">
      <div class="row">
        <div class="col-12 text-center">
          <img src="../images/casadeacogida.jpg" class="img-fluid" id="casaacogida" alt="Casa de acogida">
        </div>
      </div>
    </div>
<div class="row mt-5">
  <div class="col-lg-8 offset-lg-2">
    <div id="divsinfondo2" class="text-center">
      <h4>Razones para ser casa de acogida</h4>
      <ol>
        <li>Brindar un hogar temporal a animales necesitados y ayudarles en su proceso de rehabilitación.</li>
        <li>Contribuir al bienestar animal y hacer una diferencia real en la vida de los animales en situación de abandono.</li>
        <li>Experimentar la gratificación emocional de cuidar y ver crecer a un animal que luego encontrará un hogar permanente.</li>
      </ol>
    </div>
  </div>
</div>
  <div class="container">
    <div class="row">
        <div class="col-12 text-center mb-3 mt-5">
            <h2>Protectoras que aceptan acogidas en este momento</h2>
        </div>
    </div>
</div>

<div id="page-content" class="container">
    <div class="row mt-5">

        <?php
        require_once('../protectora/conexion.php');

        //consultar a la base de datos las protectoras que aceptan acogidas
        $sql = "SELECT id_protectora, nombre, info_prote, info_relevante, ruta_imagen FROM protectora WHERE acepta_acogidas = 1";
        $resultado = $conn->query($sql);
        //si se han encontrado protectoras que aceptan acogidas las mostramos
        if ($resultado->num_rows > 0) {
            echo '<div class="container mt-5">';
            echo '<div class="row justify-content-center">'; 

            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="col-lg-4 mb-3 d-flex justify-content-center">'; 
                echo '<div class="card bg-transparent border-0 d-flex flex-column">'; 
                $image_path = $fila['ruta_imagen'];
                if (file_exists($image_path)) {
                    echo '<img src="' . $image_path . '" class="card-img-top img-fluid" alt="Imagen de la protectora">';
                } else {
                    echo '<p class="text-muted">No hay imagen disponible para esta protectora.</p>';
                }
                echo '<div class="card-body text-center d-flex flex-column">'; 
                echo '<h5 class="card-title">' . $fila['nombre'] . '</h5>';
                echo '<a href="formularioacogida.php?id_protectora=' . $fila['id_protectora'] . '" class="btn btn-success mt-auto mx-auto w-75">Solicitar acogida</a>'; // Añadido mt-auto mx-auto w-75
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo "No se encontraron protectoras que acepten acogidas en este momento.";
        }
        $conn->close();
        ?>
    </div>
</div>
<?php
    include('footer.php');
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>