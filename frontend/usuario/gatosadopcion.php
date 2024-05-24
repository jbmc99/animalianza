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
  
<div class="container text-center mb-3">
    <div class="col align-self-center mt-4 mb-3">
        <h1><b>GATOS</b></h1>
    </div>

    <form id="form-filtrar"> 
        <div class="row justify-content-center mb-4">
            <div class="col-md-4 mb-5">
                <select class="form-select" aria-label="Seleccione la protectora" id="select-protectora">
                    <option selected>Seleccione una protectora</option>
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
           
            <div class="col-md-2">
                <button type="submit" class="btn btn-success" id="btn-filtrar">Filtrar</button>
            </div>
        </div>
    </form> 
</div>
<!--CARDS-->
<div class="d-flex flex-wrap ms-5 me-2 gatos-container">
    <?php
    // Incluir archivo de conexión
    require_once('../protectora/conexion.php');

    // Consultar la base de datos para obtener todos los gatos
    $sql = "SELECT * FROM animal WHERE especie = 'gato'";
    $resultado = $conn->query($sql);

    // Verificar si se encontraron gatos
    if ($resultado->num_rows > 0) {
        // Contenedor y fila fuera del bucle
        echo '<div class="container mt-5">';
        echo '<div class="row justify-content-center">'; // Mover la clase aquí
        
        // Mostrar todas las tarjetas de gatos
        while ($fila = $resultado->fetch_assoc()) {
            echo '<div class="col-md-3 mb-3">'; // Asignamos una columna con el mismo ancho para cada card
            echo '<div class="card bg-transparent border-0 h-100">';
            echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; // Enlace a la página de detalles del gato
            echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Foto del gato">';
            echo '</a>';
            echo '<div class="card-body text-center">';
            echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-link text-dark text-decoration-none">';
            echo '<h3>' . $fila['nombre'] . '</h3>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        // Cerrar contenedor y fila
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>No se encontraron gatos.</p>';
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
</div>

 
<?php
    include('footer.php');
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#form-filtrar').submit(function(event){ 
            event.preventDefault(); // Prevenir el envío del formulario por defecto

            var id_protectora = $('#select-protectora').val(); // Obtener el valor seleccionado del select
            $.ajax({
                url: 'filtrar_gatos.php',
                type: 'post',
                data: {id_protectora: id_protectora},
                success: function(response){
                    $('.gatos-container').html(response); // Actualizar el contenido con los gatos filtrados
                }
            });
        });
    });
</script>


</body>
</html>