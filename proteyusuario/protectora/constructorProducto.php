
<?php
include('../usuario/header.php');
include('navbar_protectora.php');
?>
  

  <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Añade un Producto</h2>
            <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-4">
                    <label for="nombreProducto" class="col-sm-4 col-form-label">Nombre del Producto</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Introduzca el nombre del producto" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="descripcionProducto" class="col-sm-4 col-form-label">Descripción del Producto</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="4" placeholder="Introduzca una descripción del producto" required></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="precioProducto" class="col-sm-4 col-form-label">Precio del Producto</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" min="0" class="form-control" id="precioProducto" name="precioProducto" placeholder="Introduzca el precio del producto" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="fotoProducto" class="col-sm-4 col-form-label">Foto del Producto</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="fotoProducto" name="fotoProducto" required>
                    </div>
                </div>
                <div class="form-group row text-center mt-5">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success" name="submit">Añadir Producto</button>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>

  
<?php include('../usuario/footer.php'); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>