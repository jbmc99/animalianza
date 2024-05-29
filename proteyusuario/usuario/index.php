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
  


  <div class="container text-center mb-5">
      <div class="col align-self-center mt-4">
        <h1 id="titulo" ><b>ANIMALIANZA</h1></b>
      </div>
      <div>
        <img src="../images/logueto.png" class="rounded mx-auto d-block" id="logueto" alt="...">
        </div>
        <div class="container text-center mt-0">
          ¡Por un mundo mejor para nuestros compañeros!
        </div>
      </div>
    </div>
    

    <div class="container text-center mt-5">
      <h2>ÚLTIMAS NOTICIAS</h2>
    <div id="carouselExampleIndicators" class="carousel slide center-caro" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../images/ejemploc1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../images/ejemploc2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../images/ejemploc3.jpeg" class="d-block w-100" alt="...">
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
    <br><br><br>


    <div class="container text-center mt-5 mb-5">
      <h2>¿Por qué adoptar?</h2>
  </div>
  
  <div class="grid text-center" style="--bs-columns: 1; --bs-gap: 1rem;">
      <div class="row">
          <div class="col-md-6 order-md-1 mb-3 mb-md-0">
              <img src="../images/razonesad1.jpg" class="img-fluid" width="400px" height="300px" alt="Descripción de la imagen">
          </div>
          <div class="col-md-6 order-md-1 mb-3 mb-md-0 d-flex align-items-center">
              <p class="px-md-1 me-5" id="primerarazon">Los refugios y organizaciones de rescate albergan una amplia gama de razas, tamaños, edades y personalidades 
                de animales que están esperando ser adoptados. Ya sea que estés buscando un cachorro enérgico, un gato mayor tranquilo o un 
                perro de raza mixta único, es muy probable que encuentres el animal perfecto que se adapte a tu estilo de vida y preferencias 
                en un refugio. Esta diversidad de opciones te permite tomar una decisión informada y seleccionar un compañero que realmente
                encaje con tu hogar y tu familia.</p>
          </div>
      </div>
      <div class="row mt-5 mb-5">
          <div class="col-md-6 order-md-3 text-end d-flex align-items-center">
              <p class="px-md-1 ms-5 pt-3" id="segundarazon">La mayoría de los refugios y organizaciones de rescate se encargan de esterilizar y vacunar a los 
                animales antes de que sean adoptados. Esto significa que tu nuevo compañero peludo ya estará protegido contra 
                enfermedades comunes y habrá sido esterilizado o castrado, lo que ayuda a controlar la población de animales y reduce el 
                riesgo de problemas de salud a largo plazo. Además, esto puede ahorrarte tiempo y dinero en comparación con la compra de 
                un animal de un criador o tienda de mascotas, donde tendrías que ocuparte de estos procedimientos por separado. 
               </p>
          </div>
          <div class="col-md-6 order-md-4">
              <img src="../images/razonesad2.jpeg" class="img-fluid" width="400px" height="300px" alt="Descripción de la imagen">
          </div>
      </div>
      <div class="row">
        <div class="col-md-6 order-md-1 mb-3 mb-md-0">
            <img src="../images/razonesad3.jpg" class="img-fluid" width="400px" height="300px" alt="Descripción de la imagen">
        </div>
        <div class="col-md-6 order-md-1 mb-5 mb-md-0 d-flex align-items-center">
            <p class="px-md-1 me-5" id="primerarazon">Los refugios y organizaciones de rescate albergan una amplia gama de razas, tamaños, edades y personalidades 
              de animales que están esperando ser adoptados. Ya sea que estés buscando un cachorro enérgico, un gato mayor tranquilo o un 
              perro de raza mixta único, es muy probable que encuentres el animal perfecto que se adapte a tu estilo de vida y preferencias 
              en un refugio. Esta diversidad de opciones te permite tomar una decisión informada y seleccionar un compañero que realmente
              encaje con tu hogar y tu familia.</p>
        </div>
    </div>
  </div>

 
  <?php
    include('footer.php');
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>