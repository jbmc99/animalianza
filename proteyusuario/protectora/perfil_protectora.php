<?php
session_start();

if (!isset($_SESSION['id_protectora'])) {
    header("Location: login.php"); 
    exit();
}
$id_protectora = $_SESSION['id_protectora'];

include 'conexion.php';

//consultamos los datos de la protectora
$sql = "SELECT * FROM protectora WHERE id_protectora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_protectora);
$stmt->execute();
$result = $stmt->get_result();

//y consultamos nombres y apellidos de los adoptantes y voluntarios
$sql_adopcion = "SELECT nombre_apellidos FROM solicitud_adopcion WHERE id_protectora = ?";
$stmt_adopcion = $conn->prepare($sql_adopcion);
$stmt_adopcion->bind_param("i", $id_protectora);
$stmt_adopcion->execute();
$result_adopcion = $stmt_adopcion->get_result();

$sql_voluntariado = "SELECT nombre_apellidos FROM solicitud_voluntariado WHERE id_protectora = ?";
$stmt_voluntariado = $conn->prepare($sql_voluntariado);
$stmt_voluntariado->bind_param("i", $id_protectora);
$stmt_voluntariado->execute();
$result_voluntariado = $stmt_voluntariado->get_result();

$conn->close();
?>

<?php
include('..usuario/header.php');
include('navbar_protectora.php');
?>

<div class="container mt-5">
    <h1 class="mb-4">Perfil de la Protectora</h1>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '
            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="card-title">' . htmlspecialchars($row['nombre']) . '</h2>
                </div>
                <div class="card-body">
                    <p><strong>Dirección:</strong> ' . htmlspecialchars($row['direccion']) . '</p>
                    <p><strong>Teléfono:</strong> ' . htmlspecialchars($row['telefono']) . '</p>
                    <p><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>
                    <p><strong>Acepta Adopciones:</strong> ' . ($row['acepta_adopciones'] ? 'Sí' : 'No') . '</p>
                    <p><strong>Acepta Acogidas:</strong> ' . ($row['acepta_acogidas'] ? 'Sí' : 'No') . '</p>
                    <p><strong>Acepta Voluntarios:</strong> ' . ($row['acepta_voluntarios'] ? 'Sí' : 'No') . '</p>
                    <p><strong>Info Protectora:</strong> ' . nl2br(htmlspecialchars($row['info_prote'])) . '</p>
                    <p><strong>Info Relevante:</strong> ' . nl2br(htmlspecialchars($row['info_relevante'])) . '</p>
                    
                    <p><strong>Voluntarios actuales:</p></strong>';
                    if ($result_voluntariado->num_rows > 0) {
                        while($voluntario = $result_voluntariado->fetch_assoc()) {
                            echo '<p>' . htmlspecialchars($voluntario['nombre_apellidos']) . '</p>';
                        }
                    } else {
                        echo '<p>No hay voluntarios actuales.</p>';
                    }

                    echo '<p><strong>Adoptantes actuales:</p></strong>';
                    if ($result_adopcion->num_rows > 0) {
                        while($adoptante = $result_adopcion->fetch_assoc()) {
                            echo '<p>' . htmlspecialchars($adoptante['nombre_apellidos']) . '</p>';
                        }
                    } else {
                        echo '<p>No hay adoptantes actuales.</p>';
                    }
                echo '</div>
            </div>';
        }
    } else {
        echo '<p>No se encontraron datos.</p>';
    }
    ?>
</div>

<?php
    include('../usuario/footer.php');
    ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>