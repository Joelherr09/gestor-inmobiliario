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
    $sql="INSERT INTO `usuario` (`rut`, `nombre`, `apellido`, `email`, `clave`, `estado`, `tipo_usuario`) VALUES ('".$_POST['frm_rut']."', '".$_POST['frm_nombres']."', '".$_POST['frm_apellidos']."', '".$_POST['frm_usuario']."', '".$_POST['frm_clave2']."', ".$_POST['frm_estado'].", ".$_POST['frm_tipo'].")";
    mysqli_query(conectar(),$sql);
    header("Location:vistaadmin.php");
    exit;
}

function modificar()
{
    $sql="UPDATE `usuario` SET `rut` = '".$_POST['frm_rut']."', `nombre` = '".$_POST['frm_nombres']."', `apellido` = '".$_POST['frm_apellidos']."', `email` = '".$_POST['frm_usuario']."',  `estado` = ".$_POST['frm_estado'].", `tipo_usuario` = ".$_POST['frm_tipo']." WHERE `id` =".$_POST['idoc'];
    mysqli_query(conectar(),$sql);
    header("Location:vistaadmin.php");
    exit;
}

function eliminar()
{
    if($_SESSION['id']!=$_POST['idoc'])
    {
        $sql="DELETE FROM `email` WHERE `email`.`id` =".$_POST['idoc'];
        mysqli_query(conectar(),$sql);
        header("Location:vistaadmin.php");
        exit;
    }else{
        header("Location:vistaadmin.php");
        exit;
    }
}

function cancelar()
{
    header("Location:vistaadmin.php");
}


if(isset($_GET['id']))
{
    if($_GET['estado']==1)
    {
        $sql="UPDATE `usuario` SET `estado` = '0' WHERE `usuarios`.`id` =".$_GET['id'];
    }else{
        $sql="UPDATE `usuario` SET `estado` = '1' WHERE `usuarios`.`id` =".$_GET['id'];
    }
    mysqli_query(conectar(),$sql);
    header("Location:vistaadmin.php");
}




?>