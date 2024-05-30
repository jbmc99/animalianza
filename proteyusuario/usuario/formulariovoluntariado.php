
<?php
include('header.php');
include('navbar_usuario.php');
?>
    <!--formulario de solicitud de voluntariado-->
    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-5">FORMULARIO DE SOLICITUD DE VOLUNTARIADO</h2>
            <form action="procesar_solicitud_voluntariado.php" method="post">
                <div class="form-group row mb-4">
                    <label for="nombreApellidos" class="col-sm-4 col-form-label">Nombre y apellidos</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreApellidos" name="nombreApellidos" placeholder="Introduce tu nombre completo" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Introduzca su correo electrónico" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="numeroTelefono" class="col-sm-4 col-form-label">Número de teléfono</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="numeroTelefono" name="numeroTelefono" placeholder="Introduzca su número de teléfono" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-4 col-form-label">Dispone de vehículo propio que pueda utilizar para transportar animales?</label>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vehiculoPropio" id="vehiculoSi" value="si" required>
                            <label class="form-check-label" for="vehiculoSi">Sí</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vehiculoPropio" id="vehiculoNo" value="no" required>
                            <label class="form-check-label" for="vehiculoNo">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="protectora" class="col-sm-4 col-form-label">Selecciona la protectora</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="protectora" name="id_protectora" required>
                            <option selected disabled>Seleccione la protectora a la que pertenece</option>
                            <?php
                            // Incluir archivo de conexión
                            require_once('../protectora/conexion.php');

                            // Consultar la base de datos para obtener todas las protectoras
                            $sql = "SELECT * FROM protectora";
                            $resultado = $conn->query($sql);

                            // Verificar si se encontraron protectoras
                            if ($resultado->num_rows > 0) {
                                // Mostrar todas las opciones de protectoras en el select
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo '<option value="' . $fila['id_protectora'] . '">' . $fila['nombre'] . '</option>';
                                }
                            } else {
                                echo "<option disabled>No se encontraron protectoras</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Enviar solicitud de voluntariado</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


 
<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
