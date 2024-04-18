<?php

session_start();
if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
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
                    <a href="registrarpropietario.php" class="boton-registrarse">Registrarse</a>
                    <a href="iniciarsesion.php"class="boton-entrar">Iniciar Sesión</a>
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
        <?php  $_SESSION['email'] ?>
    </div>

    <div class="contenedor-usuarios">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody class="cuerpo-tabla">
            <?php
                include("conexion.php");
                $sql = $conexion->query("select * from usuario");
                while($datos = $sql->fetch_object()){ ?>
                    <tr class="cuerpo-tabla"> 
                        <td><?php echo$datos->nombre; ?></td>
                        <td><?php echo$datos->apellido; ?></td>
                        <td><?php echo$datos->email; ?></td>
                    </tr>
                <?php } ?>
        </tbody>
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
