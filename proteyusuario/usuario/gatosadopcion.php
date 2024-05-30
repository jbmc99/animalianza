
<?php
include('header.php');
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
           
            <div class="col-md-2">
                <button type="submit" class="btn btn-success" id="btn-filtrar">Filtrar</button>
            </div>
        </div>
    </form> 
</div>

<div class="d-flex flex-wrap ms-5 me-2 gatos-container">
    <?php
    require_once('../protectora/conexion.php');
    // consultamos la bbdd para obtener los gatos
    $sql = "SELECT * FROM animal WHERE especie = 'gato'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo '<div class="container mt-5">';
        echo '<div class="row justify-content-center">'; 
        
        //mostramos todas las opciones de gatos en la página
        while ($fila = $resultado->fetch_assoc()) {
            echo '<div class="col-md-3 mb-3">'; 
            echo '<div class="card bg-transparent border-0 h-100">';
            echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; 
            echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Foto del gato">';
            echo '</a>';
            echo '<div class="card-body text-center">';
            echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-link text-decoration-none">';
            echo '<h3>' . $fila['nombre'] . '</h3>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>No se encontraron gatos.</p>';
    }

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
            event.preventDefault();

            var id_protectora = $('#select-protectora').val(); //obtenemos el id de la protectora seleccionada
            $.ajax({
                url: 'filtrar_gatos.php',
                type: 'post',
                data: {id_protectora: id_protectora},
                success: function(response){
                    $('.gatos-container').html(response); //mostramos los gatos de la protectora seleccionada
                }
            });
        });
    });
</script>


</body>
</html>