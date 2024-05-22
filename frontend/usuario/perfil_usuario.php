<?php
// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el id_usuario está almacenado en la sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no está almacenado, redirigir a la página de inicio de sesión
    header("Location: login.php"); // Cambiar 'login.php' por la página de inicio de sesión
    exit();
}

// Obtener el id_usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

// Incluir el archivo de conexión a la base de datos
include '../protectora/conexion.php';

// Consultar datos de la tabla usuario para el id_usuario específico
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

// Consultar las solicitudes de acogida del usuario
$sql_acogidas = "SELECT * FROM solicitud_acogida WHERE id_usuario = ?";
$stmt_acogidas = $conn->prepare($sql_acogidas);
$stmt_acogidas->bind_param("i", $id_usuario);
$stmt_acogidas->execute();
$result_acogidas = $stmt_acogidas->get_result();

// Organizar las solicitudes de acogida por estado
$solicitudes_pendientes_acogida = [];
$solicitudes_aceptadas_acogida = [];
$solicitudes_denegadas_acogida = [];

while ($row = $result_acogidas->fetch_assoc()) {
    // Obtener el nombre del animal para cada solicitud
    $sql_nombre_animal = "SELECT nombre FROM animal WHERE id_animal = ?";
    $stmt_nombre_animal = $conn->prepare($sql_nombre_animal);
    $stmt_nombre_animal->bind_param("i", $row['id_animal']);
    $stmt_nombre_animal->execute();
    $result_nombre_animal = $stmt_nombre_animal->get_result();
    $nombre_animal_row = $result_nombre_animal->fetch_assoc();
    $nombre_animal = $nombre_animal_row ? $nombre_animal_row['nombre'] : 'Nombre no encontrado';
    $stmt_nombre_animal->close();

    // Almacenar el nombre del animal en la solicitud
    $row['nombre_animal'] = $nombre_animal;

    if ($row['estado'] == 'pendiente') {
        $solicitudes_pendientes_acogida[] = $row;
    } elseif ($row['estado'] == 'aceptada') {
        $solicitudes_aceptadas_acogida[] = $row;
    } elseif ($row['estado'] == 'denegada') {
        $solicitudes_denegadas_acogida[] = $row;
    }
}

$stmt_acogidas->close();

// Consultar las solicitudes de adopción del usuario
$sql_adopciones = "SELECT * FROM solicitud_adopcion WHERE id_usuario = ?";
$stmt_adopciones = $conn->prepare($sql_adopciones);
$stmt_adopciones->bind_param("i", $id_usuario);
$stmt_adopciones->execute();
$result_adopciones = $stmt_adopciones->get_result();

// Organizar las solicitudes de adopción por estado
$solicitudes_pendientes_adopcion = [];
$solicitudes_aceptadas_adopcion = [];
$solicitudes_denegadas_adopcion = [];

while ($row = $result_adopciones->fetch_assoc()) {
    if ($row['estado'] == 'pendiente') {
        $solicitudes_pendientes_adopcion[] = $row;
    } elseif ($row['estado'] == 'aceptada') {
        $solicitudes_aceptadas_adopcion[] = $row;
    } elseif ($row['estado'] == 'denegada') {
        $solicitudes_denegadas_adopcion[] = $row;
    }

    // Obtener el nombre del animal para cada solicitud de adopción
    $sql_nombre_animal_adopcion = "SELECT nombre FROM animal WHERE id_animal = ?";
    $stmt_nombre_animal_adopcion = $conn->prepare($sql_nombre_animal_adopcion);
    $stmt_nombre_animal_adopcion->bind_param("i", $row['id_animal']);
    $stmt_nombre_animal_adopcion->execute();
    $result_nombre_animal_adopcion = $stmt_nombre_animal_adopcion->get_result();
    $nombre_animal_row_adopcion = $result_nombre_animal_adopcion->fetch_assoc();
    $nombre_animal_adopcion = $nombre_animal_row_adopcion ? $nombre_animal_row_adopcion['nombre'] : 'Nombre no encontrado';
    $stmt_nombre_animal_adopcion->close();

}

$stmt_adopciones->close();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perfil Usuario</title>
    <link rel="stylesheet" href="../usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
include('navbar_usuario.php');
?>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Perfil del Usuario</h1>

    <?php
    if ($usuario) {
        echo '
        <div class="card mb-3">
            <div class="card-header">
                <h2 class="card-title">' . htmlspecialchars($usuario['nombre']) . '</h2>
            </div>
            <div class="card-body">
                <p><strong>Dirección:</strong> ' . htmlspecialchars($usuario['direccion']) . '</p>
                <p><strong>Teléfono:</strong> ' . htmlspecialchars($usuario['telefono']) . '</p>
                <p><strong>Email:</strong> ' . htmlspecialchars($usuario['email']) . '</p>
            </div>
        </div>';
    } else {
        echo '<p>No se encontraron datos del usuario.</p>';
    }
    ?>

