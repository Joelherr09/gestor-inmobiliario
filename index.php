<?php
include("conexion.php");
include("setup.php");

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="favicon.png">

    <title>Cokimpu</title>
    <link rel="stylesheet" href="index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(function () {

            $('.cuadro-casa').click(function () {

                enviar($(this).attr('id'));
            });


        });

        function enviar(id) {
            $.ajax({
                success: function (response) {
                    location.href = 'propiedad.php?id=' + id;

                }
            });
        }
    </script>
</head>
<body style="background-color: #d9cc64;">
    
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

    <section class="hero">
        <div class="hero-info">
            <h1>
                El portal inmobiliario de la IV Región
            </h1>
            <form class="form-hero" action="">
                <select name="select" >
                    <option value="value1" selected>Arrendar</option>
                    <option value="value2">Arendar Diario</option>
                    <option value="value3">Comprar</option>
                  </select>
                  <select name="select">
                    <option value="value1" selected>Departamento</option>
                    <option value="15">Bodega</option>            
                    <option value="7">Casa</option>                  
                    <option value="16">Estacionamiento</option>                  
                    <option value="9">Estudio</option>                  
                    <option value="22">Hotel</option>                  
                    <option value="12">Local Comercial</option>                  
                    <option value="10">Loft</option>                  
                    <option value="21">Lote de Cementerio</option>                  
                    <option value="11">Oficina</option>                  
                    <option value="14">Parcela</option>                  
                    <option value="13">Sitio</option>                  
                    <option value="20">Terreno</option>                  
                    <option value="18">Terreno Agricola</option>                  
                    <option value="19">Terreno Forestal</option>                  
                    <option value="17">Terreno Industrial</option>                  
                  </select>
    
                  <select name="select" >
                    <option value="value1" selected>La Serena</option>
                    <option value="value2">Coquimbo</option>
                    <option value="value3">Ovalle</option>
                  </select>
    
                <input type="submit" class="btn-submit">
            </form>
        </div>

    </section >

    <section class="section-destacados">
        <h1>Propiedades</h1>
        <div style="display:flex;width:96%;margin:0 auto;flex-wrap: wrap;">
            <?php

            $sql_tipo="select * from propiedades where estado=1";
            $result_tipo=mysqli_query(conectar(),$sql_tipo);
            while($datos_tipo=mysqli_fetch_array($result_tipo)){
                $idPropiedad = $datos_tipo['idpropiedades']; 
            ?>            
                <div class="cuadro-casa casa-uno" style="max-width:260px;width:260px;"  id="<?php echo $datos_tipo['idpropiedades']; ?>">  
                <?php

                    $sql_foto="select * from galeria where idpropiedades=$idPropiedad AND principal=1";
                    $result_foto=mysqli_query(conectar(),$sql_foto);
                    while($datos_foto=mysqli_fetch_array($result_foto)){
                    ?>      
                        <img src="img/casas/<?php echo$datos_foto['fotografia'];?>" alt="">
                    <?php } ?>
                    <div class="info-cuadro" style="text-align:center;">
                        <h4 style="border-radius:5px;background-color:red;color:white;border:1px solid black;">$<?php echo$datos_tipo['precio']; ?></h4>
                        <h5><?php echo$datos_tipo['titulo']; ?></h5>
                        <p style="color:#000300;font-size:0.8rem;"><?php echo$datos_tipo['descripcion']; ?></p>
                    </div>
                    <div style="display:flex; gap:5px;padding:10px 2px; justify-content:center;align-items:center;">
                        <p style="margin:0;"><img src="img/ico/sofa.png" style="max-width:30px;max-height:30px;" width="30" height="30" alt="">:<?php echo$datos_tipo['habitaciones'];?></p>
                        <p style="margin:0;"><img src="img/ico/inodoro.png" style="max-width:30px;max-height:30px;" width="30" height="30"  alt="">:<?php echo$datos_tipo['baños'];?></p>
                        <p style="margin:0;"><img src="img/ico/cuadrado.png" style="max-width:30px;width:30px;max-height:30px;height:30px;" width="30" height="30"  alt="">:<?php echo$datos_tipo['metros_cuadrados'];?></p>
                    </div>
                </div>
            <?php } ?>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>