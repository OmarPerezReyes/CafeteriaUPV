<?php

require_once '../models/ClienteModel.php'; // Corregida la ruta del modelo
require_once 'Connection.php'; // Ruta al archivo de conexión

// Crear una instancia del modelo
$clienteModel = new ClienteModel($conn);

// Manejar los datos del formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar que se hayan enviado datos
    if (isset($_POST["correo"]) && isset($_POST["contraseña"])) {
        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];
            // Obtener el usuario por correo
            $usuario = $clienteModel->obtenerUsuarioPorCorreo($correo);
// Verificar si se obtuvo el usuario correctamente
if ($usuario) {
    // Se encontró el usuario, imprimir mensaje de éxito
    echo "Se ha encontrado el usuario correctamente.";
    // Aquí puedes hacer más acciones, como iniciar sesión o redirigir al usuario
} else {
    // No se encontró el usuario, imprimir mensaje de error
    echo "No se ha encontrado el usuario.";
}

       
    }
}

?>
