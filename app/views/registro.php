<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>


    <form action="../controllers/registro_controller.php" method="post">
        <label for="matricula">Matrícula:</label><br>
        <input type="text" id="matricula" name="matricula" required><br><br>

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <button type="submit" name="registro">Registrar</button>
    </form>
</body>
</html>
