
<?php
include('header.php');
include('navbar_usuario.php');
?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-5">FORMULARIO DE ADOPCIÓN</h2>
            <form id="formulario-adopcion" action="procesar_solicitud_adopcion.php" method="POST">
                <div class="form-group row mb-4">
                    <label for="nombreApellidos" class="col-sm-4 col-form-label">Nombre y apellidos</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreApellidos" name="nombreApellidos" placeholder="Introduce tu nombre completo">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Introduzca su correo electrónico">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="select-protectora" class="col-sm-4 col-form-label">Seleccione la protectora</label>
                    <div class="col-sm-8">
                        <select class="form-select mt-2 mb-2" aria-label="Seleccione la protectora" id="select-protectora" name="select-protectora">
                            <option selected disabled>Seleccione la protectora a la que pertenece</option>
                            <?php
                            require_once('../protectora/conexion.php');
                            //consultamos la bbdd para obtener las protectoras
                            $sql = "SELECT * FROM protectora";
                            $resultado = $conn->query($sql);
                            if ($resultado->num_rows > 0) {
                                //mostramos todas las opciones de protectoras en el select
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
                <div class="form-group row mb-4">
                    <label for="select-nombre-animal" class="col-sm-4 col-form-label">Seleccione el nombre del animal</label>
                    <div class="col-sm-8">
                        <select class="form-select mt-2" aria-label="Seleccione el nombre del animal" id="select-nombre-animal" name="select-nombre-animal">
                            <option selected disabled>Primero seleccione una protectora</option>
                        </select>
                    </div>
                </div>

                <!-- Campo oculto para almacenar la ID de la protectora -->
                <input type="hidden" id="id-protectora" name="id-protectora">
              
                <div class="form-group row mb-4">
                    <label for="numeroTelefono" class="col-sm-4 col-form-label">Número de teléfono</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="numeroTelefono" name="numeroTelefono" placeholder="Introduzca su número de teléfono">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="direccion" class="col-sm-4 col-form-label">Dirección Completa</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca su dirección">
                    </div>
                </div>
             
                <fieldset class="form-group">
                    <div class="row mb-5">
                        <legend class="col-form-label col-sm-4 pt-0">¿Es propietario o inquilino?</legend>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="propietarioInquilino" id="propietario" value="propietario" checked>
                                <label class="form-check-label" for="propietario">
                                    Propietario
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="propietarioInquilino" id="inquilino" value="inquilino">
                                <label class="form-check-label" for="inquilino">
                                    Inquilino
                                </label>
                            </div>
                        </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row mb-5">
                        <legend class="col-form-label col-sm-4 pt-0">En caso de ser inquilino, ¿se le permite tener mascotas?</legend>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="permisoMascotas" id="permisoMascotasSi" value="si" checked>
                                <label class="form-check-label" for="permisoMascotasSi">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="permisoMascotas" id="permisoMascotasNo" value="no">
                                <label class="form-check-label" for="permisoMascotasNo">
                                    No
                                </label>
                            </div>
                        </div>
                </fieldset>
                </div>
                <div class="form-group row mb-4">
                    <label for="infoFamilia" class="col-sm-4 col-form-label">Proporcione información sobre familia y estilo de vida</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="infoFamilia" name="infoFamilia" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Solicitar adopción</button>
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
    <script>
    //obtenemos el select de protectora y el de nombre de animal
    var selectProtectora = document.getElementById("select-protectora");
    var selectNombreAnimal = document.getElementById("select-nombre-animal");

    //agregamos un evento de cambio al select de protectora
    selectProtectora.addEventListener("change", function() {
        //obtenemos el id de la protectora seleccionada
        let idProtectora = this.value;

        //asignamos el id de la protectora al input oculto
        document.getElementById("id-protectora").value = idProtectora;

        //creamos una nueva solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "obtener_animales.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        //y enviamos la solicitud con el id de la protectora
        xhr.send("id_protectora=" + idProtectora);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);

                //limpiamos el select de nombre de animal
                selectNombreAnimal.innerHTML = '<option selected disabled>Seleccione el nombre del animal</option>';

                //convertimos la respuesta en un array de objetos
                var animales = JSON.parse(xhr.responseText);
                //y añadimos cada animal al select
                for (var i = 0; i < animales.length; i++) {
                    var option = document.createElement("option");
                    option.value = animales[i].id_animal;
                    option.text = animales[i].nombre;
                    selectNombreAnimal.appendChild(option);
                }
            }
        };
    });
</script>
<script>
    function mostrarAlerta() {
        alert("¡Solicitud enviada con éxito!");
    }
    var formulario = document.getElementById("formulario-adopcion");
    formulario.addEventListener("submit", function(event) {
        setTimeout(mostrarAlerta, 500);
    });
</script>

</body>
</html>