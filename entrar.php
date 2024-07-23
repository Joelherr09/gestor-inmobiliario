<?php 
include("conexion.php");
include("setup.php");

if(!empty($_POST["entrar"])){
    if(empty($_POST["email"]) and empty($_POST["clave"])){
        echo "<div class='alerta'>Los campos está vacíos<div/>";
    }else{
        $sql="select * from usuario where email='".$_POST['email']."' and clave='".md5($_POST['clave'])."' and estado=1";

        $result=mysqli_query(conectar(),$sql);
        //obtener datos de base de datos
        $datos=mysqli_fetch_array($result);
        
        $cont=mysqli_num_rows($result);

        if($cont!=0){
            session_start();
            $_SESSION['id']=$datos['id'];
            $_SESSION['email']=$datos['email'];
            $_SESSION['tipo']=$datos['tipo_usuario'];
            $_SESSION['nombre']=$datos['nombre'];
            $_SESSION['apellido']=$datos['apellido'];
            if($_SESSION['tipo'] == 1){
                header("Location:vistaadmin.php");
            }else if($_SESSION['tipo'] == 2){
                header("Location:usuarios.php");
            }else if($_SESSION['tipo'] == 3){
                header("Location:usuarios.php");
            }
            
        }else{
            header("Location:index.php");
            }
        }

    /*    if($datos = $sql->fetch_object()){
            header("location:usuarios.php");
        }else{
            echo "<div class='alerta'>Acceso Denegado<div/>";
        }
    }    */
}



?>