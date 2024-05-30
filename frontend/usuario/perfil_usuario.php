<?php
// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el id_login está almacenado en la sesión
if (!isset($_SESSION['id_login'])) {
    // Si no está almacenado, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener el id_login de la sesión
$idLogin = $_SESSION['id_login'];

// Incluir el archivo de conexión a la base de datos
include '../protectora/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Obtener el id_usuario correspondiente al id_login
$result = $conn->query("SELECT id_usuario FROM usuario WHERE id_login = $idLogin");
$row = $result->fetch_assoc();
$idUsuario = $row['id_usuario'];

// Consultar datos de la tabla usuario para el id_usuario específico
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la preparación de la consulta de usuario: " . $conn->error);
}

$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Error en la ejecución de la consulta de usuario: " . $stmt->error);
}

$usuario = $result->fetch_assoc();
$stmt->close();
if (!$usuario) {
    die("No se encontró ningún usuario con el id_usuario especificado.");
}

// Consultar solicitudes de acogida del usuario
$sql_acogida = "SELECT * FROM solicitud_acogida WHERE id_usuario = ?";
$stmt_acogida = $conn->prepare($sql_acogida);
if (!$stmt_acogida) {
    die("Error en la preparación de la consulta de solicitud de acogida: " . $conn->error);
}

$stmt_acogida->bind_param("i", $idUsuario);
$stmt_acogida->execute();
$result_acogida = $stmt_acogida->get_result();
$solicitudes_acogida = $result_acogida->fetch_all(MYSQLI_ASSOC);
$stmt_acogida->close();

// Consultar solicitudes de adopción del usuario
$sql_adopcion = "SELECT * FROM solicitud_adopcion WHERE id_usuario = ?";
$stmt_adopcion = $conn->prepare($sql_adopcion);
if (!$stmt_adopcion) {
    die("Error en la preparación de la consulta de solicitud de adopción: " . $conn->error);
}

$stmt_adopcion->bind_param("i", $idUsuario);
$stmt_adopcion->execute();
$result_adopcion = $stmt_adopcion->get_result();
$solicitudes_adopcion = $result_adopcion->fetch_all(MYSQLI_ASSOC);
$stmt_adopcion->close();

// Consultar solicitudes de voluntariado del usuario
$sql_voluntariado = "SELECT * FROM solicitud_voluntariado WHERE id_usuario = ?";
$stmt_voluntariado = $conn->prepare($sql_voluntariado);
if (!$stmt_voluntariado) {
    die("Error en la preparación de la consulta de solicitud de voluntariado: " . $conn->error);
}

$stmt_voluntariado->bind_param("i", $idUsuario);
$stmt_voluntariado->execute();
$result_voluntariado = $stmt_voluntariado->get_result();
$solicitudes_voluntariado = $result_voluntariado->fetch_all(MYSQLI_ASSOC);
$stmt_voluntariado->close();
?>


