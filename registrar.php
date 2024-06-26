<?php 

if ( !empty($_POST["registro"])){
    if ( empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["email"]) or empty($_POST["clave1"]) or empty($_POST["clave2"]) and ($_POST["clave1"] === $_POST["clave2"]) ){
        echo "<div class='alerta'>Uno de los campos está vacío<div/>";
    }else if($_POST["clave1"] === $_POST["clave2"]){

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $clave = md5($_POST['clave1']);
        $estado = 1;
        $tipo_usuario = $_POST['frm_tipo'];
        $rut = $_POST['frm_rut'];

        $sql = $conexion->query("insert into usuario(nombre,apellido,email,clave, estado, tipo_usuario, rut)values('$nombre','$apellido','$email','$clave','$estado','$tipo_usuario','$rut')");
        if($sql==1){
            echo'<div>Usuario registrado<div/>';
        }else{
            echo'<div class="alerta">Error al registrar<div/>';
        }
    }else{
        echo "<div class='alerta'>Las contraseñas no coinciden!<div/>";
    }
};

?>