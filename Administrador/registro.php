<!doctype html>
<html lang="en">

<head>
    <title>Registro</title>
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
                        REGISTRO
                    </div>
                    <header class="d-flex justify-content-center align-items-center">
                        <img src="https://i.postimg.cc/ZRTc0p2v/logo.png" alt="Logo de LAS GALIAS" class="logo-img">
                    </header>
                    <form method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese su Nombre"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Ingrese su Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" class="form-control" name="contrasenia"
                                    placeholder="Ingrese su Contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">REGISTRARSE</button>
                        </div>
                    </form>
                    <br>
                    <p class="text-center">¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
