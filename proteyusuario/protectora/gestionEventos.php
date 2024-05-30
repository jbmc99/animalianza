
<?php
include('..usuario/header.php');
include('navbar_protectora.php');
?>
  

<!-- Contenido principal -->
<div class="container">
    <!-- Título -->
    <h1 class="text-center mt-5 mb-5">GESTIÓN DE EVENTOS</h1>

    <!-- Contenedor de eventos actuales -->
    <h2 class="text-center mt-5 mb-3">Eventos actuales:</h2>
    <div class="row justify-content-center">
        <?php
        require_once('conexion.php');
        // Iniciar la sesión 
        session_start();
        
        // Obtener el id_protectora de la sesión 
        $id_protectora = $_SESSION['id_protectora'];
        
        // Consultar la base de datos para obtener los eventos actuales que pertenecen a la protectora que ha iniciado sesión 
        $sql = "SELECT id_evento, nombre, descripcion, fecha, estado, ruta_imagen FROM evento WHERE id_protectora = $id_protectora AND estado = 'actual'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                // Aquí se muestra cada evento actual
                echo "<div class='col-md-4 mb-5'>";
                echo "<div class='card border-1 shadow'>";
                echo "<div class='card-body text-center'>";
                echo "<h5 class='card-title'>" . $fila['nombre'] . "</h5>";
                echo "<p class='card-text'><strong>Fecha:</strong> " . $fila['fecha'] . "</p>";

                // Mostrar la foto del evento si existe
                if (!empty($fila['ruta_imagen'])) {
                    echo "<img src='" . $fila['ruta_imagen'] . "' class='img-fluid mb-3' alt='Foto del Evento'>";
                } else {
                    echo "<p class='text-muted'>No hay foto disponible para este evento.</p>";
                }

                echo "<a href='../usuario/fichaEvento.php?id_evento=" . $fila['id_evento'] . "' class='btn btn-success me-1'>Más detalles</a>";
                // Botón para editar evento
                echo "<button type='button' class='btn btn-success ms-1' data-bs-toggle='modal' data-bs-target='#editarEventoModal" . $fila['id_evento'] . "'>Editar</button>";                
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Modal para editar evento
                echo "<div class='modal fade' id='editarEventoModal" . $fila['id_evento'] . "' tabindex='-1' aria-labelledby='editarEventoModalLabel" . $fila['id_evento'] . "' aria-hidden='true'>";
                echo "<div class='modal-dialog'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='editarEventoModalLabel" . $fila['id_evento'] . "'>Editar evento: " . $fila['nombre'] . "</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                // Formulario para editar el evento
                echo "<form action='editarEvento.php' method='post' enctype='multipart/form-data'>";
                echo "<input type='hidden' name='id_evento' value='" . $fila['id_evento'] . "'>";
                echo "<div class='form-group'>";
                echo "<label for='nombreEvento'>Nombre:</label>";
                echo "<input type='text' class='form-control' id='nombreEvento' name='nombreEvento' value='" . $fila['nombre'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='descripcionEvento'>Descripción:</label>";
                echo "<textarea class='form-control' id='descripcionEvento' name='descripcionEvento'>" . $fila['descripcion'] . "</textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='fechaEvento'>Fecha:</label>";
                echo "<input type='date' class='form-control' id='fechaEvento' name='fechaEvento' value='" . $fila['fecha'] . "'>";
                echo "</div>";

                // Campo de carga de archivos para la foto del evento
                echo "<div class='form-group'>";
                echo "<label for='fotoEvento'>Foto del Evento:</label>";
                echo "<input type='file' class='form-control-file' id='fotoEvento' name='fotoEvento'>";
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
            echo "<p class='text-center'>No se encontraron eventos actuales.</p>";
        }
        ?>
    </div>

    <!-- Contenedor de eventos pasados -->
    <h2 class="text-center mt-5 mb-3">Eventos pasados:</h2>
    <div class="row justify-content-center">
        <?php

        // Consulta SQL para eventos pasados
        $sql = "SELECT * FROM evento WHERE estado = 'pasado' AND id_protectora = $id_protectora";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                // Aquí se muestra cada evento pasado
                echo "<div class='col-md-4 mb-5'>";
                echo "<div class='card border-1 shadow'>";
                echo "<div class='card-body text-center'>";
                echo "<h5 class='card-title'>" . $fila['nombre'] . "</h5>";
                echo "<p class='card-text'><strong>Fecha:</strong> " . $fila['fecha'] . "</p>";

                // Mostrar la
                // Mostrar la foto del evento si existe
                if (!empty($fila['ruta_imagen'])) {
                    echo "<img src='" . $fila['ruta_imagen'] . "' class='img-fluid mb-3' alt='Foto del Evento'>";
                } else {
                    echo "<p class='text-muted'>No hay foto disponible para este evento.</p>";
                }

                echo "<a href='../usuario/fichaEvento.php?id_evento=" . $fila['id_evento'] . "' class='btn btn-success me-1'>Más detalles</a>";

                // Botón para editar evento
                echo "<button type='button' class='btn btn-success ms-1' data-bs-toggle='modal' data-bs-target='#editarEventoModal" . $fila['id_evento'] . "'>Editar</button>";                
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Modal para editar evento
                echo "<div class='modal fade' id='editarEventoModal" . $fila['id_evento'] . "' tabindex='-1' aria-labelledby='editarEventoModalLabel" . $fila['id_evento'] . "' aria-hidden='true'>";
                echo "<div class='modal-dialog'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='editarEventoModalLabel" . $fila['id_evento'] . "'>Editar evento: " . $fila['nombre'] . "</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                // Formulario para editar el evento
                echo "<form action='editarEvento.php' method='post'>";
                echo "<input type='hidden' name='id_evento' value='" . $fila['id_evento'] . "'>";
                echo "<div class='form-group'>";
                echo "<label for='nombreEvento'>Nombre:</label>";
                echo "<input type='text' class='form-control' id='nombreEvento' name='nombreEvento' value='" . $fila['nombre'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='descripcionEvento'>Descripción:</label>";
                echo "<textarea class='form-control' id='descripcionEvento' name='descripcionEvento'>" . $fila['descripcion'] . "</textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='fechaEvento'>Fecha:</label>";
                echo "<input type='date' class='form-control' id='fechaEvento' name='fechaEvento' value='" . $fila['fecha'] . "'>";
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
            echo "<p class='text-center'>No se encontraron eventos pasados.</p>";
        }
        ?>
    </div>
