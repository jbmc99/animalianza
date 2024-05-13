<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <!--NAVBAR-->
  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../images/logueto.png" alt="Logo" height="40" class="d-inline-block align-text-center">
        ANIMALIANZA
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Adopciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Voluntariado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Donaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Nuestras protectoras</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  
<!-- Contenido principal -->
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tus productos:</h2>
    <div class="row">
        <div class="d-flex flex-wrap justify-content-center ms-5 me-2 text-center">
            <?php
            // Incluir archivo de conexión
            require_once('conexion.php');
            // Iniciar la sesión
            session_start();

            // Verificar si se ha iniciado sesión y si se ha establecido 'id_protectora' en la sesión
            if (isset($_SESSION['id_protectora'])) {
                // Obtener 'id_protectora' de la sesión
                $id_protectora = $_SESSION['id_protectora'];

                // Consulta SQL para obtener todos los productos asociados a la protectora
                $sql = "SELECT * FROM producto WHERE id_protectora = $id_protectora";
                $result = $conn->query($sql);

                // Verificar si la consulta se ejecutó correctamente
                if ($result === false) {
                    die('Error en la consulta: ' . $conn->error);
                }

                // Verificar si se encontraron productos
                if ($result->num_rows > 0) {
                    // Mostrar cada producto en una tarjeta
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card ms-3 mb-3 me-5 border bg-light text-center" style="width: 18rem;">';
                        echo '<img src="' . $row['ruta_imagen'] . '" class="card-img-top img-fluid img-thumbnail border-0 bg-transparent" alt="Foto del Producto">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
                        echo '<p class="card-text">' . $row['descripcion'] . '</p>';
                        echo '<p class="card-text">$' . $row['precio'] . '</p>';
                        echo '<div class="d-flex justify-content-between mt-3">';
                        // Botón de "Más información" verde
                        echo '<a href="../usuario/infoproducto.php?id_producto=' . $row['id_producto'] . '" class="btn btn-success me-2">Más información</a>';
                        // Botón de "Editar producto" verde
                        echo '<button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#editarProductoModal' . $row['id_producto'] . '">Editar producto</button>';
                        echo '</div>'; // Cierre de d-flex justify-content-between
                        echo '</div>'; // Cierre de card-body
                        echo '</div>'; // Cierre de card

                        // Modal para editar producto
                        echo "<div class='modal fade' id='editarProductoModal" . $row['id_producto'] . "' tabindex='-1' aria-labelledby='editarProductoModalLabel" . $row['id_producto'] . "' aria-hidden='true'>";
                        echo "<div class='modal-dialog'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header'>";
                        echo "<h5 class='modal-title' id='editarProductoModalLabel" . $row['id_producto'] . "'>Editar producto: " . $row['nombre'] . "</h5>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        // Formulario para editar el producto
                        echo "<form action='procesar_producto.php' method='post' enctype='multipart/form-data'>";
                        echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
                        echo "<div class='form-group'>";
                        echo "<label for='nombreProducto'>Nombre:</label>";
                        echo "<input type='text' class='form-control' id='nombreProducto' name='nombreProducto' value='" . $row['nombre'] . "'>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='descripcionProducto'>Descripción:</label>";
                        echo "<textarea class='form-control' id='descripcionProducto' name='descripcionProducto'>" . $row['descripcion'] . "</textarea>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='precioProducto'>Precio:</label>";
                        echo "<input type='number' class='form-control' id='precioProducto' name='precioProducto' value='" . $row['precio'] . "'>";
                        echo "</div>";
                        // Campo de carga de archivos para la foto del producto
                        echo "<div class='form-group'>";
                        echo "<label for='fotoProducto'>Foto del Producto:</label>";
                        echo "<input type='file' class='form-control-file' id='fotoProducto' name='fotoProducto'>";
                        echo "</div>";
                        echo "<button type='submit' class='btn btn-primary'>Guardar cambios</button>";
                        echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    // Si no se encontraron productos
                    echo '<p class="text-center">No hay productos disponibles</p>';
                }
            } else {
                // Si no se ha iniciado sesión o 'id_protectora' no está establecida en la sesión
                // Redirigir al usuario a una página de inicio de sesión u otra página apropiada
                header("Location: iniciar_sesion.php");
                exit; // Asegurar que se detenga la ejecución después de la redirección
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
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


 <!--FOOTER-->
 <footer class="text-center text-lg-start bg-body-tertiary text-muted mt-5" id="footer">
    <!-- Redes sociales-->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
    </section>
  
    <!-- Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Company name
            </h6>
            <p>
              Here you can use rows and columns to organize your footer content. Lorem ipsum
              dolor sit amet, consectetur adipisicing elit.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
              <a href="#!" class="text-reset">React</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p>
          </div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
            <p>
              <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Orders</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Help</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              info@example.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
          </div>
        </div>
      </div>
    </section>
  
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
  </footer>
  <script>
        $(document).ready(function(){
            $('#eliminarBtn').click(function() {
                var idAnimal = $('#animalSelect').val();
        
                $.ajax({
                    url: 'eliminarAnimal.php',
                    type: 'POST',
                    data: {
                        id_animal: idAnimal
                    },
                    success: function(response) {
                        // Parsear la respuesta JSON
                        var animales = JSON.parse(response);
                        
                        // Limpiar el select y agregar las nuevas opciones
                        $('#animalSelect').empty();
                        for (var i = 0; i < animales.length; i++) {
                            $('#animalSelect').append('<option value="' + animales[i].id_animal + '">' + animales[i].nombre + '</option>');
                        }
        
                        // Cierra el modal
                        $('#eliminarAnimalModal').modal('hide');
                        // Mostrar el mensaje de éxito
                        alert('Animal eliminado con éxito');
                    },
                    error: function() {
                        // Mostrar el mensaje de error
                        alert('Hubo un error al eliminar el animal');
                    }
                });
            });
        });
    </script>


  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>