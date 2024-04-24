<?php

session_start();
if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];
        $tipo = $_SESSION['tipo'];

        switch($tipo){
            case 1: $tipo="Administrador";
                break;
            case 2: $tipo="Propietario";
                break;
            case 3: $tipo="Vendedor";
                break;
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="index.css">

</head>
<body>
    <header>
        <nav>
            <div class="links">
                <div class="boton-cuentas">
                    <p>Bienvenido <strong><?php echo$nombre; ?></strong></p>
                    <a href="iniciarsesion.php"class="boton-entrar">Cerrar Sesión</a>
                </div>
                <div class="logo">
                    <h1 class="logo-letras"><a class="logo-letras" href="index.html">COKIMPU CASAS</a></h1>
                </div>
                <div class="links-navbar">
                    
                    <a href="index.html">Ventas</a>
                    <a href="index.html">Arriendos</a>
                </div>
            </div>

        </nav>
    </header>

    <div>

        <div>
            <div>
                <h1><?php echo$nombre; ?></h1>
                <h1><?php echo$tipo; ?></h1>
            </div>
        </div>

        <div class="contenedor-lista-usuarios">
            <div class="cuerpo-tabla">
                <div class="datos">
                    <p class="campo-nombre">Nombre</p>
                    <p class="campo-nombre">Apellido</p>
                    <p>Email</p>
                </div>
            </div>
            <div class="cuerpo-tabla">
                <?php
                    include("conexion.php");
                    $sql = $conexion->query("select * from usuario");
                    while($datos = $sql->fetch_object()){ ?>
                        <div class="datos"> 
                            <p class="campo-nombre"><?php echo$datos->nombre; ?></p>
                            <p class="campo-nombre"><?php echo$datos->apellido; ?></p>
                            <p><?php echo$datos->email; ?></p>
                    </div>
                    <?php } ?>
            </div>
        </div>

    </div>



    


    <footer>
        <h1>COKIMPU</h1>
        <div>
            <a href="">Nosotros</a>
            <a href="">Términos y Condiciones</a>
            <a href="">Políticas de Privacidad</a>
            <a href="">Contacto</a>
        </div>
    </footer>


</body>
</html>
