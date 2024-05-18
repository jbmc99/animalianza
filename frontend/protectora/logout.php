<?php
session_start();
session_destroy();
header('Location: ../protectora/login.php');
exit();
?>