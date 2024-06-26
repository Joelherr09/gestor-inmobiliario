<?php

session_start();
if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];
        $apellido = $_SESSION['apellido'];
        $tipo = $_SESSION['tipo'];

        switch ($tipo) {
            case 1:
                $tipo = "Administrador";
                break;
            case 2:
                $tipo = "Propietario";
                break;
            case 3:
                $tipo = "Gestor Inmobiliario";
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
                        <div class="columna-navbar">
                            <?php if(isset($_SESSION['email'])) { ?>
                                    <div style="display:flex;flex-direction:column;margin:0 auto; justify-content:center;align-items:center;">
                                        <div style="display:flex; justify-content:space-between;margin:0 auto; align-items:center;">
                                            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
                                                <p style="margin:0;">Bienvenido <strong><?php echo $nombre; ?></strong></p>
                                                <p><?php echo $tipo ?></p>
                                            </div>
                                            <div>
                                                <a href="cerrar.php" class="boton-entrar">Cerrar Sesión</a>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <div style="display:flex;margin:0 auto; justify-content:center;align-items:center;">
                                        <a href="usuarios.php" class="boton-entrar">Perfil</a>
                                        <?php if($_SESSION['tipo'] == 2){ ?>
                                            <a href="gestion-propiedades.php" class="boton-entrar">Gestión Propiedades</a>
                                        <?php } ?>
                                        <?php if($_SESSION['tipo'] == 1){ ?>
                                            <a href="gestion-propiedades.php" class="boton-entrar">Gestión Propiedades</a>
                                            <a href="vistaadmin.php" class="boton-entrar">Gestión Usuarios</a>
                                        <?php } ?>
                                        
                                        <?php }else { ?>
                                                <div class="boton-cuentas">
                                                    <a href="registrarpropietario.php" class="boton-registrarse">Registrarse</a>
                                                    <a href="iniciarsesion.php"class="boton-entrar">Iniciar Sesión</a>
                                                </div>

                                        <?php } ?>

                                    </div>
                        </div>
                    </div>
                    <div class="logo"  style="margin:0 auto;display:flex;justify-content:center;" >
                        <h1 class="logo-letras"><a class="logo-letras" style="margin:0 auto;display:flex;font-weight:700;text-decoration:none;color:black;" href="index.php">COKIMPU CASAS</a></h1>
                    </div>
                </div>

            </nav>
    </header>


    <div>
        <?php  $_SESSION['email'] ?>
    </div>

        <div class="contenedor-lista-usuarios">
            <h1>Bienvenido <span style="color:red;"><?php echo$nombre;echo' '; echo$apellido; ?></span></h1>
            <h2>Rol: <span style="color:red;"> <?php echo$tipo; ?></span></h2>
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
