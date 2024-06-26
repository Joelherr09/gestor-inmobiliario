<?php

include("funciones/setup.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/miestilo.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/mijs.js"></script>
        <script src="js/jquery.Rut.js"></script>
        <script>
            $(function() {
                $("#region").on("change", function() {
                    $.ajax({
                            type: "POST",
                            url: 'cargarcombobox.php',
                            data: 'id='+$("#region").val()+"&tipo=1",
                            success: function(response)
                            {
                                $("#provincia").html(response);
                            }
                    });
                });
                $("#provincia").on("change", function() {
                    $.ajax({
                            type: "POST",
                            url: 'cargarcombobox.php',
                            data: 'id='+$("#provincia").val()+"&tipo=2",
                            success: function(response)
                            {
                                $("#comuna").html(response);
                            }
                    });
                });

                $("#comuna").on("change", function() {
                    $.ajax({
                            type: "POST",
                            url: 'cargarcombobox.php',
                            data: 'id='+$("#comuna").val()+"&tipo=3",
                            success: function(response)
                            {
                                $("#sector").html(response);
                            }
                    });
                });
            });
        </script>

</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
        <label for="email" class="form-label">Seleccione la Región:</label>
        <select class="form-select" id="region">
            <option value="0">Seleccionar</option>
            <?php
              $sql="select * from regiones where estado=1";
              $result=mysqli_query(conectar(),$sql);
              while($datos=mysqli_fetch_array($result))
              {?>
                    <option value="<?php echo $datos['idregiones'];?>"><?php echo $datos['region'];?></option>
              <?php 
              }
              ?>
        </select>
    </div>
    <div class="col-sm-2">
        <label for="email" class="form-label">Seleccione La Provincia:</label>
        <select class="form-select" id="provincia">
            <option value="0">Seleccionar</option>
        </select>
    </div>
    <div class="col-sm-2">
        <label for="email" class="form-label">Seleccione La Comuna:</label>
        <select class="form-select" id="comuna">
            <option value="0">Seleccionar</option>
        </select>
    </div>
    <div class="col-sm-2">
        <label for="email" class="form-label">Seleccione el Sector:</label>
        <select class="form-select" id="sector">
            <option value="0">Seleccionar</option>
        </select>
    </div>
    <div class="col-sm-2">
        <label for="email" class="form-label">Seleccione el Tipo:</label>
        <select class="form-select">
            <option value="0">Mostrar Todo</option>
            <option value="1">Terreno</option>
            <option value="2">Casas</option>
            <option value="3">Departamento</option>
        </select>
    </div>
  </div>
</div>
<hr>
<?php

$sql="SELECT
propiedades.titulo,
propiedades.precio,
propiedades.estado,
galeria.fotografia,
galeria.principal,
galeria.estado AS estado1
FROM
propiedades
INNER JOIN galeria ON propiedades.idpropiedades = galeria.idpropiedades
WHERE
propiedades.estado = 1 AND
galeria.principal = 1 AND galeria.estado = 1";

$result=mysqli_query(conectar(),$sql);
while($datos=mysqli_fetch_array($result))
{
?>
<div id="casas">
    <div class="card">
    <div class="card-header alieartxt"><?php echo $datos['titulo'];?></div>
    <div class="card-body">
        <img src="img/casas/<?php echo $datos['fotografia'];?>" width="250px"><br>
       <h3 class="alieartxt">$<?php echo number_format($datos['precio'], 0, ',', '.');?></h3>
    </div>
    </div>
</div>
<?php
}
?>

</body>
</html>