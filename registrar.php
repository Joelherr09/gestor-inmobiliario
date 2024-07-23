<?php 
include("conexion.php");
include("setup.php");


switch($_POST['accion'])
{
    case "Ingresar":ingresar();
        break;
}

function ingresar()
{
    $sql="INSERT INTO `usuario` (`rut`, `nombre`, `apellido`, `email`, `clave`, `estado`, `tipo_usuario`) VALUES ('".$_POST['frm_rut']."', '".$_POST['frm_nombres']."', '".$_POST['frm_apellidos']."', '".$_POST['frm_usuario']."', '".md5($_POST['frm_clave2'])."', 0, ".$_POST['frm_tipo'].")";
    
    mysqli_query(conectar(),$sql);


    header("Location:index.php");
    exit;
}

?>