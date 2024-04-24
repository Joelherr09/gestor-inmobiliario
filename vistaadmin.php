<?php
include("funciones/setup.php");

session_start();
if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];
        $tipo = $_SESSION['tipo'];

        switch($tipo){
            case 1: $tipo="Administrador";
                break;
            case 2: $tipo="Propietario";
                break;
            case 3: $tipo="Vendedor";
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
    <link rel="stylesheet" href="vistaadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <script>
            function validar(btn){
               document.form.accion.value=btn;
               document.form.submit();
            }
    </script>

</head>
<body>
    <header>
        <nav>
            <div class="links">
                <div class="boton-cuentas">
                    <p>Bienvenido <strong><?php echo$nombre; ?></strong></p>
                    <a href="cerrar.php"class="boton-entrar">Cerrar Sesión</a>
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


    <div id="caja_grilla">
        <div class="card">
            <div class="card-header alieartxt">Listado de Usuarios del Sistema</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Tipo Usuario</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include("conexion.php");
                    $con=0;
                    $sql = $conexion->query("select * from usuario");
                    $cont=mysqli_num_rows($sql);
                    while($datos = $sql->fetch_object())
                    {
                ?>
                <tr>
                    <td><?php $con++;echo $con;?></td>
                    <td><?php echo$datos->nombre;?> </td>
                    <td><?php echo$datos->email;?> </td>
                    <td><?php 
                    
                    
                    if($datos->estado==1)
                    {
                       ?>
                       <img src="img/ico/ok.png" width="24px">
                       <?php     
                    }else{?>
                        <a href="crud_usuarios.php?id=<?php echo $datos->id;?>&estado=<?php echo $datos->estado;?>"><img src="img/ico/inactivo.png" width="24px"></a>
                        <?php
                    }
                    ?> 
                    </td>
                    <td class="<?php  echo colortxt($datos->tipo_usuario);?>"><strong><?php echo tipo($datos->tipo_usuario);?></strong></td>
                    <td> <img src="img/ico/update.png" width="24px"> | <?php if ($datos->estado==1){?><a href="crud_usuarios.php?id=<?php echo $datos->id;?>&estado=<?php echo $datos->estado;?>"><img src="img/ico/delete.png" width="24px"></a><?php } ?></td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
