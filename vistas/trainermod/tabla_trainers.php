<?php

require_once "../../class/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT entr.id_entrenadores,CONCAT(entr.nombre,' ',entr.apellido) AS trainer,
entr.cedula,entr.formacion,entr.direccion,city.descripcion,entr.edad,ft.ruta_subida FROM tb_entrenadores entr 
join tb_ciudades city on city.id_ciudades = entr.ciudad 
join tb_photos ft on ft.id_photos = entr.id_tbphoto";

$result = mysqli_query($conexion, $sql);

?>


<table class="table table-hover table-condensed table-bordered display" id="tabladinamica">
    <br>
    <thead style="text-align: center; background-color: #73f0a1;">
    <tr>
        <td style="text-align: center;">Id</td>
        <td style="text-align: center;">Nombre</td>
        <td style="text-align: center;">Cedula</td>
        <td style="text-align: center;">Formacion</td>
        <td style="text-align: center;">Direccion</td>
        <td style="text-align: center;">Ciudad</td>
        <td style="text-align: center;">Edad</td>
        <td style="text-align: center;">Photo</td>
        <td>Editar</td>
        <td>Borrar</td>
    </tr>
    </thead>


    <tbody>


    <?php



                
                

    while ($ver = mysqli_fetch_row($result)) :
    ?>

        <tr style="font-size: 13px; ">
            <td style="width: 10px; text-align:center; height:5px;"><?php echo utf8_encode($ver[0]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[1]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[2]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[3]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[4]); ?></td>
            <td style="text-align: center;"><?php echo $ver[5]; ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[6]); ?></td>
            <td>
                <?php 
            $imagen =explode("/",$ver[7]);
            $imagenruta = $imagen[1]."/".$imagen[2]."/".$imagen[3]."/".$imagen[4];
            ?>

             <img width="40" height="40" src="<?php echo $imagenruta?>">

            </td>

            <td style="width: 10px; text-align:center">
                <span class="btn btn-primary btn-xs">
                    <span  
                    data-toggle="modal" data-target="#update_trainer" 
                    onclick="agregadato('<?php echo $ver[0] ?>')"> Modificar</span>
                </span>

            </td>
            <td style="width: 20px; text-align:center">
            <span class="btn btn-danger btn-xs" >
                <span onclick="eliminatrainer('<?php echo $ver[0] ?>')"> Eliminar</span>
            </span>

            </td>
        </tr>


    <?php endwhile; ?>
    </tbody>


</table>


<script type="text/javascript">
    $(document).ready(function(){
   $('#tabladinamica').DataTable({

       "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_  TOTAL: _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "search": "Buscar:",
        searchPlaceholder: "Ingrese cedula y/o nombre",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
            
        });


    });
</script>