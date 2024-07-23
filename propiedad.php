<?php
include ("conexion.php");
include ("setup.php");


$idPropiedad = $_GET['id'];

session_start();
if (isset($_SESSION['email'])) {
    $idSesion = $_SESSION['id'];
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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(function () {

            $('.cuadro-casa casa-uno').click(function () {

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
                        <?php if (isset($_SESSION['email'])) { ?>
                            <div
                                style="display:flex;flex-direction:column;margin:0 auto; justify-content:center;align-items:center;">
                                <div style="display:flex; justify-content:space-between;margin:0 auto; align-items:center;">
                                    <div
                                        style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
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
                                <?php if ($_SESSION['tipo'] == 2) { ?>
                                    <a href="gestion-propiedades.php" class="boton-entrar">Gestión Propiedades</a>
                                <?php } ?>
                                <?php if ($_SESSION['tipo'] == 1) { ?>
                                    <a href="gestion-propiedades.php" class="boton-entrar">Gestión Propiedades</a>
                                    <a href="vistaadmin.php" class="boton-entrar">Gestión Usuarios</a>
                                <?php } ?>

                            <?php } else { ?>
                                <div class="boton-cuentas">
                                    <a href="registrarpropietario.php" class="boton-registrarse">Registrarse</a>
                                    <a href="iniciarsesion.php" class="boton-entrar">Iniciar Sesión</a>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="logo" style="margin:0 auto;display:flex;justify-content:center;">
                    <h1 class="logo-letras"><a class="logo-letras"
                            style="margin:0 auto;display:flex;font-weight:700;text-decoration:none;color:black;"
                            href="index.php">COKIMPU CASAS</a></h1>
                </div>
            </div>

        </nav>
    </header>
    <section style="padding-top:10px;">
            <?php

            $sql = "SELECT propiedades.idpropiedades,
            propiedades.titulo,
            propiedades.descripcion,
            propiedades.precio,
            propiedades.estado,
            propiedades.idpropietario,
            propiedades.habitaciones,
            propiedades.baños,
            propiedades.metros_cuadrados,
            galeria.fotografia,
            galeria.principal,
            galeria.estado AS estado1
            FROM
            propiedades
            INNER JOIN galeria ON propiedades.idpropiedades = galeria.idpropiedades
            WHERE
            propiedades.estado = 1 AND
            galeria.principal = 1 AND galeria.estado = 1 AND propiedades.idpropiedades = '$idPropiedad'";
            $result_tipo = mysqli_query(conectar(), $sql);
            while ($datos_tipo = mysqli_fetch_array($result_tipo)) {
                $uf = ($datos_tipo['precio'] / 37);
                $data1 = bcdiv($uf, '1', 1);
                ?>
                <div style="width:90%; margin:0 auto;display:flex;justify-content:center;" id="<?php echo $datos_tipo['idpropiedades']; ?>">
                    <div style="display:flex;gap:10px;">
                        <div style="display:flex;flex-direction:column;">

                            <!--- VISTA PARA EL PROPIETARIO  -->

                            <?php
                            if(isset($idSesion)){

                            
                            if ($datos_tipo["idpropietario"] == $idSesion) { ?>
                                <div>
                                    <a href="edicion_imagenes.php?id=<?php echo $idPropiedad; ?>">Editar Imágenes de Propiedad</a>
                                </div>
                            <?php }} else {
                                } ?>

                            <!--- FIN VISTA PARA EL PROPIETARIO  -->

                            <div style="display:flex;flex-direction:column;align-items:center;">
                                <img src="img/casas/<?php echo $datos_tipo['fotografia']; ?>" alt=""
                                    style="width:50$;max-width:700px;min-width:50%;border-radius:6px;">
                            </div>
                        </div>
                        <div style="border:0.5px solid gray;border-radius:5px; paddign:8px;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;">
                            <h1 style="margin:6px 2px;"><?php echo $datos_tipo['titulo']; ?></h1>
                            <hr>
                            <div>
                                <h4>Descripción:</h4>
                                <p><?php echo $datos_tipo['descripcion']; ?></p>
                            </div>
                            <hr>
                            <h3>$<?php echo $datos_tipo['precio']; ?> CLP</h3>
                            <h3>UF: <?php echo $data1; ?></h3>
                            <div style="display:flex; gap:10px; justify-content:center;align-items:center;">
                                <p style="margin:0;"><img src="img/ico/sofa.png" style="max-width:30px;max-height:30px;" width="30"
                                        height="30" alt="">:<?php echo $datos_tipo['habitaciones']; ?></p>
                                <p style="margin:0;"><img src="img/ico/inodoro.png" style="max-width:30px;max-height:30px;" width="30"
                                        height="30" alt="">:<?php echo $datos_tipo['baños']; ?></p>
                                <p style="margin:0;"><img src="img/ico/cuadrado.png"
                                        style="max-width:30px;width:30px;max-height:30px;height:30px;" width="30" height="30"
                                        alt="">:<?php echo $datos_tipo['metros_cuadrados']; ?></p>
                            </div>
                            <hr>
                            <a href="#"
                                style="text-decoration:none;color:black;background-color:orange;border:0.8px solid black; padding: 4px 10px;margin:auto;width:60%;justify-content:center;text-align:center;border-radius:6px;">Agendar
                                Visita!</a>
                        </div>
                </div>
            </div>
        <?php } ?>

        <div style="width:90%;margin:0 auto; padding-top:20px;">
            <div style="width:100%;display:grid;grid-template-columns: repeat(2, 1fr);gap: 10px;">

                <?php 
                    // Consultar las imágenes de la galería donde idpropiedades coincide y principal es 0
                    $sql_fotos = "SELECT * FROM galeria WHERE idpropiedades = $idPropiedad AND principal = 0 AND estado = 1";
                    $result = mysqli_query(conectar(), $sql_fotos);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while($fotos = mysqli_fetch_array($result)){ ?>
                        <div style="margin:0 auto;">
                                <img src="img/casas/<?php echo $fotos['fotografia']; ?>" alt="" style="max-height:200px;margin:0 auto;border-radius:6px;" >
                        </div>


                    <?php   }
                    }else {
                        // Mensaje en caso de que no haya resultados
                    }
                ?>

            </div>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>