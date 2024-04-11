<?php
session_start();

require_once "Connection.php"; // Incluimos el archivo de conexión

require_once "../models/ProductoModel.php";

// Instanciar el modelo de productos
$productoModel = new ProductoModel($conn);

// Obtener todos los productos
$productos = $productoModel->obtenerProductos();

$productosSeleccionados = array();
$totalCompra = 0;

if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $idProducto) {
        foreach ($productos as $producto) {
            if ($producto['id_producto'] == $idProducto) {
                $productosSeleccionados[] = $producto;
                $totalCompra += $producto['precio'];
                break;
            }
        }
    }
}

require_once '../views/carrito.php';
?>
