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

// Organizar las solicitudes por estado
$solicitudes_pendientes = [];
$solicitudes_aceptadas = [];
$solicitudes_denegadas = [];

while ($row = $result_acogidas->fetch_assoc()) {
    if ($row['estado'] == 'pendiente') {
        $solicitudes_pendientes[] = $row;
    } elseif ($row['estado'] == 'aceptada') {
        $solicitudes_aceptadas[] = $row;
    } elseif ($row['estado'] == 'denegada') {
        $solicitudes_denegadas[] = $row;
    }
}

$stmt_acogidas->close();
$conn->close();
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
    <h1 class="mb-4">Perfil del Usuario</h1>

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

    <h2 class="mb-4">Solicitudes de Acogida</h2>

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
                    if (!empty($solicitudes_pendientes)) {
                        foreach ($solicitudes_pendientes as $solicitud) {
                            echo '
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                    <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones']) . '</p>
                                    <p><strong>Estilo de Vida:</strong> ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>
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
                    if (!empty($solicitudes_aceptadas)) {
                        foreach ($solicitudes_aceptadas as $solicitud) {
                            echo '
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                    <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones']) . '</p>
                                    <p><strong>Estilo de Vida:</strong> ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>
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
                    if (!empty($solicitudes_denegadas)) {
                        foreach ($solicitudes_denegadas as $solicitud) {
                            echo '
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Solicitud #' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>Animal ID:</strong> ' . htmlspecialchars($solicitud['id_animal']) . '</p>
                                    <p><strong>Motivaciones:</strong> ' . htmlspecialchars($solicitud['motivaciones']) . '</p>
                                    <p><strong>Estilo de Vida:</strong> ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>
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

<?php
include('../usuario/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
