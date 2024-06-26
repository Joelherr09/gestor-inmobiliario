<?php
include ("conexion.php");
include("funciones/setup.php");

$idPropiedad = $_GET['id'];

echo$idPropiedad;

?>
<!DOCTYPE html>
<html>
<head>
<title>Edición</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/miestilo.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/mijs.js"></script>
        <script src="js/jquery.Rut.js"></script>
</head>
<body>
<?php

if(isset($idPropiedad)){
    
    $sql="select * from galeria where idpropiedades=".$_GET['id'];
    $result=mysqli_query(conectar(),$sql);
    while($datos=mysqli_fetch_array($result))
    echo"hola";
    {
    ?>
    <div id="casas">
        <div class="card">
        <div class="card-header alieartxt">
    <?php
    if($datos['principal']==1)
    {
        ?>
        <img src="img/ico/estrella.png" width="30px">
    <?php
    }else{
        ?>

        <a href="grud_imagenes.php?idp=<?php echo $_GET['id'];?>&idg=<?php echo $datos['idgaleria'];?>&tipo=1"><img src="img/ico/estrellano.png" width="30px"></a>
    <?php
    }
    if($datos['estado']==1)
    {
        if(!$datos['principal']==1)
        {
        ?>
        <a href="grud_imagenes.php?idg=<?php echo $datos['idgaleria'];?>&tipo=2&idp=<?php echo $_GET['id'];?>"><img src="img/ico/activo.png" width="30px"></a>
    <?php
        }
    }else{
        if(!$datos['principal']==1)
        {
    ?>
        <a href="grud_imagenes.php?idg=<?php echo $datos['idgaleria'];?>&tipo=3&idp=<?php echo $_GET['id'];?>"><img src="img/ico/inactivo2.png" width="30px"></a>
    <?php
        }
    }

    if(!$datos['principal']==1)
    {
    ?>

    <a href="grud_imagenes.php?idg=<?php echo $datos['idgaleria'];?>&tipo=4&idp=<?php echo $_GET['id'];?>"><img src="img/ico/delete.png" width="30px"></a>
    <?php
    }
    ?>
        </div>
        <div class="card-body">
        <img src="img/casas/<?php echo $datos['fotografia'];?>" width="250px">
        </div>
        </div>
    </div>
    <?php
    }
} else { ?>
    <h1>No tiene imagen esta propiedad</h1>
<?php } ?>

</body>
</html>