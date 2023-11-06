<?php
include("../template/cabecera.php");

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellido = (isset($_POST['txtApellido'])) ? $_POST['txtApellido'] : "";
$txtTelefono = (isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : "";
$txtDireccion = (isset($_POST['txtDireccion'])) ? $_POST['txtDireccion'] : "";
$txtNo_Casa = (isset($_POST['txtNo_Casa'])) ? $_POST['txtNo_Casa'] : "";
$txtMuros = (isset($_POST['txtMuros'])) ? $_POST['txtMuros'] : "";
$txtPisos = (isset($_POST['txtPisos'])) ? $_POST['txtPisos'] : "";
$txtTechos = (isset($_POST['txtTechos'])) ? $_POST['txtTechos'] : "";
$txtHabitaciones = (isset($_POST['txtHabitaciones'])) ? $_POST['txtHabitaciones'] : "";
$txtBanios = (isset($_POST['txtBanios'])) ? $_POST['txtBanios'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO acta (nombre, apellidos, telefono, direccion, No_Casa, muros, pisos, techos, habitaciones, banios, imagen) VALUES (:nombre, :apellidos, :telefono, :direccion, :No_Casa, :muros, :pisos, :techos, :habitaciones, :banios, :imagen)");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':apellidos', $txtApellido);
        $sentenciaSQL->bindParam(':telefono', $txtTelefono);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);
        $sentenciaSQL->bindParam(':No_Casa', $txtNo_Casa);
        $sentenciaSQL->bindParam(':muros', $txtMuros);
        $sentenciaSQL->bindParam(':pisos', $txtPisos);
        $sentenciaSQL->bindParam(':techos', $txtTechos);
        $sentenciaSQL->bindParam(':habitaciones', $txtHabitaciones);
        $sentenciaSQL->bindParam(':banios', $txtBanios);

        if ($txtImagen != "") {
            $fecha = new DateTime();
            $NombreArchivo = $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"];
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            $rutaDestino = "C:/xampp1/htdocs/sitioweb/sitioweb/img/" . $NombreArchivo;
            move_uploaded_file($tmpImagen, $rutaDestino);
            $sentenciaSQL->bindParam(':imagen', $NombreArchivo);
        } else {
            // Establece una imagen predeterminada si no se selecciona ninguna
            $NombreArchivo = "imagen.jpg";
            $sentenciaSQL->bindParam(':imagen', $NombreArchivo);
        }

        $sentenciaSQL->execute();
        break;

    case "Modificar":
        if ($txtImagen != "") {

            $fecha = new DateTime();
            $NombreArchivo = $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"];
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "C:/xampp1/htdocs/sitioweb/sitioweb/img/" . $NombreArchivo);
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM acta WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $acta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            if (isset($acta["imagen"]) && ($acta["imagen"] != "imagen.jpg")) {
                if (file_exists("C:/xampp1/htdocs/sitioweb/sitioweb/img/" . $acta["imagen"])) {
                    unlink("C:/xampp1/htdocs/sitioweb/sitioweb/img/" . $acta["imagen"]);

                }
            }

            $sentenciaSQL->execute();
            $sentenciaSQL = $conexion->prepare("UPDATE acta SET nombre=:nombre, apellidos=:apellidos, telefono=:telefono, direccion=:direccion, No_Casa=:No_Casa, muros=:muros, pisos=:pisos, techos=:techos, habitaciones=:habitaciones, banios=:banios, imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $NombreArchivo);
        } else {
            $sentenciaSQL = $conexion->prepare("UPDATE acta SET nombre=:nombre, apellidos=:apellidos, telefono=:telefono, direccion=:direccion, No_Casa=:No_Casa, muros=:muros, pisos=:pisos, techos=:techos, habitaciones=:habitaciones, banios=:banios WHERE id=:id");
        }

        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':apellidos', $txtApellido);
        $sentenciaSQL->bindParam(':telefono', $txtTelefono);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);
        $sentenciaSQL->bindParam(':No_Casa', $txtNo_Casa);
        $sentenciaSQL->bindParam(':muros', $txtMuros);
        $sentenciaSQL->bindParam(':pisos', $txtPisos);
        $sentenciaSQL->bindParam(':techos', $txtTechos);
        $sentenciaSQL->bindParam(':habitaciones', $txtHabitaciones);
        $sentenciaSQL->bindParam(':banios', $txtBanios);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        break;

    case "Cancelar":
        header ("location:actas.php");
        echo "Presionado botón Cancelar";
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM acta WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $acta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        $txtNombre = $acta['nombre'];
        $txtApellido = $acta['apellidos'];
        $txtTelefono = $acta['telefono'];
        $txtDireccion = $acta['direccion'];
        $txtNo_Casa = $acta['No_Casa'];
        $txtMuros = $acta['muros'];
        $txtPisos = $acta['pisos'];
        $txtTechos = $acta['techos'];
        $txtHabitaciones = $acta['habitaciones'];
        $txtBanios = $acta['banios'];
        $txtImagen = $acta['imagen'];

        break;

    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM acta WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $acta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if (isset($acta["imagen"]) && ($acta["imagen"] != "imagen.jpg")) {
            if (file_exists("C:/xampp1/htdocs/sitioweb/sitioweb/img/" . $acta["imagen"])) {
                unlink("C:/xampp1/htdocs/sitioweb/sitioweb/img/" . $acta["imagen"]);

            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM acta WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM acta");
$sentenciaSQL->execute();
$listaActas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Datos de Actas
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text"required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID"
                        placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtID">Nombre</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>"" name=" txtNombre"
                        id="txtNombre" placeholder="ingrese sus nombres">
                </div>

                <div class="form-group">
                    <label for="txtApellido">Apellido</label>
                    <input type="text" class="form-control" value="<?php echo $txtApellido; ?>"" name=" txtApellido"
                        id="txtApellido" placeholder="ingrese su Apellido">
                </div>

                <div class="form-group">
                    <label for="txtTelefono">Telefono</label>
                    <input type="text" class="form-control" value="<?php echo $txtTelefono; ?>"" name=" txtTelefono"
                        id="txtTelefono" placeholder="ingrese su Telefono">
                </div>

                <div class="form-group">
                    <label for="txtDireccion">Direccion</label>
                    <input type="text" class="form-control" value="<?php echo $txtDireccion; ?>"" name=" txtDireccion"
                        id="txtDireccion" placeholder="ingrese su Direccion">
                </div>

                <div class="form-group">
                    <label for="txtNo_Casa">No_Casa</label>
                    <input type="text" class="form-control" value="<?php echo $txtNo_Casa; ?>"" name=" txtNo_Casa"
                        id="txtNo_Casa" placeholder="Ingrese su No_Casa">
                </div>

                <div class="form-group">
                    <label for="txtMuros_Casa">Muros</label>
                    <input type="text" class="form-control" value="<?php echo $txtMuros; ?>"" name=" txtMuros"
                        id="txtMuros" placeholder="Muros">
                </div>

                <div class="form-group">
                    <label for="txtPisos">Pisos</label>
                    <input type="text" class="form-control" value="<?php echo $txtPisos; ?>"" name=" txtPisos"
                        id="txtPisos" placeholder="Pisos ">
                </div>

                <div class="form-group">
                    <label for="txtTechos">Techos</label>
                    <input type="text" class="form-control" value="<?php echo $txtTechos; ?>"" name=" txtTechos"
                        id="txtTechos" placeholder="Techos">
                </div>

                <div class="form-group">
                    <label for="txtHabitaciones">Habitaciones</label>
                    <input type="text" class="form-control" value="<?php echo $txtHabitaciones; ?>"" name="txtHabitaciones" 
                       id="txtHabitaciones" placeholder="habitaciones">
                </div>

                <div class="form-group">
                    <label for="txtBanios">Baños</label>
                    <input type="text" class="form-control" value="<?php echo $txtBanios; ?>"" name=" txtBanios"
                        id="txtBanios" placeholder="Baños">
                </div>


                <div class="form-group">

                    <label for="txtNombre">Imagen</label>
                    <br>
                    <br>
    

                    <?php
                    if ($txtImagen != "") { ?>
                        <img src="C:/xampp1/htdocs/sitioweb/sitioweb/img/ <?php echo $txtImagen; ?>" width="50" alt=""
                            srcset="">


                    <?php
                    }
                    ?>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen"
                        placeholder="adjunte foto de fachada o hallazgos">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <a href="reportes.php">Reporte pdf</a>
            <table class="table table-bordered" id="tabla">
<thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>No_Casa</th>
                        <th>Muros</th>
                        <th>Pisos</th>
                        <th>Techos</th>
                        <th>Habitaciones</th>
                        <th>Baños</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaActas as $acta) { ?>
                        <tr>
                            <td><?php echo $acta['id']; ?></td>
                            <td><?php echo $acta['nombre']; ?></td>
                            <td><?php echo $acta['apellidos']; ?></td>
                            <td><?php echo $acta['telefono']; ?></td>
                            <td><?php echo $acta['direccion']; ?></td>
                            <td><?php echo $acta['No_Casa']; ?></td>
                            <td><?php echo $acta['muros']; ?></td>
                            <td><?php echo $acta['pisos']; ?></td>
                            <td><?php echo $acta['techos']; ?></td>
                            <td><?php echo $acta['habitaciones']; ?></td>
                            <td><?php echo $acta['banios']; ?></td>
                            <td><img class="img-thumbnail rounded" src="C:/xampp1/htdocs/sitioweb/sitioweb/img/<?php echo $acta['imagen']; ?>" width="10" alt=""></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="txtID" value="<?php echo $acta['id']; ?>">
                                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<?php include("../template/pie.php"); ?>