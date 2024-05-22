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

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consultar datos de la tabla protectora para el id_protectora específico
$sql = "SELECT * FROM protectora WHERE id_protectora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_protectora);
$stmt->execute();
$result = $stmt->get_result();

// Consultar nombres y apellidos de las tablas solicitud_adopcion y solicitud_voluntariado
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

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perfil Protectora</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
include('navbar_protectora.php');
?>

<div class="container mt-5">
    <h1 class="mb-4">Perfil de la Protectora</h1>

    <?php
    // Verificar si se encontraron datos
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