<?php

session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["agregar"])) {
    // Agregar producto al carrito
    $productoId = $_POST["agregar"];
    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = [];
    }
    $_SESSION["carrito"][] = $productoId;
}

require_once "Connection.php"; // Incluimos el archivo de conexión

require_once "ProductoModel.php";

// Instanciar el modelo de productos
$productoModel = new ProductoModel($conexion);

// Obtener los productos seleccionados
$productosSeleccionados = [];
foreach ($_SESSION["carrito"] as $productoId) {
    $producto = $productoModel->obtenerProductoPorId($productoId);
    if ($producto) {
        $productosSeleccionados[] = $producto;
    }
}

// Calcular el total de la compra
$totalCompra = 0;
foreach ($productosSeleccionados as $producto) {
    $totalCompra += $producto["precio"];
}

// Cargar la vista
require_once "carrito.php";
?>