<?php
include("conexion.php");

session_start();

switch($_POST['accion'])
{
    case "Ingresar": ingresar();
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
    $sql="INSERT INTO `usuarios` (`rut`, `nombre`, `apellidos`, `usuario`, `clave`, `estado`, `tipo_usuario`) VALUES ('".$_POST['frm_rut']."', '".$_POST['frm_nombres']."', '".$_POST['frm_apellidos']."', '".$_POST['frm_usuario']."', '".$_POST['frm_clave2']."', ".$_POST['frm_estado'].", ".$_POST['frm_tipo'].")";
    mysqli_query(conectar(),$sql);
    header("Location:frm_usuarios.php");
    exit;
}

function modificar()
{
    $sql="UPDATE `usuarios` SET `rut` = '".$_POST['frm_rut']."', `nombre` = '".$_POST['frm_nombres']."', `apellidos` = '".$_POST['frm_apellidos']."', `usuario` = '".$_POST['frm_usuario']."',  `estado` = ".$_POST['frm_estado'].", `tipo_usuario` = ".$_POST['frm_tipo']." WHERE `usuarios`.`id` =".$_POST['idoc'];
    mysqli_query(conectar(),$sql);
    header("Location:frm_usuarios.php");
    exit;
}

function eliminar()
{
    if($_SESSION['idusu']!=$_POST['idoc'])
    {
        $sql="DELETE FROM `usuarios` WHERE `usuarios`.`id` =".$_POST['idoc'];
        mysqli_query(conectar(),$sql);
        header("Location:frm_usuarios.php");
        exit;
    }else{
        header("Location:frm_usuarios.php");
        exit;
    }
}

function cancelar()
{
    header("Location:frm_usuarios.php");
}


if(isset($_GET['id']))
{
    if($_GET['estado']==1)
    {
        $sql="UPDATE `usuarios` SET `estado` = '0' WHERE `usuarios`.`id` =".$_GET['id'];
    }else{
        $sql="UPDATE `usuarios` SET `estado` = '1' WHERE `usuarios`.`id` =".$_GET['id'];
    }
    mysqli_query(conectar(),$sql);
    header("Location:frm_usuarios.php");
}




?>