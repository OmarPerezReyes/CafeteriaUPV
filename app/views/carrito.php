<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        .producto {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .producto img {
            max-width: 100px; /* Tamaño máximo para las imágenes */
            margin-right: 20px;
        }
        .producto-info {
            display: flex;
            align-items: center;
        }
        .eliminar-producto {
            margin-top: 10px;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
        }
        .navbar {
            margin-bottom: 20px; /* Añadir más margen inferior a la barra de navegación */
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
    <?php //var_dump($_SESSION['carrito']); ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Carrito de Compras</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="productos_controller.php">Volver al Menú de Productos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../controllers/cerrar_sesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="text-center">
            <button id="helpButton" class="btn btn-info">Ayuda</button>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if (empty($productosSeleccionados)): ?>
                    <div class="alert alert-info" role="alert">
                        No hay productos en el carrito.
                    </div>
                <?php else: ?>
                    <h2 class="mb-4">Detalles de los Productos Seleccionados</h2>
                    <?php foreach ($productosSeleccionados as $index => $producto): ?>
                        <div class="producto">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="producto-info">
                                        <img src="<?php echo $producto["imagen_url"]; ?>" alt="<?php echo $producto["nombre"]; ?>">
                                        <p class="mb-0"><strong><?php echo $producto["nombre"]; ?></strong> - $<?php echo $producto["precio"]; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-danger eliminar-producto" data-index="<?php echo $index; ?>">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="total">
                        <p>Total de compra: $<?php echo $totalCompra; ?></p>
                    </div>

                    <div class="text-center mt-4">
    <a href="../controllers/GenerarQR.php" class="btn btn-success">Realizar Pedido</a>
</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
        <!-- Campo de ayuda -->
        <div id="helpModal" class="help-modal">
        <div class="help-modal-content">
            <span class="close">&times;</span>
            <h2>Ayuda</h2>
            <p>Si desea eliminar un producto, de click en el boton "Eliminar"</p>
            <p>Si desea realizar el Pedido de click en "Realizar Pedido"</p>
            <p>Si desea volver al Menú de Productos, de click en el menu "Volver al Menú de Productos"</p>
            <p>Si desea Cerrar Sesión, de click en el boton "Cerrar Sesión"</p>
            <p>Si desea salir de la "Ayuda", haga clic en la "X" o presione la tecla "Esc".</p>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.eliminar-producto').click(function() {
                var index = $(this).data('index');
                console.log('Índice del producto a eliminar:', index);
                $.ajax({
                    type: 'POST',
                    url: 'eliminar_producto.php',
                    data: { index: index },
                    success: function(response) {
                        // Actualizar la página o manejar la respuesta si es necesario
                        window.location.reload();
                    }
                });
            });
        });
    // Script para mostrar la ayuda
    $(document).ready(function() {
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
