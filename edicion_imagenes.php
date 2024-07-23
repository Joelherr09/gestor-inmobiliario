<?php
include ("conexion.php");
include("setup.php");

$idPropiedad = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
<title>Edición</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/miestilo.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/mijs.js"></script>
        <script src="js/jquery.Rut.js"></script>
</head>
<body>
<?php

if(isset($idPropiedad)){ ?>
    
    <div>
        <a href="propiedad.php?id=<?php echo $idPropiedad; ?>">Volver a la Propiedad</a>
    </div>

    <div style="display:flex;">
                                    <form action="crud_propiedades.php" method="post" id="frm" name="form" enctype="multipart/form-data" style="border:0.5px solid black;border-radius:10px; padding:4px;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="image">Subir Imagen</label>
                                                <input type="file" id="image" name="image" required style="display:flex;">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 alieartxt">
                                                <?php if (isset($_GET['id'])) { ?>
                                                    <button type="submit" class="btn btn-primary" name="accion" value="Ingresar_Imagen">Ingresar</button>
                                                    <input type="hidden" id="idoc" name="idoc" value="<?php echo $_GET['id']; ?>">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
    
    <?php
    $sql = "SELECT * FROM galeria WHERE idpropiedades = " . intval($_GET['id']);
    $result = mysqli_query(conectar(), $sql);
    // Verifica si la consulta devolvió algún resultado
    if ($result && mysqli_num_rows($result) > 0) {
        // Recorre los resultados
        while ($datos = mysqli_fetch_array($result)) {
            ?>
            <div id="casas">
                <div class="card">
                    <div class="card-header alieartxt">
                        <?php
                        if ($datos['principal'] == 1) {
                            ?>
                            <img src="img/ico/estrella.png" width="30px">
                            <?php
                        } else {
                            ?>
                            <a href="grud_imagenes.php?idp=<?php echo $_GET['id']; ?>&idg=<?php echo $datos['idgaleria']; ?>&tipo=1">
                                <img src="img/ico/estrellano.png" width="30px">
                            </a>
                            <?php
                        }
                        if ($datos['estado'] == 1) {
                            if (!$datos['principal'] == 1) {
                                ?>
                                <a href="grud_imagenes.php?idg=<?php echo $datos['idgaleria']; ?>&tipo=2&idp=<?php echo $_GET['id']; ?>">
                                    <img src="img/ico/activo.png" width="30px">
                                </a>
                                <?php
                            }
                        } else {
                            if (!$datos['principal'] == 1) {
                                ?>
                                <a href="grud_imagenes.php?idg=<?php echo $datos['idgaleria']; ?>&tipo=3&idp=<?php echo $_GET['id']; ?>">
                                    <img src="img/ico/inactivo2.png" width="30px">
                                </a>
                                <?php
                            }
                        }

                        if (!$datos['principal'] == 1) {
                            ?>
                            <a href="grud_imagenes.php?idg=<?php echo $datos['idgaleria']; ?>&tipo=4&idp=<?php echo $_GET['id']; ?>">
                                <img src="img/ico/delete.png" width="30px">
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <img src="img/casas/<?php echo $datos['fotografia']; ?>" width="250px">
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        // Mensaje en caso de que no haya resultados
        echo "<h1>No tiene imagen esta propiedad</h1>";
    }
} else {
    // Mensaje en caso de que $idPropiedad no esté definido
    echo "<h1>No tiene imagen esta propiedad</h1>";
} ?>

</body>
</html>