<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Font Awesome para íconos -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-container {
            margin-top: 50px;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .login-logo {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-group input {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: none;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #ccc;
        }

        .btn-login {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            border-radius: 10px;
            padding: 15px 0;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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
    <div class="container login-container">
        <div class="text-center">
            <button id="helpButton" class="btn btn-info">Ayuda</button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 login-form">
                <div class="login-header">
                    <img src="public/images/logo.png" alt="Logo de la cafetería" class="login-logo">
                    <h2>Iniciar sesión</h2>
                </div>
                <form action="./app/controllers/Login.php" method="post">
                    <div class="form-group">
                        <input type="email" name="correo" class="form-control" placeholder="Correo electrónico"
                            required>
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="text-center">
                        ¿No tienes una cuenta? <a href="app/views/registro.php">Registrarse</a>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-login btn-block">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="helpModal" class="help-modal">
        <div class="help-modal-content">
            <span class="close">&times;</span>
            <h2>Ayuda</h2>
            <p>Paso 1: Ingrese su correo electrónico registrado en el campo "Correo electrónico".</p>
            <p>Paso 2: Ingrese su contraseña en el campo "Contraseña".</p>
            <p>Paso 3: Haga clic en el botón "Iniciar sesión" para acceder a su cuenta.</p>
            <p>Si no tiene una cuenta, haga clic en "Registrarse" para crear una.</p>
            <p>Para cerrar la ventana de ayuda, haga clic en la "X" o presione la tecla "Esc".</p>
        </div>
    </div>
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