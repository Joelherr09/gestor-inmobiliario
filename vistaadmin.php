<?php
include ("conexion.php");


session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $nombre = $_SESSION['nombre'];
    $tipo = $_SESSION['tipo'];

    switch ($tipo) {
        case 1:
            $tipo = "Administrador";
            break;
        case 2:
            $tipo = "Propietario";
            break;
        case 3:
            $tipo = "Vendedor";
            break;
    }    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/miestilo.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="vistaadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <script>
        function validar(btn) {
            if ((btn != 'Eliminar') || (btn != 'Cancelar')) {
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
                if (document.form.frm_estado.value == 3) {
                    alert("Debe seleccionar un estado");
                    document.form.frm_estado.focus();
                    return false;
                }
                if (document.form.frm_nombres.value == "") {
                    alert("Debe ingresar los nombres");
                    document.form.frm_nombres.focus();
                    return false;
                }
                if (document.form.frm_apellidos.value == "") {
                    alert("Debe ingresar los apellidos");
                    document.form.frm_apellidos.focus();
                    return false;
                }

                if (document.form.frm_usuario.value == "") {
                    alert("Debe ingresar el usuario");
                    document.form.frm_usuario.focus();
                    return false;
                } else {
                    if (!validateEmail()) {
                        alert("USUARIO PNK");
                        document.form.frm_usuario.focus();
                        return false;
                    }
                }
                if (document.form.frm_tipo.value == 0) {
                    alert("Debe seleccionar un tipo");
                    document.form.frm_tipo.focus();
                    return false;
                }

                if (btn == 'Ingresar') {
                    if (document.form.frm_clave1.value == "") {
                        alert("Debe Ingresar la Clave");
                        document.form.frm_clave1.focus();
                        return false;
                    }
                    if (document.form.frm_clave2.value == "") {
                        alert("Debe ingresar la Repetición de la Clave");
                        document.form.frm_clave2.focus();
                        return false;
                    }

                    if (document.form.frm_clave1.value != document.form.frm_clave2.value) {
                        alert("Las Claves son Penkas");
                        document.form.frm_clave1.value = "";
                        document.form.frm_clave2.value = "";
                        document.form.frm_clave1.focus();
                        return false;
                    }
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

        function validateEmail() {
            var emailField = document.getElementById('frm_usuario');
            var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            if (validEmail.test(emailField.value)) {
                return true;
            } else {
                return false;
            }
        } 
    </script>

</head>

<body>
    <header>
        <nav>
            <div class="links">
                <div class="boton-cuentas">
                    <div class="columna-navbar" style="display:flex;flex-direction:column;">
                        <p style="margin:0;">Bienvenido <strong><?php echo $nombre; ?></strong></p>
                        <p><?php echo $tipo ?></p>
                    </div>
                    <a href="cerrar.php" class="boton-entrar">Cerrar Sesión</a>
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


    <hr>



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
<?php
}else{

header("Location:error.html");

}?>