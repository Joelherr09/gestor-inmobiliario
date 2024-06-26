<?php
include("conexion.php");
include("funciones/setup.php");

session_start();

switch($_POST['accion'])
{
    case "Ingresar":ingresar();
        break;
    case "Modificar":modificar();
        break;
    case "Eliminar":eliminar();
        break;
    case "Cancelar":cancelar();
        break;
}

function ingresar()
{
    $sql="INSERT INTO `propiedades` (`titulo`, `descripcion`, `precio`, `estado`, `idsector`, `tipo_propiedad`, `idpropietario`, `habitaciones`, `baños`, `metros_ciadrados`) VALUES ('".$_POST['frm_titulo']."', '".$_POST['frm_descripcion']."', '".$_POST['frm_precio']."', '".$_POST['frm_estado']."', '".$_POST['frm_sector']."', '".$_POST['frm_tipo']."', '".$_SESSION['id']."'), '".$_POST['frm_habitaciones']."', '".$_SESSION['id']."'), '".$_POST['frm_banos']."', '".$_SESSION['id']."'), '".$_POST['frm_mc']."', '".$_SESSION['id']."')";
    mysqli_query(conectar(),$sql);
    header("Location:gestion-propiedades.php");
    exit;
}

function modificar()
{
    $sql="UPDATE `propiedades` SET `titulo` = '".$_POST['frm_titulo']."', `descripcion` = '".$_POST['frm_descripcion']."', `precio` = '".$_POST['frm_precio']."', `estado` = ".$_POST['frm_estado'].", `idsector` = ".$_POST['frm_sector'].", `tipo_propiedad` = ".$_POST['frm_tipo'].", `habitaciones` = ".$_POST['frm_habitaciones'].", `baños` = ".$_POST['frm_banos'].", `metros_cuadrados` = ".$_POST['frm_mc']." WHERE `idpropiedades` =".$_POST['idoc'];
    mysqli_query(conectar(),$sql);
    header("Location:gestion-propiedades.php");
    exit;
}

function eliminar()
{
    if($_SESSION['id']!=$_POST['idoc'])
    {
        $sql="DELETE FROM `propiedades` WHERE `idpropiedades` =".$_POST['idoc'];
        mysqli_query(conectar(),$sql);
        header("Location:gestion-propiedades.php");
        exit;
    }else{
        header("Location:gestion-propiedades.php");
        exit;
    }
}

function cancelar()
{
    header("Location:gestion-propiedades.php");
}


if(isset($_GET['id']))
{
    if($_GET['estado']==1)
    {
        $sql="UPDATE `propiedades` SET `estado` = '0' WHERE `propiedades`.`idpropiedades` =".$_GET['id'];
    }else{
        $sql="UPDATE `propiedades` SET `estado` = '1' WHERE `propiedades`.`idpropiedades` =".$_GET['id'];
    }
    mysqli_query(conectar(),$sql);
    header("Location:gestion-propiedades.php");
}




?>