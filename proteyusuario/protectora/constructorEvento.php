
<?php
include('..usuario/header.php');
include('navbar_protectora.php');
?>
  
  
<!--constructor para añadir eventos-->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Añade un evento</h2>
            <form action="procesar_eventos.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_protectora" value="<?php echo $id_protectora; ?>">
                <div class="form-group row mb-4">
                    <label for="nombreEvento" class="col-sm-4 col-form-label">Nombre del Evento</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" placeholder="Introduzca el nombre del evento" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="descripcionEvento" class="col-sm-4 col-form-label">Descripción del Evento</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="descripcionEvento" name="descripcionEvento" rows="4" placeholder="Introduzca una descripción del evento" required></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="fechaEvento" class="col-sm-4 col-form-label">Fecha del Evento</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="fechaEvento" name="fechaEvento" required>
                    </div>
                </div>
                <!-- Agregar campo de estado -->
                <div class="form-group row mb-4">
                    <label for="estadoEvento" class="col-sm-4 col-form-label">Estado del Evento</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="estadoEvento" name="estadoEvento">
                            <option value="actual">Actual</option>
                            <option value="pasado">Pasado</option>
                        </select>
                    </div>
                </div>
                <!-- Campo de carga de archivos para la foto del evento -->
                <div class="form-group mb-4">
                <label for="fotoEvento" class="col-sm-4 col-form-label">Foto de la Protectora</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control-file" id="fotoEvento" name="fotoEvento" required>
                </div>
            </div>

                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success" name="submit">Añadir Evento</button>
                    </div>
                </div>
            </form>
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