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
    <h1 class="text-center mb-5">TUS PRODUCTOS</h1>
    <div class="row justify-content-center">

<?php

session_start();
    require_once('conexion.php');

    $id_protectora = $_SESSION['id_protectora'];
    $sql = "SELECT * FROM producto WHERE id_protectora = '$id_protectora'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-4 mb-4 ">';
            echo '<div class="card border-0 rounded-3 shadow-sm">';
            echo '<img src="' . $row['ruta_imagen'] . '" class="card-img-top" alt="Imagen del Producto">';
            echo '<div class="card-body text-center">';
            echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
            echo '<h6 class="card-subtitle mb-2 text-muted">$' . $row['precio'] . '</h6>';
            echo '<div class="d-flex justify-content-center">';
            echo '<a href="../usuario/infoproducto.php?id_producto=' . $row['id_producto'] . '" class="btn btn-success me-2">Más información</a>';
            echo '<button type="button" class="btn btn-success editarProducto" data-bs-toggle="modal" data-bs-target="#editarProductoModal" data-id="' . $row['id_producto'] . '">Editar producto</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center">No hay productos disponibles</p>';
    }

    $conn->close();
?>

<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="editarProducto.php" method="post" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="fotoProducto">Foto del Producto:</label>
                        <input type="file" class="form-control-file" id="fotoProducto" name="fotoProducto">
                    </div>
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

  
<?php
    include('../usuario/footer.php');
    ?>

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
    $('#eliminarProductoModal').on('show.bs.modal', function() {
        $.ajax({
            url: 'opciones_producto_eliminar.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
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