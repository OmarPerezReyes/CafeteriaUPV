<?php
session_start(); // Iniciar la sesión al principio del archivo

// Verificar si la sesión está activa
if (!isset($_SESSION['cliente'])) {
    // Si la sesión no está activa, redirigir al usuario a la página de inicio de sesión
    header("Location: inicio_sesion.php");
    exit;
}
// La sesión está activa, puedes acceder a la información del usuario
$cliente_id = $_SESSION['cliente'];
#$correo = $_SESSION['correo'];


require_once "Connection.php"; // Incluimos el archivo de conexión

require_once "../models/ProductoModel.php";

// Instanciar el modelo de productos
$productoModel = new ProductoModel($conn);

// Obtener todos los productos
$productos = $productoModel->obtenerProductos();

// Cerrar la conexión (opcional, dependiendo del contexto)
//$conexion->close();
// Cargar la vista
require_once "../views/productos.php";

?>