<?php include("sitioweb/template/cabecera.php"); ?>

<?php 
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM acta");
$sentenciaSQL->execute();
$listaActas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<?php foreach($listaActas as $acta) {?>

    <div class="col-md-3">
    <div class="card" style="background-color: #FF0000; color: #000000;"> <!-- Fondo rojo y texto negro -->
        <img class="card-img-top" src="sitioweb/img/<?php echo $acta['imagen']; ?>" alt="">

        <div class="card-body">
            <h4 class="card-title" style="color: #000000;"><?php echo $acta['nombre']; ?></h4> <!-- Texto negro -->

            <a name="" id="" class="btn btn-primary" href="#" role="button"> VER O IMPRIMIR ACTA </a>
        </div>
    </div>
</div>
<?php } ?>



<?php include("sitioweb/template/pie.php"); ?>