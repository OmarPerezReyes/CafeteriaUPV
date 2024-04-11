<?php
// Iniciar sesión si no está iniciada
session_start();

// Destruir la sesión
session_destroy();

// Redireccionar al usuario a la página de inicio
header('Location: ../../index.php');
exit(); // Asegurarse de que el script se detenga después de redireccionar
?>
