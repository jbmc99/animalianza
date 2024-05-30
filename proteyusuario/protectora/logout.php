<!--cerramos la sesion con session_destroy y redirigimos al login-->
<?php
session_start();
session_destroy();
header('Location: ../protectora/login.php');
exit();
?>