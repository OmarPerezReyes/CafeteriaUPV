<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Productos</title>
    <!-- Agregar la referencia al CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: zoom-in;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav nav-fill">
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
        </ul>
        <ul class="navbar-nav ml-auto">
            <span class="nav-link"><?php echo $_SESSION['nombre']; ?></span>
            <li class="nav-item ml-auto">
                <a class="nav-link" href="../controllers/cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav><div class="container">
    <h1 class="mt-4">Menú de Productos</h1>

    <div class="row">
        <?php foreach ($productos as $producto): ?>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="<?php echo $producto['imagen_url']; ?>" class="card-img-top" alt="<?php echo $producto['nombre_Producto']; ?>" data-toggle="modal" data-target="#imageModal" data-img="<?php echo $producto['imagen_url']; ?>" data-name="<?php echo $producto['nombre_Producto']; ?>" data-price="<?php echo $producto['precio']; ?>" data-size="<?php echo $producto['size']; ?>" data-quantity="<?php echo $producto['cantidad']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $producto['nombre_Producto']; ?></h5>
                    <p class="card-text">Precio: $<?php echo $producto['precio']; ?> MXN</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group mb-0 mr-2">
                            <label for="cantidad">Cantidad:</label>
                            <select class="form-control" id="cantidad">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary agregar-carrito" data-producto="<?php echo $producto['id_producto']; ?>">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- Modal para mostrar la imagen y detalles -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" class="img-fluid mb-3" id="modalImage">
                </div>
                <h5>Precio: <span id="modalPrice"></span> MXN</h5>
                <h5>Tamaño: <span id="modalSize"></span></h5>
                <h5>Cantidad: <span id="modalQuantity"></span></h5>
            </div>
        </div>
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
            var cantidad = $('#cantidad').val();
            
            // Enviar el ID del producto y la cantidad al archivo agregar_al_carrito.php mediante AJAX
            $.ajax({
                type: 'POST',
                url: '../controllers/carrito_controller.php',
                data: { agregar: idProducto, cantidad: cantidad },
                success: function(response) {
                    // Manejar la respuesta si es necesario
                    console.log(response);
                    
                    // Actualizar el número de elementos en el carrito en la burbuja
                    var numProductosEnCarrito = parseInt($('.badge').text()) + parseInt(cantidad);
                    $('.badge').text(numProductosEnCarrito);
                }
            });
        });

        // Manejar el evento de clic en la imagen para mostrarla en el modal
        $('.card-img-top').click(function() {
            var imgSrc = $(this).data('img');
            var name = $(this).data('name');
            var price = $(this).data('price');
            var size = $(this).data('size');
            var quantity = $(this).data('quantity');

            $('#modalImage').attr('src', imgSrc);
            $('#imageModalLabel').text(name);
            $('#modalPrice').text(price);
            $('#modalSize').text(size);
            $('#modalQuantity').text(quantity);
        });
    });
</script>
</body>
<footer class="bg-light text-center text-lg-start mt-4">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Acerca de Nosotros</h5>
                <p>
                El Sistema de Pedido y Recogida en la Cafetería de la Universidad Politécnica de Victoria surge ante el aumento de estudiantes y la creciente demanda que sobrepasa la capacidad del servicio actual.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Enlaces Útiles</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-dark">Inicio</a>
                    </li>
                    <li>
                        <a href="#!" class="text-dark">Productos</a>
                    </li>
                    <li>
                        <a href="#!" class="text-dark">Contacto</a>
                    </li>
                    <li>
                        <a href="#!" class="text-dark">Ayuda</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contacto</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="mailto:info@tienda.com" class="text-dark">2130073@upv.edu.mx</a>
                    </li>
                    <li>
                        <p class="text-dark">Tel: (+52) 834 171 1100</p>
                    </li>
                    <li>
                        <p class="text-dark">Dirección: Av. Nuevas Tecnologías 5902, Parque Científico y Tecnológico de Tamaulipas, 87138 Cdad. Victoria, Tamps.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        &copy; 2024 Nombre de la Tienda
    </div>
</footer>
</html>
