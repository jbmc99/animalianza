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
  
<div class="container text-center mb-5">
    <div class="col align-self-center mt-4 mb-5">
        <h1><b>PERROS Y GATOS</b></h1>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-4 mb-5">
            <select class="form-select" aria-label="Seleccione la protectora">
                <option selected>Seleccione la protectora</option>
                <!-- Aquí puedes agregar opciones de protectoras si es necesario -->
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label="Seleccione el color">
                <option selected>Seleccione el color</option>
                <!-- Aquí puedes agregar opciones de colores si es necesario -->
            </select>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-success">Filtrar</button>
        </div>
    </div>
    <!--CARDS-->
    <div class="d-flex flex-wrap justify-content-center ms-5 me-2">
        <?php
        // Iniciar la sesión
        session_start();

        // Verificar si se ha iniciado sesión y se ha almacenado el ID de la protectora
        if (isset($_SESSION['id_protectora'])) {
            // Obtener el ID de la protectora de la sesión
            $id_protectora = $_SESSION['id_protectora'];

            // Incluir archivo de conexión
            require_once('../protectora/conexion.php');

            // Consultar la base de datos para obtener todas las tarjetas de perros y gatos de la protectora actual
            $sql = "SELECT * FROM animal WHERE (especie = 'Perro' OR especie = 'Gato') AND id_protectora = $id_protectora";
            $resultado = $conn->query($sql);

            // Verificar si se encontraron perros y/o gatos
            if ($resultado->num_rows > 0) {
                // Mostrar todas las tarjetas de perros y gatos de la protectora actual
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="card ms-3 mb-3 me-5 bg-transparent border-0" id="card' . $fila['id_animal'] . '">';
                    echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '">'; // Enlace a la página de detalles del animal
                    echo '<img src="' . $fila['ruta_imagen'] . '" class="card-img-top img-fluid" alt="Foto del animal">';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<a href="fichagato1.php?id=' . $fila['id_animal'] . '" class="btn btn-link text-dark text-decoration-none">';
                    echo '<h3>' . $fila['nombre'] . '</h3>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron perros ni gatos para adopción.";
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
        } else {
            echo "No se ha iniciado sesión.";
        }
        ?>
    </div>
</div>

<?php
    include('footer.php');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>