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
    <div class="col align-self-center mt-4 mb-5">
      <h1>DONACIONES</h1>
    </div>
    <div class="container text-center mb-5">
        <h3><b>¿Cómo puedes donar?</b></h3>
        <p class="col align-self-center mt-4 mb-5">
            Son muchos los gastos mensuales que afrontamos (pienso, veterinario, medicación, mantenimiento de las instalaciones, transportes...) 
            y necesitamos constantemente medios para afrontarlos, si no, no sería posible salvar a todos los animales que salvamos.
            También aceptamos cosas que no utilices y creas que nos puede ser de utilidad, como mantas, comederos, juguetes, productos de 
            limpieza, piensos y medicinas*, etc. ¡Incluso herramientas o materiales de obra! Antes de tirarlo, piensa si lo podríamos usar 
            de alguna manera.</p>
            <p class="col align-self-center mt-4 mb-5"> ¡Nos puedes ayudar de muchas maneras! Te dejamos a continuación una lista con todas, haz click sobre ellas para saber más:</p>
      </div>
    
    
  
      <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none text-dark" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                PayPal
              </button>
            </h5>
          </div>
    
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
            <div class="card-body">
              <img src="../images/paypal.png" id="logopaypal" class="mb-2">
              <p>Si prefieres realizar una donación monetaria puntual, puedes enviar la cantidad que desees a nuestro Paypal</p>
              <a href="https://www.paypal.com/es/home" class="btn btn-success">Acceder</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-decoration-none text-dark" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Teaming
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
            <div class="card-body">
              <img src="../images/teaming.png" id="logoteaming" class="mb-2">
              <p>Por tan sólo 1€ al mes podrás formar parte de nuestro equipo de teaming y ayudarnos a seguir adelante.</p>
              <a href="https://www.teaming.net/?lang=es_ES" class="btn btn-success">Acceder</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-decoration-none text-dark" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Amazon
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
            <div class="card-body">
              <img src="../images/amazon.png" id="logoamazon" class="mb-2">
              <p>Desde nuestra Lista de deseos de Amazon podrás enviarnos lo que necesitan los peludos en su día a día en el refugio, ¡nosotros se lo haremos llegar de tu parte! </p>
              <a href="https://www.amazon.es/" class="btn btn-success">Acceder</a>
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