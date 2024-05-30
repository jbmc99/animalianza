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
include('../usuario/header.php');
include('navbar_protectora.php');
?>

<div class="container mt-5 mb-5 text-center">
  <h1>GESTIÓN DE VOLUNTARIOS</h1>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 mb-4 protectora-row" data-id_protectora="<?php echo $id_protectora; ?>">
            <h2 class="text-center mb-3">¿Aceptáis voluntarios en este momento?</h2>
            <div class="d-flex justify-content-center mb-3">
                <select class="form-select me-2 acepta_voluntarios_select">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <button class="btn btn-success confirmarBtn">Confirmar</button>
            </div>
        </div>

        <div class="col-md-6">
            <h2 class="text-center mb-3">Solicitudes de voluntariado</h2>
            <ul class="list-group">
                <?php
                require_once('../protectora/conexion.php');

                $idProtectora = $_SESSION['id_protectora'];

               //preparamos la consulta sql para obtener todas las solicitudes de voluntariado
                $sql = "SELECT * FROM solicitud_voluntariado WHERE id_protectora = $idProtectora";
                //se ejecuta la consulta
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id="'.$row["id_solicitud_voluntariado"].'">';
                        echo $row["nombre_apellidos"];
                        echo '<span class="badge bg-success rounded-pill" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#solicitudModal'.$row["id_solicitud_voluntariado"].'">Más información</span>';
                        echo '</li>';

                        //hacemos un modal para cada solicitud
                        echo '<div class="modal fade" id="solicitudModal'.$row["id_solicitud_voluntariado"].'" tabindex="-1" aria-labelledby="solicitudModalLabel'.$row["id_solicitud_voluntariado"].'" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="solicitudModalLabel'.$row["id_solicitud_voluntariado"].'">Detalles de la solicitud</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<p>Nombre y apellidos: '.$row["nombre_apellidos"].'</p>';
                        echo '<p>Email: '.$row["email"].'</p>';
                        echo '<p>Número de Teléfono: '.$row["numero_telefono"].'</p>';
                        echo '<p>Vehículo Propio: '.($row["vehiculo_propio"] ? 'Sí' : 'No').'</p>';
                        echo '<p>Estado: '.$row["estado"].'</p>';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                        echo '<button type="button" class="btn btn-success acceptBtn" data-id_solicitud_voluntariado="'.$row["id_solicitud_voluntariado"].'">Aceptar</button>';
                        echo '<button type="button" class="btn btn-danger denyBtn" data-id_solicitud_voluntariado="'.$row["id_solicitud_voluntariado"].'">Denegar</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No hay solicitudes de voluntariado.";
                }

                $conn->close();
                ?>
            </ul>
        </div>
    </div>
</div>

<?php
include('../usuario/footer.php');
?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>
// primero se obtiene el valor del select y el id de la protectora
$(".confirmarBtn").on("click", function() {
    var acepta_voluntarios = $(this).siblings(".acepta_voluntarios_select").val();
    var id_protectora = $(this).closest(".protectora-row").data("id_protectora");

    console.log("Valor de acepta_voluntarios:", acepta_voluntarios);
    console.log("Valor de id_protectora:", id_protectora);

    $.ajax({
        //llamamos al archivo q va a hacer que se actualice el valor de acepta_voluntarios en la base de datos
        url: "actualizar_voluntarios.php",
       
        method: "GET",
        data: {
            acepta_voluntarios: acepta_voluntarios,
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

$(".acceptBtn").on("click", function() {
    var id_solicitud_acogida = $(this).data("id_solicitud_acogida");
    var listItem = $('li[data-id="'+id_solicitud_acogida+'"]'); //encuentra el elemento de la lista correspondiente

    $.ajax({
        url: "../protectora/actualizar_estado_solicitud_acogida.php",
        method: "GET",
        data: {
            id_solicitud_acogida: id_solicitud_acogida,
            nuevo_estado: "aceptada"
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: '¡Solicitud aceptada!',
                text: 'La solicitud ha sido aceptada.',
                confirmButtonText: 'Aceptar'
            });
            listItem.remove(); //la solicitud q aceptemos se elimina de la lista
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al aceptar la solicitud.',
                confirmButtonText: 'Aceptar'
            });
        }
    });
});

$(".denyBtn").on("click", function() {
    var id_solicitud_acogida = $(this).data("id_solicitud_acogida");
    var listItem = $('li[data-id="'+id_solicitud_acogida+'"]'); // lo mismo q el anterior

    $.ajax({
        url: "../protectora/actualizar_estado_solicitud_acogida.php",
        method: "GET",
        data: {
            id_solicitud_acogida: id_solicitud_acogida,
            nuevo_estado: "denegada"
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: '¡Solicitud denegada!',
                text: 'La solicitud ha sido denegada.',
                confirmButtonText: 'Aceptar'
            });
            listItem.remove(); 
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al denegar la solicitud.',
                confirmButtonText: 'Aceptar'
            });
        }
    });
});
</script>
</body>
</html>
