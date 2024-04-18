<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="registrarpropietario.css">

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

    <section class="form-contenedor">
        <div class="registro">
            <form action="" method="POST" class="form-iniciarsesion">
                
                <h1>Registrar</h1>

                    <?php
                        include("conexion.php");
                        include("funciones/registrar.php");
                    ?>

                <div>
                    <div class="alinear">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" id="nombre"  placeholder="Nombres">
                    </div>
                    <div class="alinear">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" id="apellido" name="apellido"  placeholder="Apellidos">
                    </div>
                    <div class="alinear">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email"  placeholder="ejemplo@ejemplo.com">
                    </div>
                    <div class="alinear">
                        <label for="clave">Contraseña</label>
                        <input type="password" id="clave" name="clave" minlength="8"  placeholder="Contraseña">
                    </div>
                    <input type="submit" name="registro" value="Entrar">
                </div>

                
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