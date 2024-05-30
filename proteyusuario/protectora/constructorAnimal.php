
<?php
include('..usuario/header.php');
include('navbar_protectora.php');

session_start();

// Establecer el id_protectora en la sesión si está disponible
if (!isset($_SESSION['id_protectora'])) {
    // Si id_protectora no está definida en la sesión, redirigir a alguna página donde se pueda establecer
    header("Location: login.php");
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
}

$id_protectora = $_SESSION['id_protectora']; // Obtener el ID de la protectora de la sesión

?>
<!-- Constructor para añadir animales -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Añade un animal</h2>
            <form action="procesar_animal.php" method="POST" enctype="multipart/form-data">
                <!-- Campo oculto para el ID de la protectora -->
                <input type="hidden" name="id_protectora" value="<?php echo $id_protectora; ?>">

                <div class="form-group row mb-4">
                    <label for="nombreAnimal" class="col-sm-4 col-form-label">Nombre del Animal</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreAnimal" name="nombreAnimal" placeholder="Introduzca el nombre del animal">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="especieAnimal" class="col-sm-4 col-form-label">Especie</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="especieAnimal" name="especieAnimal">
                            <option value="perro">Perro</option>
                            <option value="gato">Gato</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="razaAnimal" class="col-sm-4 col-form-label">Raza</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="razaAnimal" name="razaAnimal" placeholder="Introduzca la raza del animal">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="edadAnimal" class="col-sm-4 col-form-label">Edad</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edadAnimal" name="edadAnimal" placeholder="Introduzca la edad del animal">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="sexoAnimal" class="col-sm-4 col-form-label">Sexo</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="sexoAnimal" name="sexoAnimal">
                            <option value="macho">Macho</option>
                            <option value="hembra">Hembra</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="infoAnimal" class="col-sm-4 col-form-label">Información Adicional</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="infoAnimal" name="infoAnimal" rows="4" placeholder="Proporcione información adicional sobre el animal"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-4 col-form-label">¿Es un caso especial?</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="casoEspecial" id="siCasoEspecial" value="si">
                            <label class="form-check-label" for="siCasoEspecial">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="casoEspecial" id="noCasoEspecial" value="no" checked>
                            <label class="form-check-label" for="noCasoEspecial">No</label>
                        </div>
                    </div>
                </div>
                <!-- Campo de carga de archivos para la foto del animal -->
                <div class="form-group">
                    <label for="fotoAnimal">Foto del Animal</label>
                    <input type="file" class="form-control-file" id="fotoAnimal" name="fotoAnimal">
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Añadir Animal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
    include('../usuario/footer.php');
?>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>