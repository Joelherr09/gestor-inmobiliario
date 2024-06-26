<?php
include ("conexion.php");
include("funciones/setup.php");

?>


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

    <script>
        function validar(btn){
            if (document.form.frm_rut.value == "") {
                        alert("Debe Ingresar el RUT");
                        document.form.frm_rut.focus();
                        return false;
                    } else {
                        if (!Fn.validaRut(document.form.frm_rut.value)) {
                            alert("RUT PNK");
                            document.form.frm_rut.focus();
                            return false;
                        }
                    }
                document.form.accion.value = btn;
                document.form.submit();
        }
        var Fn = {
            // Valida el rut con su cadena completa "XXXXXXXX-X"
            validaRut: function (rutCompleto) {
                if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
                    return false;
                var tmp = rutCompleto.split('-');
                var digv = tmp[1];
                var rut = tmp[0];
                if (digv == 'K') digv = 'k';
                return (Fn.dv(rut) == digv);
            },
            dv: function (T) {
                var M = 0, S = 1;
                for (; T; T = Math.floor(T / 10))
                    S = (S + T % 10 * (9 - M++ % 6)) % 11;
                return S ? S - 1 : 'k';
            }
        }
    </script>


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
            <form action="" method="POST" id="frm" class="form-iniciarsesion">
                
                <h1>Registrar</h1>

                    <?php
                        include("conexion.php");
                        include("registrar.php");
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
                        <input type="password" id="clave1" name="clave1" minlength="8"  placeholder="Contraseña">
                    </div>
                    <div class="alinear">
                        <label for="clave">Repite Contraseña</label>
                        <input type="password" id="clave2" name="clave2" minlength="8"  placeholder="Contraseña">
                    </div>
                    <div class="alinear">
                            <label for="lbl_tipo" class="form-label">Tipo de Usuario:</label>
                            <select class="form-select" id="frm_tipo" name="frm_tipo">
                                <option value="0">Seleccionar</option>
                                <?php
                                 
                                 $sql_tipo="select * from tipo_usuario where estado=1 and id>1";
                                 $result_tipo=mysqli_query(conectar(),$sql_tipo);
                                 while($datos_tipo=mysqli_fetch_array($result_tipo))
                                 {?>
                                        <option value="<?php echo $datos_tipo['id'];?>"<?php if(isset($_GET['id'])){ if($datos_usu['tipo_usuario']==$datos_tipo['id']){?>selected <?php }} ?>><?php echo $datos_tipo['tipo'];?></option>
                                 <?php
                                 }
                                ?>
                            </select>
                    </div>
                    <div class="alinear">
                            <label for="lbl_rut" class="form-label">RUT:</label>
                            <input type="text" class="form-control" id="frm_rut" minlength="8" placeholder="XXXXXXXX-X" name="frm_rut" >
                    </div>
                    <input onclick="validar(this.value);" type="submit" name="registro" value="Entrar">
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