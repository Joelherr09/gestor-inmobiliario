<?php 

if(!empty($_POST["entrar"])){
    if(empty($_POST["email"]) and empty($_POST["clave"])){
        echo "<div class='alerta'>Los campos está vacíos<div/>";
    }else{
        $email = $_POST["email"];
        $clave = $_POST["clave"];

        $sql = $conexion->query("select * from usuario where email='$email' and clave='$clave'");

        $datos = mysqli_fetch_array($sql);
        $cont = mysqli_num_rows($sql);
        

        if($cont!=0){
            session_start();
            $_SESSION['email']=$datos['email'];
            $_SESSION['tipo']=$datos['tipo_usuario'];
            $_SESSION['nombre']=$datos['nombre'];
            $_SESSION['apellido']=$datos['apellido'];
            if($_SESSION['tipo']){
                header("Location:vistaadmin.php");
            }else{
                header("Location:usuarios.php");
            }
            
        }else{
            header("Location:index.html");
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