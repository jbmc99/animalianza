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
            <a class="nav-link" href="../usuario/index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../usuario/adopciones.php">Adopciones</a>
          </li>
          <li class="nav-item dropdown" id="desplegableNavbar">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ¿Cómo ayudar?
            </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="../usuario/voluntariado.php">Voluntariado</a></li>
        <li><a class="dropdown-item" href="../usuario/donaciones.php">Donaciones</a></li>
        <li><a class="dropdown-item" href="../usuario/casaacogida.php">Casa de acogida</a></li>

    </ul>
</li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/tiendasolidaria.php">Tienda solidaria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/nuestrasprotectoras.php">Nuestras protectoras</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container mt-5">
    <h1 class="text-center mb-5">Tus productos:</h1>
    <div class="row justify-content-center">

  <!-- Aquí va el código PHP para mostrar los productos -->
  <?php
        // Incluir archivo de conexión
        require_once('conexion.php');

        // Consulta SQL para obtener todos los productos
        $sql = "SELECT * FROM producto";
        $result = $conn->query($sql);

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Mostrar los productos
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-lg-4 mb-4 me-5">';
                echo '<div class="card border-0 rounded-3 shadow-sm">';
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
                echo '<p class="card-text">' . $row['descripcion'] . '</p>';
                echo '<h6 class="card-subtitle mb-2 text-muted">$' . $row['precio'] . '</h6>';
                echo '<div class="d-flex justify-content-center">';
                echo '<a href="../usuario/infoproducto.php?id_producto=' . $row['id_producto'] . '" class="btn btn-success me-2">Más información</a>';
                // Botón para editar producto (activa el modal)
                echo '<button type="button" class="btn btn-success editarProducto" data-bs-toggle="modal" data-bs-target="#editarProductoModal" data-id="' . $row['id_producto'] . '">Editar producto</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            } else {
                // Manejar el caso de no haber productos
                echo '<p class="text-center">No hay productos disponibles</p>';
            }
        // Cerrar la conexión a la base de datos
        $conn->close();

        ?>

                <!-- Modal para editar producto -->
                <div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       <!-- Formulario para editar producto -->
                       <form action="editarProducto.php" method="post">
                            <div class="form-group">
                                <label for="nombreProducto">Nombre del Producto:</label>
                                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcionProducto">Descripción del Producto:</label>
                                <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="precioProducto">Precio del Producto:</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="precioProducto" name="precioProducto" required>
                            </div>
                            <!-- Campo oculto para almacenar el ID del producto -->
                            <input type="hidden" id="id_producto" name="id_producto">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
<div class="row justify-content-center mt-5">
    <div class="col-lg-auto text-center">
        <a href="constructorProducto.php" class="btn btn-success mx-auto">Añadir producto</a>
    </div>
    <div class="col-lg-auto text-center">
    <button type="button" class="btn btn-danger mx-auto" data-bs-toggle="modal" data-bs-target="#eliminarProductoModal">
        Eliminar producto
    </button>
</div>
</div>
</div>

<div class="modal fade" id="eliminarProductoModal" tabindex="-1" aria-labelledby="eliminarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarProductoModalLabel">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eliminarProductoForm" action="eliminarProducto.php" method="post">
                    <div class="form-group">
                        <label for="productoSelect">Selecciona el producto a eliminar:</label>
                        <select class="form-select" id="productoSelect" name="id_producto">
                            <!-- Aquí se incluirán las opciones de productos -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" form="eliminarProductoForm">Eliminar</button>
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
<!-- Footer -->
<!-- Script para pasar el ID del producto al modal -->
<script>
$(document).ready(function() {
    $('.editarProducto').on('click', function() {
        var id_producto = $(this).data('id');
        $('#id_producto').val(id_producto);
    });
});
</script>


<script>
$(document).ready(function() {
    // Cargar las opciones de productos al abrir el modal
    $('#eliminarProductoModal').on('show.bs.modal', function() {
        $.ajax({
            url: 'opciones_producto_eliminar.php', // Ruta al archivo PHP que devuelve las opciones de productos
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Limpiar el select y agregar las nuevas opciones
                $('#productoSelect').empty();
                $.each(response, function(index, producto) {
                    $('#productoSelect').append('<option value="' + producto.id + '">' + producto.nombre + '</option>');
                });
            },
            error: function() {
                alert('Error al cargar las opciones de productos');
            }
        });
    });
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>