<?php

// Incluir el archivo de conexión
require_once "Connection.php";

// Cargar el modelo
require_once "../models/GenerarQRModel.php";

// Consulta para obtener los datos del pedido con id_pedido = 4
$id_pedido = 4; // Puedes cambiar esto por el id_pedido deseado
$query = "SELECT * FROM pedidos WHERE id_pedido = $id_pedido";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Crear un array asociativo con los datos del pedido
    $datos_pedido = array(
        'id_pedido' => $row['id_pedido'],
        'id_cliente' => $row['id_Cliente'],
        'fecha_hora_Pedido' => $row['fecha_Hora_Pedido'],
        'estado_Pedido' => $row['estado_Pedido'],
        'total_Pedido' => $row['total_Pedido'],
        'codigo_Recogida' => $row['codigo_Recogida']
    );
    #echo var_dump($datos_pedido);
    // Llamar a la función del modelo para generar el código QR
    $qr_generated = generarCodigoQR($datos_pedido);

    if ($qr_generated) {
        // Ruta de la imagen del código QR
        $qr_image = '../../public/images/temp/pedido_' . $datos_pedido['codigo_Recogida'] . '.png';

        // Mostrar la imagen del código QR
        echo '<img src="' . $qr_image . '" alt="Código QR del Pedido ' . $id_pedido . '" />';
    } else {
        echo "Error al generar el código QR para el pedido con ID: " . $id_pedido;
        // Puedes redirigir o mostrar algún mensaje de error aquí
    }
} else {
    echo "No se encontró el pedido con ID: " . $id_pedido;
    // Puedes redirigir o mostrar algún mensaje de error aquí
}

$conn->close();

?>
