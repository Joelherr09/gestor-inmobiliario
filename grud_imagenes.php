<?php

include("funciones/setup.php");


if($_GET['tipo']==1)
{
    $sql="UPDATE `bdprueba`.`galeria` SET `principal`=0 WHERE `idpropiedades`=".$_GET['idp'];    
    mysqli_query(conectar(),$sql);

    $sql="UPDATE `bdprueba`.`galeria` SET `principal`=1,`estado`=1 WHERE `idgaleria`=".$_GET['idg'];
    mysqli_query(conectar(),$sql);
    
}


if($_GET['tipo']==2)
{
    $sql="UPDATE `bdprueba`.`galeria` SET `estado`=0 WHERE `idgaleria`=".$_GET['idg'];
    mysqli_query(conectar(),$sql);
}

if($_GET['tipo']==3)
{
    $sql="UPDATE `bdprueba`.`galeria` SET `estado`=1 WHERE `idgaleria`=".$_GET['idg'];
    mysqli_query(conectar(),$sql);
}

if($_GET['tipo']==4)
{
    $sql="select * FROM `galeria` WHERE `galeria`.`idgaleria` =".$_GET['idg'];
    $result=mysqli_query(conectar(),$sql);
    $datos=mysqli_fetch_array($result);

    unlink("img/casas/".$datos['fotografia']);

    $sql1="DELETE FROM `galeria` WHERE `galeria`.`idgaleria` =".$_GET['idg'];
    mysqli_query(conectar(),$sql1);
}

header("Location:edicion_imagenes.php?id=".$_GET['idp']);


?>