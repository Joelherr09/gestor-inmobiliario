<?php

function conectar(){
    $con=mysqli_connect("localhost","root","","bdprueba");
    return $con;
}

function tipo($t)
    {
        switch($t){
            case 1: $tipo="Administrador";
                break;
            case 2: $tipo="Propietario";
                break;
            case 3: $tipo="Gestor Inmobiliario";
                break;
        }

        return $tipo;
    }

    function colortxt($t)
    {
        switch($t){
            case 1: $color="text-danger";
                break;
            case 2: $color="text-primary";
                break;
            case 3: $color="text-success";
                break;
        }
        return $color;
    }

?>