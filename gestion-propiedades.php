<?php
include ("conexion.php");
include("setup.php");

session_start();
if(isset($_SESSION['email']))    {
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

        if($_SESSION['tipo'] < 3 ){
            if (isset($_GET['id'])) {
                $sql_usu = "select * from propiedades where idpropiedades=" . $_GET['id'];
                $result_usu = mysqli_query(conectar(), $sql_usu);
                $datos_usu = mysqli_fetch_array($result_usu);
            }
            
            
            ?>

            




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="index.css">

    <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/miestilo.css" rel="stylesheet">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="vistaadmin.css">
        <script src="js/bootstrap.bundle.min.js"></script>

        <script>
            function validar(btn) {
                if ((btn != 'Eliminar') || (btn != 'Cancelar')) {
                    if (document.form.frm_titulo.value == "") {
                        alert("Debe ingresar un Título");
                        document.form.frm_titulo.focus();
                        return false;
                    }
                    if (document.form.frm_descripcion.value == "") {
                        alert("Debe ingresar una descripción");
                        document.form.frm_descripcion.focus();
                        return false;
                    }
                    if (document.form.frm_precio.value == 0) {
                        alert("Debe ingresar un precio");
                        document.form.frm_precio.focus();
                        return false;
                    }
                    if (document.form.frm_sector.value == 0) {
                        alert("Debe seleccionar un sector");
                        document.form.frm_sector.focus();
                        return false;
                    }                    
                    if (document.form.frm_estado.value == 3) {
                        alert("Debe seleccionar un estado");
                        document.form.frm_estado.focus();
                        return false;
                    }
                    if (btn == 'Ingresar') {
                        if (document.form.frm_titulo.value == "") {
                            alert("Debe ingresar un Título");
                            document.form.frm_titulo.focus();
                            return false;
                        }
                        if (document.form.frm_descripcion.value == "") {
                            alert("Debe ingresar una descripción");
                            document.form.frm_descripcion.focus();
                            return false;
                        }
                        if (document.form.frm_precio.value == 0) {
                            alert("Debe ingresar un precio");
                            document.form.frm_precio.focus();
                            return false;
                        }
                        if (document.form.frm_sector.value == 0) {
                            alert("Debe seleccionar un sector");
                            document.form.frm_sector.focus();
                            return false;
                        }                    
                        if (document.form.frm_estado.value == 3) {
                            alert("Debe seleccionar un estado");
                            document.form.frm_estado.focus();
                            return false;
                            }
                        }
                    }
                    document.form.accion.value = btn;
                    document.form.submit();   
                }
        </script>


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

    <div id="caja_menu" style="border-radius:10px;">
        <div class="card">
            <div class="card-header alieartxt">Administrador de Propiedades</div>
            <div class="card-body">
            <form action="crud_propiedades.php" method="post" id="frm" name="form" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_nombre" class="form-label">Titulo:</label>
                            <input type="text" class="form-control" id="frm_titulo" name="frm_titulo" value="<?php if(isset($_GET['id'])){echo $datos_usu['titulo'];}?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="lbl_nombre" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" id="frm_descripcion" name="frm_descripcion" value="<?php if(isset($_GET['id'])){echo $datos_usu['descripcion'];}?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_nombre" class="form-label">Precio:</label>
                            <input type="text" class="form-control" id="frm_precio" name="frm_precio" value="<?php if(isset($_GET['id'])){echo $datos_usu['precio'];}?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="lbl_tipo" class="form-label">Sector:</label>
                            <select class="form-select" id="frm_sector" name="frm_sector">
                                <option value="0">Seleccionar</option>
                                <?php
                                 
                                 $sql_tipo="select * from sector";
                                 $result_tipo=mysqli_query(conectar(),$sql_tipo);
                                 while($datos_tipo=mysqli_fetch_array($result_tipo))
                                 {?>
                                        <option value="<?php echo $datos_tipo['idsector'];?>"<?php if(isset($_GET['id'])){ if($datos_usu['idsector']==$datos_tipo['idsector']){?>selected <?php }} ?>><?php echo $datos_tipo['sector'];?></option>
                                 <?php
                                 }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                                <label for="lbl_nombre" class="form-label">Estado:</label>
                                <input type="text" class="form-control" id="frm_estado" name="frm_estado" value="<?php if(isset($_GET['id'])){echo $datos_usu['estado'];}?>">
                        </div>
                        <div class="col-sm-6">
                                <label for="lbl_nombre" class="form-label">Habitaciones:</label>
                                <input type="text" class="form-control" id="frm_habitaciones" name="frm_habitaciones" value="<?php if(isset($_GET['id'])){echo $datos_usu['habitaciones'];}?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                                <label for="lbl_nombre" class="form-label">Baños:</label>
                                <input type="text" class="form-control" id="frm_banos" name="frm_banos" value="<?php if(isset($_GET['id'])){echo $datos_usu['baños'];}?>">
                        </div>
                        <div class="col-sm-6">
                                <label for="lbl_nombre" class="form-label">Metros Cuadrados:</label>
                                <input type="text" class="form-control" id="frm_mc" name="frm_mc" value="<?php if(isset($_GET['id'])){echo $datos_usu['metros_cuadrados'];}?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="lbl_tipo" class="form-label">Tipo Propiedad:</label>
                            <select class="form-select" id="frm_tipo" name="frm_tipo">
                                <option value="0">Seleccionar</option>
                                <?php
                                 
                                 $sql_tipo="select * from tipo_propiedad";
                                 $result_tipo=mysqli_query(conectar(),$sql_tipo);
                                 while($datos_tipo=mysqli_fetch_array($result_tipo))
                                 {?>
                                        <option value="<?php echo $datos_tipo['id'];?>"<?php if(isset($_GET['id'])){ if($datos_usu['tipo_propiedad']==$datos_tipo['id']){?>selected <?php }} ?>><?php echo $datos_tipo['tipo'];?></option>
                                 <?php
                                 }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="image">Image File</label>
                            <input type="file" id="image" name="image">
                        </div>
                        <div class="col-sm-6"></div>
                    </div>

                    
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
    <div id="caja_grilla" style="border-radius:10px;">
        <div class="card">
            <div class="card-header alieartxt">Listado de Usuarios del Sistema</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Sector</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Editar IMG</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    
                    
                    if($_SESSION['tipo'] == 1){
                        $sqlAdmin="select * from propiedades";
                        $con=0;
                        $result=mysqli_query(conectar(),$sqlAdmin);
                        $cont=mysqli_num_rows($result);
                        while($datos=mysqli_fetch_array($result))
                        { ?>
                            <tr>
                                <td><?php $con++;echo $con;?></td>
                                <td  style="max-width:100px;"><?php echo $datos['titulo'];?> </td>
                                <td style="max-width:100px;"><?php echo $datos['descripcion'];?> </td>
                                <td style="max-width:100px;"><?php echo $datos['idsector'];?> </td>
                                <td style="max-width:100px;"><?php if($datos['tipo_propiedad'] == 1){ echo"Casa";}else  if($datos['tipo_propiedad'] == 2){ echo"Terreno";} if($datos['tipo_propiedad'] == 3){ echo"Dpartamento";}?> </td>
                                <td><?php echo $datos['precio'];?> </td>
                                <td>
                                    <a href="edicion_imagenes.php?id=<?php echo $datos['idpropiedades'];?>">
                                        <img src="img/ico/update.png" width="24px">
                                    </a>
                                </td>
                                <td><?php 
                                    if($datos['estado']==1)
                                    {
                                    ?>
                                    <img src="img/ico/ok.png" width="24px">
                                    <?php     
                                    }else{?>
                                        <a href="gestion-propiedades.php?id=<?php echo $datos['idpropiedades'];?>&estado=<?php echo $datos['estado'];?>"><img src="img/ico/inactivo.png" width="24px"></a>
                                        <?php
                                    }
                                    ?> 
                                </td>
                                <td> 
                                    <a href="gestion-propiedades.php?id=<?php echo $datos['estado'];?>">
                                        <img src="img/ico/update.png" width="24px">
                                    </a> 
                                    | 
                                    <?php if ($datos['estado']==1){?>
                                    <a href="gestion-propiedades.php?id=<?php echo $datos['idpropiedades'];?>&estado=<?php echo $datos['estado'];?>">
                                        <img src="img/ico/delete.png" width="24px">
                                </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }
                    }else if($_SESSION['tipo'] == 2){
                        $sqlPropietario="select * from propiedades where idpropietario='$idSesion'";
                        $con=0;
                        $result=mysqli_query(conectar(),$sqlPropietario);
                        $cont=mysqli_num_rows($result);
                        while($datos=mysqli_fetch_array($result))
                        { ?>
                            <tr>
                                <td><?php $con++;echo $con;?></td>
                                <td  style="max-width:100px;"><?php echo $datos['titulo'];?> </td>
                                <td style="max-width:100px;"><?php echo $datos['descripcion'];?> </td>
                                <td style="max-width:100px;"><?php echo $datos['idsector'];?> </td>
                                <td style="max-width:100px;"><?php if($datos['tipo_propiedad'] == 1){ echo"Casa";}else  if($datos['tipo_propiedad'] == 2){ echo"Terreno";} if($datos['tipo_propiedad'] == 3){ echo"Dpartamento";}?> </td>
                                <td><?php echo $datos['precio'];?> </td>
                                <td>
                                    <a href="edicion_imagenes.php?id=<?php echo $datos['idpropiedades'];?>">
                                        <img src="img/ico/update.png" width="24px">
                                    </a>
                                </td>
                                <td><?php 
                                    if($datos['estado']==1)
                                    {
                                    ?>
                                    <img src="img/ico/ok.png" width="24px">
                                    <?php     
                                    }else{?>
                                        <a href="gestion-propiedades.php?id=<?php echo $datos['idpropiedades'];?>&estado=<?php echo $datos['estado'];?>"><img src="img/ico/inactivo.png" width="24px"></a>
                                        <?php
                                    }
                                    ?> 
                                </td>
                                <td> 
                                    <a href="gestion-propiedades.php?id=<?php echo $datos['estado'];?>">
                                        <img src="img/ico/update.png" width="24px">
                                    </a> 
                                    | 
                                    <?php if ($datos['estado']==1){?>
                                    <a href="gestion-propiedades.php?id=<?php echo $datos['idpropiedades'];?>&estado=<?php echo $datos['estado'];?>">
                                        <img src="img/ico/delete.png" width="24px">
                                </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }
                    } ?>
                    <div class="card-footer">Total de Usuarios (<?php echo $cont;?>) | <img src="img/ico/excel.png" width="24px">Exportar a excel </div>
            </tbody>
            </table>
            
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

<?php }

 }else{ ?>

    <div>
        <h1>No puedes estar aquí</h1>
    </div>
<?php } ?>