</div>

<div class="text-center mt-1">
    <p>¿Qué deseas hacer?</p>
    <div class="d-flex justify-content-center mt-1">
        <a href="constructorEvento.php" class="btn btn-success me-2">Añadir evento</a>
        <!-- Botón para eliminar evento -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eliminarEventoModal">Eliminar evento</button>
    </div>
</div>


<!-- Modal para eliminar evento -->
<div class="modal fade" id="eliminarEventoModal" tabindex="-1" aria-labelledby="eliminarEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarEventoModalLabel">¿Qué evento deseas eliminar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para seleccionar el evento a eliminar -->
                <form action="eliminarEvento.php" method="post">
                    <div class="form-group">
                        <label for="eventoSelect">Selecciona el evento a eliminar:</label>
                        <select class="form-select" id="eventoSelect" name="id_evento">
                            <option selected disabled>Seleccione un evento...</option>
                            <?php
                            // Mostrar solo los eventos de la protectora actual
                            $sql = "SELECT * FROM evento WHERE id_protectora = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id_protectora);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Iterar sobre los resultados y mostrar las opciones del select
                            while ($fila = $result->fetch_assoc()) {
                                echo "<option value='" . $fila['id_evento'] . "'>" . $fila['nombre'] . "</option>";
                            }

                            // Cerrar el statement y la conexión
                            $stmt->close();
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
                </div>
        </div>
    </div>
</div>



<?php
include('../usuario/footer.php');
?>

  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
