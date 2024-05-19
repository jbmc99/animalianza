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
<!-- Formulario de solicitud de casa de acogida -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-5">FORMULARIO DE CASA DE ACOGIDA</h2>
            <form id="formulario-acogida" action="procesar_solicitud_acogida.php" method="POST">
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
                        <input type="text" class="form-control" id="numeroTelefono" name="telefono" placeholder="Introduzca su número de teléfono" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="direccion" class="col-sm-4 col-form-label">Dirección Completa</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca su dirección" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="select-protectora" class="col-sm-4 col-form-label">Seleccione la protectora</label>
                    <div class="col-sm-8">
                        <select class="form-select mt-2 mb-2" aria-label="Seleccione la protectora" id="select-protectora" name="id_protectora" required>
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
                <div class="form-group row mb-4">
                    <label for="select-nombre-animal" class="col-sm-4 col-form-label">Seleccione el nombre del animal</label>
                    <div class="col-sm-8">
                        <select class="form-select mt-2" aria-label="Seleccione el nombre del animal" id="select-nombre-animal" name="id_animal" required>
                            <option selected disabled>Primero seleccione una protectora</option>
                        </select>
                    </div>
                </div>

                <!-- Campo oculto para almacenar la ID de la protectora -->
                <input type="hidden" id="id-protectora" name="id-protectora">

                <div class="form-group row mb-4">
                    <label for="motivacionesAcogida" class="col-sm-4 col-form-label">¿Cuáles son sus motivaciones para ofrecerse como casa de acogida?</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="motivacionesAcogida" name="motivaciones" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="infoHogar" class="col-sm-4 col-form-label">Proporcione información sobre su hogar y estilo de vida</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="infoHogar" name="estilo_vida" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Enviar solicitud</button>
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
    // Obtener el select de protectora y nombre de animal
    var selectProtectora = document.getElementById("select-protectora");
    var selectNombreAnimal = document.getElementById("select-nombre-animal");

    // Evento cuando se cambia la protectora seleccionada
    selectProtectora.addEventListener("change", function() {
        // Obtener la id de la protectora seleccionada
        let idProtectora = this.value;

        // Actualizar el valor del campo oculto con la ID de la protectora seleccionada
        document.getElementById("id-protectora").value = idProtectora;

        // Hacer la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "obtener_animales.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Enviar el id_protectora
        xhr.send("id_protectora=" + idProtectora);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Imprimir la respuesta en la consola
                console.log(xhr.responseText);

                // Limpiar el select de nombre de animal
                selectNombreAnimal.innerHTML = '<option selected disabled>Seleccione el nombre del animal</option>';

                // Convertir la respuesta en un objeto JavaScript
                var animales = JSON.parse(xhr.responseText);

                // Crear las opciones del select de nombre de animal
                for (var i = 0; i < animales.length; i++) {
                    var option = document.createElement("option");
                    option.value = animales[i].id_animal;
                    option.text = animales[i].nombre;
                    selectNombreAnimal.appendChild(option);
                }
            }
        };
    });

    // Función para mostrar el alert cuando la solicitud se envíe con éxito
    function mostrarAlerta() {
        alert("¡Solicitud enviada con éxito!");
    }
    
    // Obtener el formulario
    var formulario = document.getElementById("formulario-acogida");
    
    // Agregar un evento de submit al formulario
    formulario.addEventListener("submit", function(event) {
        // Mostrar el alert después de un breve retraso para asegurarse de que se haya procesado la solicitud
        setTimeout(mostrarAlerta, 500);
    });
</script>
</body>
</html>
