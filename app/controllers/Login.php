<?php
session_start(); // Iniciar la sesión al principio del archivo

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
            #echo "Nombre: " . $usuario['nombre'] . "<br>";
            #echo "Apellido: " . $usuario['apellido'] . "<br>";
            #echo "Correo: " . $usuario['correo'] . "<br>";
            // Iniciar sesión y almacenar información del usuario en la variable de sesión
            $_SESSION['cliente'] =  $usuario['matricula'] ;
            $_SESSION['nombre'] =  $usuario['nombre'] ;
            $_SESSION['email'] =  $usuario['correo'] ;
            
            // Redirigir al usuario a la página de productos
            header("Location: productos_controller.php");

        } else {
            // No se encontró el usuario, imprimir mensaje de error
            // Construir el bloque de JavaScript para el SweetAlert y la redirección
        $script = '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se ha encontrado el usuario."
            }).then(function() {
                window.location.href = "../../index.php"; // Redirige a página de registro
            });
        });
        </script>
        ';

        // Imprimir el bloque de JavaScript
        echo $script;
        }      
    }
}
?>
