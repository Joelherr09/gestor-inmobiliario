<?php 

if ( !empty($_POST["registro"])){
    if ( empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["email"]) or empty($_POST["clave"]) ){
        echo "<div class='alerta'>Uno de los campos está vacío<div/>";
    }else{

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $clave = md5($_POST['clave']);
        $estado = 1;
        $tipo_usuario = 1;

        $sql = $conexion->query("insert into usuario(nombre,apellido,email,clave, estado, tipo_usuario)values('$nombre','$apellido','$email','$clave','$estado','$tipo_usuario')");
        if($sql==1){
            echo'<div>Usuario registrado<div/>';
        }else{
            echo'<div class="alerta">Error al registrar<div/>';
        }
    };
};

?>