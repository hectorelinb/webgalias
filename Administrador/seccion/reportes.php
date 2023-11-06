
<?php
session_start();
if (!isset($_SESSION['usuario'])){
    header('location:../index.php');
}
else{
if ($_SESSION['usuario']=="ok"){
    $NombreUsuario=$_SESSION["nombreUsuario"];

}

}

ob_start();

?>
<?php

include("../config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM acta");
$sentenciaSQL->execute();
$listaActas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Información de Actas</title>
    <style>
        body {
            background-color: white;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* Elimina la propiedad background-color: black; */
        }

        th, td {
            border: 1px solid black; /* Cambia el color del borde a negro para que sea visible */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #555;
            color: white; /* Cambia el color del texto del encabezado a blanco */
        }

        .img-thumbnail {
            max-width: 100px;
            height: auto;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="container">
        <h1>Reporte de Actas</h1>
        <div class="text-right">
        <img src="#" alt="Imagen" class="img-thumbnail">
        </div>
        <div class="col-md-7">
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
                            <td><img class="img-thumbnail rounded" src="hhtp://<?php echo $_SERVER['HTTP_HOST'] ; ?>/SITIOWEB/sitioweb/img/<?php echo $acta['imagen']; ?> alt=""></td>
                            
                           
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php
$html=ob_get_clean();
//echo $html;

require_once'../libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf=new Dompdf();
$options = $dompdf->getOptions();
$options->set( array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
//$dompdf->setPaper('letter');
$dompdf->setPaper('A4','landscape');
$dompdf->render();
$dompdf->stream('archivo_.pdf',array("Attachment"=>false));//true se descarga automaticamente y false se abre en el navegador



?>