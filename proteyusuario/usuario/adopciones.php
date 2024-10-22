
  <?php
include('header.php');
include('navbar_usuario.php');

?>
  <div class="container text-center mb-5">
    <div class="col align-self-center mt-4 mb-5">
      <h1>¿Deseas adoptar?</h1>
    </div>
    <div class="d-flex flex-wrap justify-content-center ms-5 me-2">
    <div class="card ms-3 mb-3 me-5 bg-transparent border-0 h-100" id="card1">
        <img src="../images/categoriagato.jpg" class="card-img-top img-fluid" alt="...">
        <div class="card-body">
            <a href="gatosadopcion.php" class="btn btn-link  text-decoration-none">
                <h3>GATOS</h3>
            </a>
        </div>
    </div>

    <div class="card ms-3 mb-5 me-5 bg-transparent border-0 h-100" id="card2">
        <img src="../images/categoriaperro.jpg" class="card-img-top img-fluid" alt="...">
        <div class="card-body">
            <a href="perrosadopcion.php" class="btn btn-link  text-decoration-none">
                <h3>PERROS</h3>
            </a>
        </div>
    </div>   
</div>
</div>

  <div class="container text-center mb-5">
      <h3><b>¿Qué son los casos especiales?</b></h3>
      <p class="col align-self-center mt-4 mb-5">Si ves que en una ficha aparece 'caso especial', hay que tener especial precaución. Los casos especiales son los de 
        aquellos animales que requieren atención 
        y cuidados adicionales debido a razones como problemas de salud, discapacidades físicas o 
        mentales, traumas emocionales, comportamientos difíciles, edad avanzada, entre otros. Estos 
        animales necesitan cuidados específicos y a menudo requieren adoptantes compasivos dispuestos 
        a brindarles el cuidado y el amor que necesitan.</p>
    </div>

    <?php
    include('footer.php');
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>