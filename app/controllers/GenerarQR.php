
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Código QR</title>
    <!-- Agregar la referencia al CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-fill">
                <li class="nav-item">
                <a class="nav-link" href="productos_controller.php">Volver al Menú de Productos</a>

                </li>
            </ul>
            <span class="nav-link"><?php echo $_SESSION['nombre']; ?></span>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="../controllers/cerrar_sesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-4">Generar Código QR</h1>
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
        $qr_image = '../../public/images/temp
        ../../temp/pedido_' . $datos_pedido['codigo_Recogida'] . '.png';

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
    </div>

    <!-- Agregar la referencia al JS de Bootstrap y jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
