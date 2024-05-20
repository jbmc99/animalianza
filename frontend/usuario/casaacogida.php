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

<?php
include('navbar_usuario.php');
?>

  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-2 mt-5">
        <h2>¿Deseas ser casa de acogida?</h2>
      </div>
    </div>
  </div>
  
  <div id="page-content" class="container">
    <!-- Descripción -->
    <div class="row mt-1">
      <div class="col-lg-8 offset-lg-2">
        <div class="text-center">
          <p>Ser casa de acogida para una protectora de animales es una labor increíblemente valiosa. Consiste en brindar temporalmente un hogar a animales rescatados que necesitan cuidados adicionales antes de ser adoptados de forma permanente. Como casa de acogida, no solo les proporcionarás refugio y alimentación, sino que también les darás amor, atención y posiblemente los prepararás para su futura adopción.</p>
        </div>
      </div>
    </div>
</div>
    
    <!--Imagen-->
    <div class="container mt-3">
      <div class="row">
        <div class="col-12 text-center">
          <img src="../images/casadeacogida.jpg" class="img-fluid" id="casaacogida" alt="Casa de acogida">
        </div>
      </div>
    </div>
    
    <!-- Razones para ser casa de acogida -->
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
    <!-- Fichas de Protectoras -->
    <div class="row mt-5">

        <?php
        // Incluir archivo de conexión a la base de datos
        require_once('../protectora/conexion.php');

        // Consultar la base de datos para obtener las protectoras que aceptan acogidas
        $sql = "SELECT id_protectora, nombre, info_prote, info_relevante, ruta_imagen FROM protectora WHERE acepta_acogidas = 1";
        $resultado = $conn->query($sql);
        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Contenedor y fila fuera del bucle
            echo '<div class="container mt-5">';
            echo '<div class="row justify-content-center">'; // Añadimos la clase justify-content-center para centrar las tarjetas
        
            // Iterar sobre los resultados y generar el HTML para cada card
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="col-lg-4 mb-3">'; // Cambiamos col-lg-6 a col-lg-4 para que cada tarjeta ocupe 3 columnas
                echo '<div class="card bg-transparent border-0">';
                echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Imagen de la protectora">';
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title">' . $fila['nombre'] . '</h5>';
                echo '<a href="formularioacogida.php?id_protectora=' . $fila['id_protectora'] . '" class="btn btn-success btn-block">Solicitar acogida</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        
            // Cerrar contenedor y fila
            echo '</div>';
            echo '</div>';
        } else {
            echo "No se encontraron protectoras que acepten acogidas en este momento.";
        }
        // Cerrar la conexión a la base de datos
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