<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
include('navbar_protectora.php');
?>
  
<div class="container mt-5">
    <h1 class="mb-4 text-center">TUS ANIMALES:</h1>
    <div class="row">
        <div class="d-flex flex-wrap justify-content-center ms-5 me-2 text-center">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['id_protectora'])) {
                header("Location: login.php");
                exit();
            }
            $id_protectora = $_SESSION['id_protectora'];
            require_once('conexion.php');
            $sql = "SELECT id_animal, nombre, especie, raza, edad, sexo, info_adicional, ruta_imagen FROM animal WHERE id_protectora = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_protectora);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado === false) {
                die('Error en la consulta: ' . $conn->error);
            }
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="card ms-3 mb-3 me-5 border bg-light text-center" style="width: 18rem;" id="animal-' . $fila['id_animal'] . '">';
                    echo '<a href="../usuario/fichagato1.php?id=' . $fila['id_animal'] . '">';
                    echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid img-thumbnail border-0 bg-transparent" alt="Foto del animal">';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $fila['nombre'] . '</h5>';
                    echo '<div class="d-flex justify-content-between mt-3">';
                    echo '<a href="../usuario/fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-success me-2">Más información</a>';
                    echo '<button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#editarAnimalModal' . $fila['id_animal'] . '">Editar animal</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                
                    echo "<div class='modal fade' id='editarAnimalModal" . $fila['id_animal'] . "' tabindex='-1' aria-labelledby='editarAnimalModalLabel" . $fila['id_animal'] . "' aria-hidden='true'>";
                    echo "<div class='modal-dialog'>";
                    echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                    echo "<h5 class='modal-title' id='editarAnimalModalLabel" . $fila['id_animal'] . "'>Editar animal: " . $fila['nombre'] . "</h5>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                
                    echo "<form action='procesar_animal.php' method='post' enctype='multipart/form-data'>";
                    echo "<input type='hidden' name='id_protectora' value='" . $id_protectora . "'>";
                    echo "<input type='hidden' name='id_animal' value='" . $fila['id_animal'] . "'>";
                    echo "<div class='form-group'>";
                    echo "<label for='nombreAnimal'>Nombre:</label>";
                    echo "<input type='text' class='form-control' id='nombreAnimal' name='nombreAnimal' value='" . $fila['nombre'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='especieAnimal'>Especie:</label>";
                    echo "<input type='text' class='form-control' id='especieAnimal' name='especieAnimal' value='" . $fila['especie'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='razaAnimal'>Raza:</label>";
                    echo "<input type='text' class='form-control' id='razaAnimal' name='razaAnimal' value='" . $fila['raza'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='edadAnimal'>Edad:</label>";
                    echo "<input type='number' class='form-control' id='edadAnimal' name='edadAnimal' value='" . $fila['edad'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='sexoAnimal'>Sexo:</label>";
                    echo "<select class='form-control' id='sexoAnimal' name='sexoAnimal'>";
                    echo "<option value='Macho' " . ($fila['sexo'] == 'Macho' ? 'selected' : '') . ">Macho</option>";
                    echo "<option value='Hembra' " . ($fila['sexo'] == 'Hembra' ? 'selected' : '') . ">Hembra</option>";
                    echo "</select>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='info_adicional'>Información Adicional:</label>";
                    echo "<textarea class='form-control' id='info_adicional' name='infoAnimal'>" . $fila['info_adicional'] . "</textarea>";
                    echo "</div>";
                    echo "<div class='form-group mt-3'>";
                    echo "<label for='fotoAnimal'>Foto del Animal:</label>";
                    echo "<input type='file' class='form-control-file' id='fotoAnimal' name='fotoAnimal'>";
                    echo "</div>";
                
                    echo "<input type='hidden' name='sexoAnimal' value='" . $fila['sexo'] . "'>";
                
                    echo "<button type='submit' class='btn mt-3'>Guardar cambios</button>";
                    echo "<button type='button' class='btn mt-3' data-bs-dismiss='modal'>Cancelar</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                
            } else {
                echo "<div class= 'text-center'> No se encontraron animales. </div>";
            }

            ?>
        </div>
    </div>
</div>

    <div class="text-center mt-1">
      <p>¿Qué deseas hacer?</p>
      <a href="constructorAnimal.php" class="btn btn-success">Añadir animal</a>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eliminarAnimalModal">
        Eliminar Animal
    </button>
    </div>
  </div>

  <div class="modal fade" id="eliminarAnimalModal" tabindex="-1" aria-labelledby="eliminarAnimalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarAnimalModalLabel">¿A qué animal deseas eliminar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="animalSelect">Selecciona el animal a eliminar:</label>
                    <select class="form-select" id="animalSelect">
                    <?php include 'opciones_animal_eliminar.php'; ?>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="eliminarBtn" >Eliminar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<?php
    include('../usuario/footer.php');
    ?>

<script>
    $(document).ready(function(){
        function cargarAnimales() {
            $.ajax({
                url: 'opciones_animal_eliminar.php',
                type: 'GET',
                success: function(response) {
                    var animales = JSON.parse(response);
                    $('#animalSelect').empty();
                    if (animales.length > 0) {
                        for (var i = 0; i < animales.length; i++) {
                            $('#animalSelect').append('<option value="' + animales[i].id + '">' + animales[i].nombre + '</option>');
                        }
                    } else {
                        $('#animalSelect').append('<option value="" disabled>No hay animales disponibles</option>');
                    }
                },
                error: function() {
                    alert('Hubo un error al obtener los animales');
                }
            });
        }

        cargarAnimales();
        $('#eliminarBtn').click(function() {
            var idAnimal = $('#animalSelect').val();
            $.ajax({
                url: 'eliminarAnimal.php',
                type: 'POST',
                data: { id_animal: idAnimal },
                success: function(response) {
                    var resultado = JSON.parse(response);
                    if (resultado.success) {
                        $('#animal-' + idAnimal).remove();
                        cargarAnimales();
                        $('#eliminarAnimalModal').modal('hide');
                        
                    } else {
                        alert('Hubo un error al eliminar el animal');
                    }
                },
                error: function() {
                    alert('Hubo un error al eliminar el animal');
                }
            });
        });
    });
</script>




  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>