<?php
include('header.php');
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

  <!-- Mostrar solicitudes de acogida Aceptadas -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Acogida Aceptadas</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_acogida_aceptadas = array_filter($solicitudes_acogida, function($solicitud) {
            return $solicitud['estado'] === 'aceptada';
        });
        if (!empty($solicitudes_acogida_aceptadas)) {
            foreach ($solicitudes_acogida_aceptadas as $solicitud) {
                // Mostrar cada solicitud de acogida aceptada
                echo '<p>ID de Solicitud: ' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de Teléfono: ' . htmlspecialchars($solicitud['telefono']) . '</p>';
                echo '<p>Motivaciones: ' . htmlspecialchars($solicitud['motivaciones']) . '</p>';
                echo '<p>Estilo de vida: ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de acogida aceptadas.</p>';
        }
        ?>
    </div>
</div>

<!-- Mostrar solicitudes de acogida Denegadas -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Acogida Denegadas</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_acogida_denegadas = array_filter($solicitudes_acogida, function($solicitud) {
            return $solicitud['estado'] === 'denegada';
        });
        if (!empty($solicitudes_acogida_denegadas)) {
            foreach ($solicitudes_acogida_denegadas as $solicitud) {
                // Mostrar cada solicitud de acogida denegada
                echo '<p>ID de Solicitud: ' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de Teléfono: ' . htmlspecialchars($solicitud['telefono']) . '</p>';
                echo '<p>Motivaciones: ' . htmlspecialchars($solicitud['motivaciones']) . '</p>';
                echo '<p>Estilo de vida: ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de acogida denegadas.</p>';
        }
        ?>
    </div>
</div>

<!-- Mostrar solicitudes de acogida Pendientes -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Acogida Pendientes</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_acogida_pendientes = array_filter($solicitudes_acogida, function($solicitud) {
            return $solicitud['estado'] === 'pendiente';
        });
        if (!empty($solicitudes_acogida_pendientes)) {
            foreach ($solicitudes_acogida_pendientes as $solicitud) {
                // Mostrar cada solicitud de acogida pendiente
                echo '<p>ID de Solicitud: ' . htmlspecialchars($solicitud['id_solicitud_acogida']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de Teléfono: ' . htmlspecialchars($solicitud['telefono']) . '</p>';
                echo '<p>Motivaciones: ' . htmlspecialchars($solicitud['motivaciones']) . '</p>';
                echo '<p>Estilo de vida: ' . htmlspecialchars($solicitud['estilo_vida']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de acogida pendientes.</p>';
        }
        ?>
    </div>
</div>


   <!-- Mostrar solicitudes de adopción Aceptadas -->
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Adopción Aceptadas</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_adopcion_aceptadas = array_filter($solicitudes_adopcion, function($solicitud) {
            return $solicitud['estado'] === 'aceptada';
        });
        if (!empty($solicitudes_adopcion_aceptadas)) {
            foreach ($solicitudes_adopcion_aceptadas as $solicitud) {
                // Mostrar cada solicitud de adopción aceptada
                echo '<p>Nombre y apellidos: ' . htmlspecialchars($solicitud['nombre_apellidos']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de teléfono: ' . htmlspecialchars($solicitud['numero_telefono']) . '</p>';
                echo '<p>Permiso de mascotas: ' . htmlspecialchars($solicitud['permiso_mascotas']) . '</p>';
                echo '<p>Propietario o inquilino: ' . htmlspecialchars($solicitud['propietario_inquilino']) . '</p>';
                echo '<p>Motivaciones para adoptar: ' . htmlspecialchars($solicitud['motivaciones_adoptar']) . '</p>';
                echo '<p>Info familia: ' . htmlspecialchars($solicitud['info_familia']) . '</p>';
                // Mostrar más detalles si es necesario
            }
        } else {
            echo '<p>No hay solicitudes de adopción aceptadas.</p>';
        }
        ?>
    </div>
</div>

<!-- Mostrar solicitudes de adopción Denegadas -->
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Adopción Denegadas</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_adopcion_denegadas = array_filter($solicitudes_adopcion, function($solicitud) {
            return $solicitud['estado'] === 'denegada';
        });
        if (!empty($solicitudes_adopcion_denegadas)) {
            foreach ($solicitudes_adopcion_denegadas as $solicitud) {
                // Mostrar cada solicitud de adopción denegada
                echo '<p>Nombre y apellidos: ' . htmlspecialchars($solicitud['nombre_apellidos']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de teléfono: ' . htmlspecialchars($solicitud['numero_telefono']) . '</p>';
                echo '<p>Permiso de mascotas: ' . htmlspecialchars($solicitud['permiso_mascotas']) . '</p>';
                echo '<p>Propietario o inquilino: ' . htmlspecialchars($solicitud['propietario_inquilino']) . '</p>';
                echo '<p>Motivaciones para adoptar: ' . htmlspecialchars($solicitud['motivaciones_adoptar']) . '</p>';
                echo '<p>Info familia: ' . htmlspecialchars($solicitud['info_familia']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de adopción denegadas.</p>';
        }
        ?>
    </div>
</div>

<!-- Mostrar solicitudes de adopción Pendientes -->
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Adopción Pendientes</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_adopcion_pendientes = array_filter($solicitudes_adopcion, function($solicitud) {
            return $solicitud['estado'] === 'pendiente';
        });
        if (!empty($solicitudes_adopcion_pendientes)) {
            foreach ($solicitudes_adopcion_pendientes as $solicitud) {
                echo '<p>Nombre y apellidos: ' . htmlspecialchars($solicitud['nombre_apellidos']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de teléfono: ' . htmlspecialchars($solicitud['numero_telefono']) . '</p>';
                echo '<p>Permiso de mascotas: ' . htmlspecialchars($solicitud['permiso_mascotas']) . '</p>';
                echo '<p>Propietario o inquilino: ' . htmlspecialchars($solicitud['propietario_inquilino']) . '</p>';
                echo '<p>Motivaciones para adoptar: ' . htmlspecialchars($solicitud['motivaciones_adoptar']) . '</p>';
                echo '<p>Info familia: ' . htmlspecialchars($solicitud['info_familia']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de adopción pendientes.</p>';
        }
        ?>
    </div>
</div>



<!-- Mostrar solicitudes de voluntariado Pendientes -->
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Voluntariado Pendientes</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_voluntariado_pendientes = array_filter($solicitudes_voluntariado, function($solicitud) {
            return $solicitud['estado'] === 'pendiente';
        });
        if (!empty($solicitudes_voluntariado_pendientes)) {
            foreach ($solicitudes_voluntariado_pendientes as $solicitud) {
                echo '<p>Nombre y apellidos: ' . htmlspecialchars($solicitud['nombre_apellidos']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de teléfono: ' . htmlspecialchars($solicitud['numero_telefono']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de voluntariado pendientes.</p>';
        }
        ?>
    </div>
</div>

<!-- Mostrar solicitudes de voluntariado Aceptadas -->
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Voluntariado Aceptadas</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_voluntariado_aceptadas = array_filter($solicitudes_voluntariado, function($solicitud) {
            return $solicitud['estado'] === 'aceptada';
        });
        if (!empty($solicitudes_voluntariado_aceptadas)) {
            foreach ($solicitudes_voluntariado_aceptadas as $solicitud) {
                // Mostrar cada solicitud de voluntariado aceptada
                echo '<p>Nombre y apellidos: ' . htmlspecialchars($solicitud['nombre_apellidos']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de teléfono: ' . htmlspecialchars($solicitud['numero_telefono']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de voluntariado aceptadas.</p>';
        }
        ?>
    </div>
</div>

<!-- Mostrar solicitudes de voluntariado Denegadas -->
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Solicitudes de Voluntariado Denegadas</h2>
    </div>
    <div class="card-body">
        <?php
        $solicitudes_voluntariado_denegadas = array_filter($solicitudes_voluntariado, function($solicitud) {
            return $solicitud['estado'] === 'denegada';
        });
        if (!empty($solicitudes_voluntariado_denegadas)) {
            foreach ($solicitudes_voluntariado_denegadas as $solicitud) {
                echo '<p>Nombre y apellidos: ' . htmlspecialchars($solicitud['nombre_apellidos']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($solicitud['email']) . '</p>';
                echo '<p>Número de teléfono: ' . htmlspecialchars($solicitud['numero_telefono']) . '</p>';
            }
        } else {
            echo '<p>No hay solicitudes de voluntariado denegadas.</p>';
        }
        ?>
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
