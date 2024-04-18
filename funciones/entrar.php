<?php 

if(!empty($_POST["entrar"])){
    if(empty($_POST["email"]) and empty($_POST["clave"])){
        echo "<div class='alerta'>Los campos está vacíos<div/>";
    }else{
        $email = $_POST["email"];
        $clave = $_POST["clave"];

        $sql = $conexion->query("select * from usuario where email='$email' and clave='$clave'");

        if($datos = $sql->fetch_object()){
            header("location:usuarios.php");
        }else{
            echo "<div class='alerta'>Acceso Denegado<div/>";
        }
    }    
}



?>