<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Productos</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="carrito.php">Carrito</a></li>
            <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <h1>Menú de Productos</h1>

    <div class="productos">
        <?php foreach ($productos as $producto): ?>
            <form action="agregar_al_carrito.php" method="post">
                <button type="submit" name="agregar" value="<?php echo $producto['id']; ?>">
                    <?php echo $producto['nombre']; ?> - $<?php echo $producto['precio']; ?>
                </button>
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>
