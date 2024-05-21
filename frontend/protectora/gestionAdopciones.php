<?php
// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el id_protectora está almacenado en la sesión
if (!isset($_SESSION['id_protectora'])) {
    // Si no está almacenado, redirigir a la página de inicio de sesión
    header("Location: login.php"); // Cambiar 'login.php' por la página de inicio de sesión
    exit();
}

// Obtener el id_protectora de la sesión
$id_protectora = $_SESSION['id_protectora'];
?>

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
include('navbar_protectora.php');
?>

<!-- Title -->
<div class="container mt-5 mb-5 text-center">
  <h1>Gestión de adopciones</h1>
</div>

<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <!-- Sección para aceptar adopciones -->
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
            // Incluir archivo de conexión a la base de datos
            require_once('../protectora/conexion.php');

            // Obtener el id_protectora de la sesión
            $idProtectora = $_SESSION['id_protectora'];

            // Preparar la consulta SQL para obtener todas las solicitudes de adopción que no estén aceptadas o denegadas
            $sql = "SELECT solicitud_adopcion.*, animal.nombre AS nombre_animal 
                    FROM solicitud_adopcion 
                    JOIN animal ON solicitud_adopcion.id_animal = animal.id_animal 
                    WHERE solicitud_adopcion.id_protectora = ? AND solicitud_adopcion.estado = 'pendiente'";

            // Preparar y ejecutar la consulta
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idProtectora);
            $stmt->execute();
            $result = $stmt->get_result();

            echo '<div class="container my-3">'; // Contenedor con margen vertical

            if ($result->num_rows > 0) {
                // Recorrer cada fila de resultados
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
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<p>Nombre: '.$row["nombre_apellidos"].'</p>';
                    echo '<p>Email: '.$row["email"].'</p>';
                    echo '<p>ID Protectora: '.$row["id_protectora"].'</p>'; // Añadir el ID de la protectora
                    echo '<p>ID Animal: '.$row["id_animal"].'</p>'; // Añadir el ID del animal
                    echo '<p>Número de Teléfono: '.$row["numero_telefono"].'</p>';
                    echo '<p>Dirección: '.$row["direccion"].'</p>';
                    echo '<p>Propietario/Inquilino: '.$row["propietario_inquilino"].'</p>';
                    echo '<p>Permiso Mascotas: '.$row["permiso_mascotas"].'</p>';
                    echo '<p>Motivaciones Adoptar: '.$row["motivaciones_adoptar"].'</p>';
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

            echo '</div>'; // Cierre del contenedor

            // Cerrar la conexión a la base de datos
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer-custom-bg text-center mt-5">
  <div class="container p-4 pb-0">
    <h4>¡Contacta con nosotros!</h4>
  </div>

  <div class="container p-4 pb-0">
    <section class="mb-4">
      <a class="btn text-white btn-floating m-1" style="background-color: #3b5998;" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
      <a class="btn text-white btn-floating m-1" style="background-color: #55acee;" href="#!" role="button"><i class="fab fa-twitter"></i></a>
      <a class="btn text-white btn-floating m-1" style="background-color: #dd4b39;" href="#!" role="button"><i class="fab fa-google"></i></a>
      <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i class="fab fa-instagram"></i></a>
    </section>
  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright: Animalianza
    <a class="text-body" href="https://animalianza.com/">Animalianza.com</a>
  </div>
</footer>
<!-- Footer -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Obtener el valor del select y el ID de la protectora
$(".confirmarBtn").on("click", function() {
    // Obtener el valor seleccionado del select
    var acepta_adopciones = $(this).siblings(".acepta_adopciones_select").val();
    var id_protectora = $(this).closest(".protectora-row").data("id_protectora");

    // Imprimir los valores antes de enviar la solicitud AJAX
    console.log("Valor de acepta_adopciones:", acepta_adopciones);
    console.log("Valor de id_protectora:", id_protectora);

    // Enviar los datos al script PHP mediante Ajax
    $.ajax({
        url: "actualizar_adopcion.php",
        method: "GET",
        data: {
            acepta_adopciones: acepta_adopciones,
            id_protectora: id_protectora
        },
        success: function(response) {
            // Mostrar un alert para notificar al usuario
            alert("El estado se ha actualizado correctamente.");

            console.log(response); // Maneja la respuesta del servidor según sea necesario
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Maneja los errores de Ajax
        }
    });
});
// Para aceptar solicitudes de adopción
$(".acceptBtn, .denyBtn").on("click", function() {
    var id_solicitud_adopcion = $(this).data("id_solicitud_adopcion");
    var acepta_adopciones = $(this).data("acepta"); // Lee el estado desde el botón

    var listItem = $('li[data-id_solicitud_adopcion="'+id_solicitud_adopcion+'"]');

    $.ajax({
        url: "actualizar_estado_solicitud_adopcion.php",
        method: "GET",
        data: {
            id_solicitud_adopcion: id_solicitud_adopcion,
            nuevo_estado: acepta_adopciones // Envía el estado al script PHP
        },
        success: function(response) {
            if (acepta_adopciones === "aceptada") {
                alert("La solicitud de adopción ha sido aceptada.");
            } else {
                alert("La solicitud de adopción ha sido denegada.");
            }
            listItem.remove(); // Elimina el elemento de la lista
        },
        error: function(xhr, status, error) {
            alert("Hubo un error al actualizar la solicitud.");
        }
    });
});
</script>
</body>
</html>
