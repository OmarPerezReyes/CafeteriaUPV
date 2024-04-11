<?php

// Agregar la librería para generar códigos QR
require_once "../../phpqrcode/qrlib.php";

function generarCodigoQR($datos_pedido)
{
    // Declaramos una carpeta temporal para guardar las imágenes generadas
    $dir = '../../temp/';

    // Si no existe la carpeta la creamos
    if (!file_exists($dir)) {
        mkdir($dir);
    }

    // Parámetros de Configuración
    $tamaño = 10; // Tamaño de Pixel
    $level = 'L'; // Precisión Baja
    $framSize = 3; // Tamaño en blanco

    // Construir el contenido basado en los datos del pedido
    $contenido = "ID Pedido: " . $datos_pedido['id_pedido'] . "\n";
    $contenido .= "ID Cliente: " . $datos_pedido['id_cliente'] . "\n";
    $contenido .= "Fecha/Hora Pedido: " . $datos_pedido['fecha_hora_Pedido'] . "\n";
    $contenido .= "Estado Pedido: " . $datos_pedido['estado_Pedido'] . "\n";
    $contenido .= "Total Pedido: " . $datos_pedido['total_Pedido'] . "\n";
    $contenido .= "Código Recogida: " . $datos_pedido['codigo_Recogida'];

    // Ruta y nombre del archivo a generar
    $filename = $dir . 'pedido_' . $datos_pedido['codigo_Recogida'] . '.png';

    // Generamos el código QR
    QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

    // Devolvemos true si se generó correctamente, false si hubo un error
    return file_exists($filename);
}

?>
