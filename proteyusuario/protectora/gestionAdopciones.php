
<!--accedemos a las variables de sesión y comprobamos q id_protectora está en la sesión 
si no está redirigimos a login.php-->
<?php
session_start();
if (!isset($_SESSION['id_protectora'])) {
    header("Location: login.php");
    exit();
}

$id_protectora = $_SESSION['id_protectora'];
?>

<?php
include('..usuario/header.php');
include('navbar_protectora.php');
?>

<div class="container mt-5 mb-5 text-center">
  <h1>GESTIÓN DE ADOPCIONES</h1>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 mb-4 protectora-row" data-id_protectora="<?php echo $id_protectora; ?>">
            <h2 class="text-center mb-3">¿Aceptáis adopciones en este momento?</h2>
            <div class="d-flex justify-content-center mb-3">
                <select class="form-select me-2 acepta_adopciones_select">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <button class="btn btn-success confirmarBtn">Confirmar</button>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <?php
            require_once('../protectora/conexion.php');
            $idProtectora = $_SESSION['id_protectora'];

            //preparamos la consulta sql para obtener todas las solicitudes de adopción q esten pendientes
            $sql = "SELECT solicitud_adopcion.*, animal.nombre AS nombre_animal 
                    FROM solicitud_adopcion 
                    JOIN animal ON solicitud_adopcion.id_animal = animal.id_animal 
                    WHERE solicitud_adopcion.id_protectora = ? AND solicitud_adopcion.estado = 'pendiente'";

            //preparar y ejecutar la consulta
            //utilizo stmt para evitar inyecciones sql, en este caso no es necesario pero es una buena práctica
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idProtectora);
            $stmt->execute();
            $result = $stmt->get_result();

            echo '<div class="container my-3">';

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                  echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id_solicitud_adopcion="'.$row["id_solicitud_adopcion"].'" data-bs-toggle="modal" data-bs-target="#solicitudModal'.$row["id_solicitud_adopcion"].'">';

                    echo $row["nombre_animal"];
                    echo '<span class="badge bg-success rounded-pill" style="cursor:pointer;">Más información</span>';
                    echo '</li>';

                    echo '<div class="modal fade" id="solicitudModal'.$row["id_solicitud_adopcion"].'" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="solicitudModalLabel">Detalles de la solicitud</h5>';
                    echo '<button
                    type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<p>Nombre: '.$row["nombre_apellidos"].'</p>';
                    echo '<p>Email: '.$row["email"].'</p>';
                    echo '<p>ID Protectora: '.$row["id_protectora"].'</p>';
                    echo '<p>ID Animal: '.$row["id_animal"].'</p>'; 
                    echo '<p>Número de Teléfono: '.$row["numero_telefono"].'</p>';
                    echo '<p>Dirección: '.$row["direccion"].'</p>';
                    echo '<p>Propietario/Inquilino: '.$row["propietario_inquilino"].'</p>';
                    echo '<p>Permiso Mascotas: '.$row["permiso_mascotas"].'</p>';
                    echo '<p>Info Familia: '.$row["info_familia"].'</p>';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                    echo '<button type="button" class="btn btn-success acceptBtn" data-id_solicitud_adopcion="'.$row["id_solicitud_adopcion"].'" data-acepta="aceptada">Aceptar</button>';
                    echo '<button type="button" class="btn btn-danger denyBtn" data-id_solicitud_adopcion="'.$row["id_solicitud_adopcion"].'" data-acepta="denegada">Denegar</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No hay solicitudes de adopción.";
            }

            echo '</div>'; 

            //cerramos primero la consulta y luego la conexión
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</div>



<?php include('../usuario/footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>


//obtenemos el valor seleccionado del select
$(".confirmarBtn").on("click", function() {
    var acepta_adopciones = $(this).siblings(".acepta_adopciones_select").val();
    var id_protectora = $(this).closest(".protectora-row").data("id_protectora");

    //no es necesario pero es una buena práctica el console.log para comprobar q se obtienen los valores correctos
    console.log("Valor de acepta_adopciones:", acepta_adopciones);
    console.log("Valor de id_protectora:", id_protectora);

    //envio los datos al archivo q va a actualizar la bd
    $.ajax({
        url: "actualizar_adopcion.php",
        method: "GET",
        data: {
            acepta_adopciones: acepta_adopciones,
            id_protectora: id_protectora
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: 'El estado se ha actualizado correctamente.',
                confirmButtonText: 'Aceptar'
            });

            console.log(response); 
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
        }
    });
});

//para aceptar o denegar la solicitud de adopción
$(".acceptBtn, .denyBtn").on("click", function() {
    var id_solicitud_adopcion = $(this).data("id_solicitud_adopcion");
    var acepta_adopciones = $(this).data("acepta"); 

    var listItem = $('li[data-id_solicitud_adopcion="'+id_solicitud_adopcion+'"]');

    $.ajax({
        url: "actualizar_estado_solicitud_adopcion.php",
        method: "GET",
        data: {
            id_solicitud_adopcion: id_solicitud_adopcion,
            nuevo_estado: acepta_adopciones 
        },
        success: function(response) {
            if (acepta_adopciones === "aceptada") {
                Swal.fire({
                    icon: 'success',
                    title: '¡Solicitud aceptada!',
                    text: 'La solicitud de adopción ha sido aceptada.',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: '¡Solicitud denegada!',
                    text: 'La solicitud de adopción ha sido denegada.',
                    confirmButtonText: 'Aceptar'
                });
            }
            listItem.remove(); //se elimina la solicitud de la lista
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al actualizar la solicitud. Por favor, inténtalo de nuevo.',
                confirmButtonText: 'Aceptar'
                    });
                    }
                    });
                    });
                    </script>

                    </body>
                    </html>