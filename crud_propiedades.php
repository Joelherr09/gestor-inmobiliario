<?php
include("conexion.php");
include("setup.php");

session_start();

switch($_POST['accion'])
{
    case "Ingresar":ingresar();
        break;
    case "Ingresar_Imagen":ingresar_imagen();
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
    $conn = conectar();
    $sql="INSERT INTO `propiedades` 
    (`titulo`, `descripcion`, `precio`, `estado`, `idsector`, `tipo_propiedad`, `idpropietario`, `habitaciones`, `baños`, `metros_cuadrados`) 
    VALUES 
    ('".$_POST['frm_titulo']."', 
    '".$_POST['frm_descripcion']."', 
    '".$_POST['frm_precio']."', 
    '".$_POST['frm_estado']."', 
    '".$_POST['frm_sector']."', 
    '".$_POST['frm_tipo']."', 
    '".$_SESSION['id']."', 
    '".$_POST['frm_habitaciones']."', 
    '".$_POST['frm_banos']."', 
    '".$_POST['frm_mc']."')";
    if (mysqli_query($conn, $sql)) {
        // Obtener el último id insertado
        $last_id = mysqli_insert_id($conn);

        $mime_types = ["image/gif", "image/png", "image/jpeg"];
        if (!in_array($_FILES["image"]["type"], $mime_types)) {
            exit("Tipo de Archivo Inválido");
        }

        $pathinfo = pathinfo($_FILES["image"]["name"]);
        $base = $pathinfo["filename"];
        $base = preg_replace("/[^\w-]/", "_", $base);
        $filename = $base . "." . $pathinfo["extension"];
        $destination = __DIR__ . "/img/casas/" . $filename;

        $i = 1;
        while (file_exists($destination)) {
            $filename = $base . "($i)." . $pathinfo["extension"];
            $destination = __DIR__ . "/img/casas/" . $filename;
            $i++;
        }

        $sql_galeria = "INSERT INTO `galeria` (`fotografia`,`principal`,`estado`,`idpropiedades`) 
        VALUES 
        ('".$filename."', 
        '1', 
        '1', 
        '".$last_id."')";
        if (mysqli_query($conn, $sql_galeria)) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
                exit("No se pudo mover el archivo");
            }
        } else {
            exit("Error al insertar en galeria: " . mysqli_error($conn));
        }
    } else {
        exit("Error al insertar en propiedades: " . mysqli_error($conn));
    }



    header("Location:gestion-propiedades.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'Ingresar_Imagen') {
    ingresar_imagen();
}

function ingresar_imagen(){
    $conn = conectar();
    $mime_types = ["image/gif", "image/png", "image/jpeg"];

    if (!in_array($_FILES["image"]["type"], $mime_types)) {
        exit("Tipo de Archivo Inválido");
    }

    $pathinfo = pathinfo($_FILES["image"]["name"]);
    $base = $pathinfo["filename"];
    $base = preg_replace("/[^\w-]/", "_", $base);
    $filename = $base . "." . $pathinfo["extension"];
    $destination = __DIR__ . "/img/casas/" . $filename;

    $i = 1;
    while (file_exists($destination)) {
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = __DIR__ . "/img/casas/" . $filename;
        $i++;
    }

    $idPropiedad = intval($_POST['idoc']); // Utiliza el valor del campo oculto enviado en el formulario

    $sql_galeria = "INSERT INTO `galeria` (`fotografia`, `principal`, `estado`, `idpropiedades`) 
                    VALUES ('$filename', '0', '1', '$idPropiedad')";
    
    if (mysqli_query($conn, $sql_galeria)) {
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
            exit("No se pudo mover el archivo");
        }
    } else {
        exit("Error al insertar en galeria: " . mysqli_error($conn));
    }

    header("Location:propiedad.php?id=" . $idPropiedad);
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