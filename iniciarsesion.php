<?php
    include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="iniciarsesion.css">

    <link rel="icon" type="image/png" href="favicon.png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

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
                    <a href="#">Ventas</a>
                    <a href="#">Arriendos</a>
                </div>
            </div>

        </nav>
    </header>

    <section class="form-contenedor-login">
        <div class="login">
            <form action="entrar.php" name="form" method="POST" class="form-iniciarsesion">
            
                <h1>INICIAR SESIÓN</h1>

                <?php
                        include("conexion.php");
                ?>

                <input type="email" id="email" name="email"  placeholder="ejemplo@ejemplo.com">
                <input type="password" id="clave" name="clave" minlength="8"  placeholder="Contraseña">
                <input type="submit" id="entrar" name="entrar" value="Entrar">
                <p>Olvidaste tu contraseña?</p>
                <a href="">Recupera tu contraseña</a>
            </form>
        </div>
        
    </section>

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