
<?php
include('..usuario/header.php');
include('navbar_protectora.php');
?>
  

  <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Añade un Producto</h2>
            <!-- Elimina la etiqueta form que envuelve todo el contenido -->
            <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-4">
                    <label for="nombreProducto" class="col-sm-4 col-form-label">Nombre del Producto</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Introduzca el nombre del producto" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="descripcionProducto" class="col-sm-4 col-form-label">Descripción del Producto</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="4" placeholder="Introduzca una descripción del producto" required></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="precioProducto" class="col-sm-4 col-form-label">Precio del Producto</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" min="0" class="form-control" id="precioProducto" name="precioProducto" placeholder="Introduzca el precio del producto" required>
                    </div>
                </div>
                <!-- Campo de carga de archivos para la foto del producto -->
                <div class="form-group mb-4">
                    <label for="fotoProducto" class="col-sm-4 col-form-label">Foto del Producto</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="fotoProducto" name="fotoProducto" required>
                    </div>
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success" name="submit">Añadir Producto</button>
                    </div>
                </div>
            </form> <!-- Cierre de la etiqueta form -->
        </div>
    </div>
</div>

  
<!--FOOTER-->
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
<!-- Footer -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>