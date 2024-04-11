<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Productos</title>
    <!-- Agregar la referencia al CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="carritoLlenoController.php">
                        Carrito 
                        <?php 
                            // Obtener el número de elementos en el carrito de la sesión
                            $numProductosEnCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
                        ?>
                        <span class="badge badge-pill badge-primary"><?php echo $numProductosEnCarrito; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/cerrar_sesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-4">Menú de Productos</h1>

        <div class="row">
            <?php foreach ($productos as $producto): ?>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="<?php echo $producto['imagen_url']; ?>" class="card-img-top" alt="<?php echo $producto['nombre_Producto']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $producto['nombre_Producto']; ?></h5>
                        <p class="card-text">$<?php echo $producto['precio']; ?></p>
                        <button type="button" class="btn btn-primary agregar-carrito" data-producto="<?php echo $producto['id_producto']; ?>">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Agregar la referencia al JS de Bootstrap y jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    // Script para manejar el evento de clic en el botón "Agregar al Carrito"
    $(document).ready(function() {
        $('.agregar-carrito').click(function() {
            // Obtener el ID del producto desde el atributo "data-producto" del botón
            var idProducto = $(this).data('producto');
            
            // Enviar el ID del producto al archivo agregar_al_carrito.php mediante AJAX
            $.ajax({
                type: 'POST',
                url: '../controllers/carrito_controller.php',
                data: { agregar: idProducto },
                success: function(response) {
                    // Manejar la respuesta si es necesario
                    console.log(response);
                    
                    // Actualizar el número de elementos en el carrito en la burbuja
                    var numProductosEnCarrito = parseInt($('.badge').text()) + 1;
                    $('.badge').text(numProductosEnCarrito);
                }
            });
        });
    });
    </script>
</body>
</html>
