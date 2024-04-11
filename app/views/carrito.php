<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <style>
        .producto {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="productos_controller.php">Volver al Menú de Productos</a></li>
            <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <h1>Carrito de Compras</h1>

    <?php if (empty($productosSeleccionados)): ?>
        <p>No hay productos en el carrito.</p>
    <?php else: ?>
        <h2>Detalles de los Productos Seleccionados</h2>
        <?php foreach ($productosSeleccionados as $producto): ?>
            <div class="producto">
                <p><strong><?php echo $producto["nombre"]; ?></strong> - $<?php echo $producto["precio"]; ?></p>
                <img src="<?php echo $producto["imagen"]; ?>" alt="<?php echo $producto["nombre"]; ?>">
            </div>
        <?php endforeach; ?>

        <div class="total">
            <p>Total de compra: $<?php echo $totalCompra; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
