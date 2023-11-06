<br>
<?php include("template/cabecera.php");?>


<div class="col-md-12">
    <div class="jumbotron" style="background-color: #cc1b1b; color: white;">
        <div class="row">
            <div class="col-md-4">
                <img src="https://i.postimg.cc/zvPdLPzm/FOTO-PERFIL.png" alt="Imagen de perfil" style="width: 100%; max-width: 200px; border-radius: 50%;">
            </div>
            <div class="col-md-8">
                <h1 class="display-3"> BIENVENIDO </h1>
                <h1 class="display-3"><?php echo $NombreUsuario; ?></h1>
                <p class="lead">Vamos a administrar nuestras actas</p>
                <hr class="my-2">
                <p>Maria Alejandra Angel-Hector Niño  - Administradores del sitio  </p>
            </div>
        </div>
        <p class="lead mt-4">
            <a class="btn btn-danger btn-lg" href="seccion/actas.php" role="button">Administrar Actas</a>
        </p>
    </div>
</div>

<?php include("template/pie.php");?>