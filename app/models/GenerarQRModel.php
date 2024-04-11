<?php

// Agregar la librería para generar códigos QR
require_once "phpqrcode/qrlib.php";

function generarCodigoQR($datos_pedido)
{
    var_dump($datos_pedido);
    // Declaramos una carpeta temporal para guardar las imágenes generadas
    $dir = '../../public/images/temp/';

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
    $contenido .= "ID Cliente: " . $datos_pedido['id_Cliente'] . "\n";
    $contenido .= "Fecha/Hora Pedido: " . $datos_pedido['fecha_Hora_Pedido'] . "\n";
    $contenido .= "Estado Pedido: " . $datos_pedido['estado_Pedido'] . "\n";
    $contenido .= "Total Pedido: " . $datos_pedido['total_Pedido'] . "\n";
    $contenido .= "Código Recogida: " . $datos_pedido['codigo_Recogida'];

    // Ruta y nombre del archivo a generar
    $filename = $dir . 'pedido_' . $datos_pedido['codigo_Recogida'] . '.png';


    // Generamos el código QR
    QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

    // Verificar si el archivo se generó correctamente
    if (file_exists($filename)) {
        echo "Archivo QR generado correctamente: <br>";
        echo "<img src='" . $filename . "' alt='QR Code'><br>";
        return true;
    } else {
        echo "Error: No se pudo generar el archivo QR.<br>";
        return false;
    }
}

// Datos de prueba para depuración
$datos_pedido = array(
    'id_pedido' => '123',
    'id_Cliente' => '456',
    'fecha_Hora_Pedido' => '2024-04-16 10:30:00',
    'estado_Pedido' => 'Pendiente',
    'total_Pedido' => '50.00',
    'codigo_Recogida' => 'ABCD1234'
);

// Llamar a la función para depuración
generarCodigoQR($datos_pedido);

?>
