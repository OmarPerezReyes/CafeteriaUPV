<?php
session_start();

// Incluir el archivo de conexión y definir las variables $productosSeleccionados y $totalCompra
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

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Código QR</title>
    <!-- Agregar la referencia al CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ticket {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
        }
        .ticket h2 {
            text-align: center;
        }
        .ticket p {
            margin: 5px 0;
        }
        .ticket .productos p {
            display: flex;
            justify-content: space-between;
        }
        .ticket hr {
            border-top: 1px dashed #ccc;
        }
        .help-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .help-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
                <div class="text-center">
                    <button id="helpButton" class="btn btn-info">Ayuda</button>
                </div>
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="../controllers/cerrar_sesion.php">Cerrar Sesión</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="ticket">
                    <h2 class="mb-4">Ticket de Compra</h2>
                    <p><strong>Número de Orden:</strong> <?php echo rand(10000, 99999); ?></p>
                    <p><strong>Fecha:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                    <hr>
                    <h3>Productos:</h3>
                    <div class="productos">
                        <?php foreach ($productosSeleccionados as $producto): ?>
                            <p><span><?php echo $producto['nombre_Producto']; ?></span> <span>$<?php echo number_format($producto['precio'], 2); ?></span></p>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <p><strong>Total de Compra:</strong> $<?php echo number_format($totalCompra, 2); ?></p>
                    <p><strong>Pago en Efectivo:</strong> $<?php echo number_format($totalCompra, 2); ?></p>
                </div>
            </div>
        </div>
    </div>
        <!-- Campo de ayuda -->
    <div id="helpModal" class="help-modal">
        <div class="help-modal-content">
            <span class="close">&times;</span>
            <h2>Ayuda</h2>
            <p>Aqui puede observar los detalles de su producto al enfocar el codigo qr con la camara </p>
            <p>Si desea volver al menú de click en "Volver al Menú de Productos"</p>
            <p>Si desea Cerrar Sesión, de click en el boton "Cerrar Sesión"</p>
            <p>Si desea salir de la "Ayuda", haga clic en la "X" o presione la tecla "Esc".</p>
        </div>
    </div>
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
        // Llamar a la función del modelo para generar el código QR
        $qr_generated = generarCodigoQR($datos_pedido);
        if ($qr_generated) {
            // Ruta de la imagen del código QR
            $qr_image = '../../public/images/temp/pedido_' . $datos_pedido['codigo_Recogida'] . '.png';
            // Mostrar la imagen del código QR
            echo '<div class="text-center"><img src="' . $qr_image . '" alt="Código QR del Pedido ' . $id_pedido . '" style="max-width: 300px;" /></div>';
        } else {
            echo "Error al generar el código QR para el pedido con ID: " . $id_pedido;
        }
    } else {
        echo "No se encontró el pedido con ID: " . $id_pedido;
    }
    $conn->close();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var modal = document.getElementById("helpModal");
        var btn = document.getElementById("helpButton");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === "F1") {
                    event.preventDefault();
                    modal.style.display = "block";
                }
            if (event.key === "Escape") {
                modal.style.display = "none";
            }
        });
    });
</script>
</body>
</html>
