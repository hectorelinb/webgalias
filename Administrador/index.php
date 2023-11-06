<?php
session_start();

$mensaje = "";

if ($_POST && isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
    if ($_POST["usuario"] == "WORLD_INNOVATION" && $_POST['contrasenia'] == "12345") {
        $_SESSION['usuario'] = "ok";
        $_SESSION["nombreUsuario"] = "World Innovation";
        header('location:inicio.php');
    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
} else {
    // Establece el mensaje como vacío si no hay intento de inicio de sesión
    $mensaje = "";
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        body {
            background-color: #cc1b1b;
            color: white;
        }

        .card {
            margin-top: 100px;
        }

        .card-header {
            background-color: #333;
            color: white;
        }

        .btn-primary {
            background-color: #cc1b1b;
            border: none;
        }

        .btn-primary:hover {
            background-color: #990000;
        }

        .logo-img {
            max-width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        LOGIN
                    </div>
                    <header class="d-flex justify-content-center align-items-center">
                        <img src="https://i.postimg.cc/ZRTc0p2v/logo.png" alt="Logo de LAS GALIAS" class="logo-img">
                    </header>
                    <?php if (!empty($mensaje)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php } ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario">
                            <small id="emailHelp" class="form-text text-muted">Ingrese su usuario o email.</small>
                        </div>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" class="form-control" name="contrasenia"
                                placeholder="Ingrese su Contraseña">
                            <small id="#" class="form-text text-muted">Ingrese su contraseña.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">INGRESAR</button>
                    </form>
                    <br>
                    <p class="text-center">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
   
</body>

</html>





