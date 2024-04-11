<?php
session_start();

// Verificar si se ha enviado el ID del producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    // Obtener el ID del producto enviado desde el formulario
    $id_producto = $_POST['agregar'];
    
    // Inicializar el array de productos en el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
    
    // Agregar el ID del producto al array de productos en el carrito
    $_SESSION['carrito'][] = $id_producto;
    
    // Enviar una respuesta de éxito si es necesario (puede ser útil para manejar la respuesta en el JavaScript)
    echo "Producto agregado al carrito correctamente.";
} else {
    // Si no se ha enviado el ID del producto, enviar un mensaje de error
    echo "Error: No se ha especificado el producto.";
}
?>
