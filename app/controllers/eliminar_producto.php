<?php
session_start();

// Verificar si se ha enviado el índice del producto a eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['index'])) {
    $index = $_POST['index'];
    
    if (isset($_SESSION['carrito'][$index])) {
        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$index]);
        
        // Reorganizar los índices del array del carrito
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

?>
