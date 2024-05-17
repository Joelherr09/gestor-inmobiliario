<?php
include ("conexion.php");
include("funciones/setup.php");

session_start();
if (isset($_SESSION['email'])) {
    $id = $_SESSION['id'];
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

    if (isset($_GET['id'])) {
        $sql_usu = "select * from usuario where id=" . $_GET['id'];
        $result_usu = mysqli_query(conectar(), $sql_usu);
        $datos_usu = mysqli_fetch_array($result_usu);
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
        <script src="js/bootstrap.bundle.min.js"></script>
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


        <div id="caja_menu">
        <div class="card">
            <div class="card-header alieartxt">Administrador de Usuarios</div>
            <div class="card-body">
            <form action="crud_usuarios.php" method="post" id="frm" name="form">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_rut" class="form-label">RUT:</label>
                            <input type="text" class="form-control" id="frm_rut" name="frm_rut" value="<?php if(isset($_GET['id'])){echo $datos_usu['rut'];}?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="lbl_tipo" class="form-label">Estado:</label>
                            <select class="form-select" id="frm_estado" name="frm_estado">
                                <option value="3">Seleccionar</option>
                                <option value="1" <?php if(isset($_GET['id'])){ if($datos_usu['estado']==1){?>selected <?php }} ?>>Activo</option>
                                <option value="0" <?php if(isset($_GET['id'])){ if($datos_usu['estado']==0){?>selected <?php }} ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_nombre" class="form-label">Nombres:</label>
                            <input type="text" class="form-control" id="frm_nombres" name="frm_nombres" value="<?php if(isset($_GET['id'])){echo $datos_usu['nombre'];}?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="lbl_apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="frm_apellidos" name="frm_apellidos" value="<?php if(isset($_GET['id'])){echo $datos_usu['apellido'];}?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_usuario" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="frm_usuario" name="frm_usuario" value="<?php if(isset($_GET['id'])){echo $datos_usu['email'];}?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="lbl_tipo" class="form-label">Tipo de Usuario:</label>
                            <select class="form-select" id="frm_tipo" name="frm_tipo">
                                <option value="0">Seleccionar</option>
                                <?php
                                 
                                 $sql_tipo="select * from tipo_usuario where estado=1";
                                 $result_tipo=mysqli_query(conectar(),$sql_tipo);
                                 while($datos_tipo=mysqli_fetch_array($result_tipo))
                                 {?>
                                        <option value="<?php echo $datos_tipo['id'];?>"<?php if(isset($_GET['id'])){ if($datos_usu['tipo_usuario']==$datos_tipo['id']){?>selected <?php }} ?>><?php echo $datos_tipo['tipo'];?></option>
                                 <?php
                                 }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php

                    if(!isset($_GET['id']))
                    {
                        ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_clave1" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="frm_clave1" name="frm_clave1">
                        </div>
                        <div class="col-sm-6">
                            <label for="lbl_clav2" class="form-label">Repetir Contraseña:</label>
                            <input type="password" class="form-control" id="frm_clave2" name="frm_clave2">
                        </div>
                    </div>
                <?php
                    }
                    ?>
                </div>
            <hr>
            <div class="row">
                    <div class="col-sm-12 alieartxt">
                        <?php
                        if(!isset($_GET['id']))
                        {
                            ?>
                        <button type="button" class="btn btn-primary" name="btn_ingresar" onclick="validar(this.value);" value="Ingresar">Ingresar</button>
                        <?php
                        }else{
                            ?>
                        <button type="button" class="btn btn-success" name="btn_modificar" onclick="validar(this.value);" value="Modificar">Modificar</button>
                        <button type="button" class="btn btn-danger" name="btn_eliminar" onclick="validar(this.value);" value="Eliminar">Eliminar</button>
                        <?php
                        }
                        ?>
                        <button type="button" class="btn btn-secondary" name="btn_cancelar" onclick="validar(this.value);" value="Cancelar">Cancelar</button>
                        <input type="hidden" id="accion" name="accion">
                        <input type="hidden" id="idoc" name="idoc" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <hr>
    <div id="caja_grilla">
        <div class="card">
            <div class="card-header alieartxt">Listado de Usuarios del Sistema</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Tipo Usuario</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $con=0;
                    $sql="select * from usuario";
                    $result=mysqli_query(conectar(),$sql);
                    $cont=mysqli_num_rows($result);
                    while($datos=mysqli_fetch_array($result))
                    {
                ?>
                <tr>
                    <td><?php $con++;echo $con;?></td>
                    <td><?php echo $datos['rut'];?> </td>
                    <td><?php echo $datos['nombre']." ".$datos['apellido'];?> </td>
                    <td><?php echo $datos['email'];?> </td>
                    <td><?php 
                    
                    
                    if($datos['estado']==1)
                    {
                       ?>
                       <img src="img/ico/ok.png" width="24px">
                       <?php     
                    }else{?>
                        <a href="crud_usuarios.php?id=<?php echo $datos['id'];?>&estado=<?php echo $datos['estado'];?>"><img src="img/ico/inactivo.png" width="24px"></a>
                        <?php
                    }
                    ?> 
                    </td>
                    <td class="<?php echo colortxt($datos['tipo_usuario']);?>"><strong><?php echo tipo($datos['tipo_usuario']);?></strong></td>
                    <td> <a href="vistaadmin.php?id=<?php echo $datos['id'];?>"><img src="img/ico/update.png" width="24px"></a> | <?php if ($datos['estado']==1){?><a href="crud_usuarios.php?id=<?php echo $datos['id'];?>&estado=<?php echo $datos['estado'];?>"><img src="img/ico/delete.png" width="24px"></a><?php } ?></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
            </table>
            </div>
            <div class="card-footer">Total de Usuarios (<?php echo $cont;?>) | <img src="img/ico/excel.png" width="24px">Exportar a excel </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {

    header("Location:error.html");

} ?>