<h2 class="mb-4 text-center">Solicitudes de Acogida</h2>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="accordion" id="accordionSolicitudes">
                <div class="card">
                    <div class="card-header" id="headingPendientes">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapsePendientes" aria-expanded="true" aria-controls="collapsePendientes">
                                Pendientes
                            </button>
                        </h2>
                    </div>
                    <div id="collapsePendientes" class="collapse show" aria-labelledby="headingPendientes" data-parent="#accordionSolicitudes">
                        <div class="card-body">
                            <?php
                            if (!empty($solicitudes_pendientes_acogida)) {
                                foreach ($solicitudes_pendientes_acogida as $solicitud) {
                                    // Obtener el nombre del animal para cada solicitud
                                    $sql_nombre_animal = "SELECT nombre FROM animal WHERE id_animal = ?";
                                    $stmt_nombre_animal = $conn->prepare($sql_nombre_animal);
                                    $stmt_nombre_animal->bind_param("i", $solicitud['id_animal']);
                                    $stmt_nombre_animal->execute();
                                    $result_nombre_animal = $stmt_nombre_animal->get_result();
                                    $nombre_animal_row = $result_nombre_animal->fetch_assoc();
                                    $nombre_animal = $nombre_animal_row ? $nombre_animal_row['nombre'] : 'Nombre no encontrado';
                                    $stmt_nombre_animal->close();

                                    echo '
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                            <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones']) . '</p>
                                            <p><strong>Estilo de Vida:</strong> ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>
                                            <p><strong>Nombre del Animal:</strong> ' . htmlspecialchars($nombre_animal) . '</p>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<p>No hay solicitudes pendientes.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
    <div class="card-header" id="headingAceptadas">
        <h2 class="mb-0">
            <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapseAceptadas" aria-expanded="false" aria-controls="collapseAceptadas">
                Aceptadas
            </button>
        </h2>
    </div>
    <div id="collapseAceptadas" class="collapse" aria-labelledby="headingAceptadas" data-parent="#accordionSolicitudes">
        <div class="card-body">
            <?php
            if (!empty($solicitudes_aceptadas_acogida)) {
                foreach ($solicitudes_aceptadas_acogida as $solicitud) {
                    // Obtener el nombre del animal para cada solicitud
                    $sql_nombre_animal_aceptadas = "SELECT nombre FROM animal WHERE id_animal = ?";
                    $stmt_nombre_animal_aceptadas = $conn->prepare($sql_nombre_animal_aceptadas);
                    $stmt_nombre_animal_aceptadas->bind_param("i", $solicitud['id_animal']);
                    $stmt_nombre_animal_aceptadas->execute();
                    $result_nombre_animal_aceptadas = $stmt_nombre_animal_aceptadas->get_result();
                    $nombre_animal_row_aceptadas = $result_nombre_animal_aceptadas->fetch_assoc();
                    $nombre_animal_aceptadas = $nombre_animal_row_aceptadas ? $nombre_animal_row_aceptadas['nombre'] : 'Nombre no encontrado';
                    $stmt_nombre_animal_aceptadas->close();

                    echo '
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                            <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones']) . '</p>
                            <p><strong>Estilo de Vida:</strong> ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>
                            <p><strong>Nombre del Animal:</strong> ' . htmlspecialchars($nombre_animal_aceptadas) . '</p>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No hay solicitudes aceptadas.</p>';
            }
            ?>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" id="headingDenegadas">
        <h2 class="mb-0">
            <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapseDenegadas" aria-expanded="false" aria-controls="collapseDenegadas">
                Denegadas
            </button>
        </h2>
    </div>
    <div id="collapseDenegadas" class="collapse" aria-labelledby="headingDenegadas" data-parent="#accordionSolicitudes">
        <div class="card-body">
            <?php
            if (!empty($solicitudes_denegadas_acogida)) {
                foreach ($solicitudes_denegadas_acogida as $solicitud) {
                    // Obtener el nombre del animal para cada solicitud
                    $sql_nombre_animal_denegadas = "SELECT nombre FROM animal WHERE id_animal = ?";
                    $stmt_nombre_animal_denegadas = $conn->prepare($sql_nombre_animal_denegadas);
                    $stmt_nombre_animal_denegadas->bind_param("i", $solicitud['id_animal']);
                    $stmt_nombre_animal_denegadas->execute();
                    $result_nombre_animal_denegadas = $stmt_nombre_animal_denegadas->get_result();
                    $nombre_animal_row_denegadas = $result_nombre_animal_denegadas->fetch_assoc();
                    $nombre_animal_denegadas = $nombre_animal_row_denegadas ? $nombre_animal_row_denegadas['nombre'] : 'Nombre no encontrado';
                    $stmt_nombre_animal_denegadas->close();

                    echo '
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                            <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones']) . '</p>
                            <p><strong>Estilo de Vida:</strong> ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>
                            <p><strong>Nombre del Animal:</strong> ' . htmlspecialchars($nombre_animal_denegadas) . '</p>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No hay solicitudes denegadas.</p>';
            }
            ?>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

<h2 class="mb-4 text-center">Solicitudes de Adopción</h2>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="accordion" id="accordionSolicitudesAdopcion">
                <div class="card">
                    <div class="card-header" id="headingPendientesAdopcion">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapsePendientesAdopcion" aria-expanded="true" aria-controls="collapsePendientesAdopcion">
                                Pendientes
                            </button>
                        </h2>
                    </div>
                    <div id="collapsePendientesAdopcion" class="collapse show" aria-labelledby="headingPendientesAdopcion" data-parent="#accordionSolicitudesAdopcion">
                        <div class="card-body">
                            <?php
                            if (!empty($solicitudes_pendientes_adopcion)) {
                                foreach ($solicitudes_pendientes_adopcion as $solicitud) {
                                    // Obtener el nombre del animal para cada solicitud
                                    $sql_nombre_animal_pendientes = "SELECT nombre FROM animal WHERE id_animal = ?";
                                    $stmt_nombre_animal_pendientes = $conn->prepare($sql_nombre_animal_pendientes);
                                    $stmt_nombre_animal_pendientes->bind_param("i", $solicitud['id_animal']);
                                    $stmt_nombre_animal_pendientes->execute();
                                    $result_nombre_animal_pendientes = $stmt_nombre_animal_pendientes->get_result();
                                    $nombre_animal_row_pendientes = $result_nombre_animal_pendientes->fetch_assoc();
                                    $nombre_animal_pendientes = $nombre_animal_row_pendientes ? $nombre_animal_row_pendientes['nombre'] : 'Nombre no encontrado';
                                    $stmt_nombre_animal_pendientes->close();

                                    echo '
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_adopcion']) . '</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                            <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones_adoptar']) . '</p>
                                            <p><strong>Información de la Familia:</strong> ' . htmlspecialchars($solicitud['info_familia']) . '</p>
                                            <p><strong>Nombre del Animal:</strong> ' . htmlspecialchars($nombre_animal_pendientes) . '</p>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<p>No hay solicitudes pendientes.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingAceptadasAdopcion">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapseAceptadasAdopcion" aria-expanded="false" aria-controls="collapseAceptadasAdopcion">
                                Aceptadas
                            </button>
                        </h2>
                    </div>
                    <div id="collapseAceptadasAdopcion" class="collapse" aria-labelledby="headingAceptadasAdopcion" data-parent="#accordionSolicitudesAdopcion">
                        <div class="card-body">
                            <?php
                            if (!empty($solicitudes_aceptadas_adopcion)) {
                                foreach ($solicitudes_aceptadas_adopcion as $solicitud) {
                                    // Obtener el nombre del animal para cada solicitud
                                    $sql_nombre_animal_aceptadas = "SELECT nombre FROM animal WHERE id_animal = ?";
                                    $stmt_nombre_animal_aceptadas = $conn->prepare($sql_nombre_animal_aceptadas);
                                    $stmt_nombre_animal_aceptadas->bind_param("i", $solicitud['id_animal']);
                                    $stmt_nombre_animal_aceptadas->execute();
                                    $result_nombre_animal_aceptadas = $stmt_nombre_animal_aceptadas->get_result();
                                    $nombre_animal_row_aceptadas = $result_nombre_animal_aceptadas->fetch_assoc();
                                    $nombre_animal_aceptadas = $nombre_animal_row_aceptadas ? $nombre_animal_row_aceptadas['nombre'] : 'Nombre no encontrado';
                                    $stmt_nombre_animal_aceptadas->close();

                                    echo '
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_adopcion']) . '</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                            <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones_adoptar']) . '</p>
                                            <p><strong>Información de la Familia:</strong> ' . htmlspecialchars($solicitud['info_familia']) . '</p>
                                            <p><strong>Nombre del Animal:</strong> ' . htmlspecialchars($nombre_animal_aceptadas) . '</p>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<p>No hay solicitudes aceptadas.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                        <div class="card">
                            <div class="card-header" id="headingDenegadasAdopcion">
                                <h2 class="mb-0">
                                    <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapseDenegadasAdopcion" aria-expanded="false" aria-controls="collapseDenegadasAdopcion">
                                        Denegadas
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseDenegadasAdopcion" class="collapse" aria-labelledby="headingDenegadasAdopcion" data-parent="#accordionSolicitudesAdopcion">
                                <div class="card-body">
                                    <?php
                                    if (!empty($solicitudes_denegadas_adopcion)) {
                                        foreach ($solicitudes_denegadas_adopcion as $solicitud) {
                                            echo '
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_adopcion']) . '</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                                    <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones_adoptar']) . '</p>
                                                    <p><strong>Información de la Familia:</strong> ' . htmlspecialchars($solicitud['info_familia']) . '</p>
                                                    <p><strong>Nombre del Animal:</strong> ' . htmlspecialchars($nombre_animal) . '</p>
                                                </div>
                                            </div>';
                                        }
                                    } else {
                                        echo '<p>No hay solicitudes denegadas.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>

<?php
include('../usuario/footer.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
