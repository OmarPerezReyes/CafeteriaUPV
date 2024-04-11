<?php

session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit;
}

require_once "Connection.php"; // Incluimos el archivo de conexión

require_once "ProductoModel.php";

// Instanciar el modelo de productos
$productoModel = new ProductoModel($conexion);

// Obtener todos los productos
$productos = $productoModel->obtenerProductos();

// Cerrar la conexión (opcional, dependiendo del contexto)
//$conexion->close();

// Cargar la vista
require_once "productos.php";

?>