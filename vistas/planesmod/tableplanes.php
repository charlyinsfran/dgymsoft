<?php

require_once "../../class/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT tp.idtb_plan,tp.descripcion,CONCAT(m.simbolo, '. ',tp.costo) as costo,tp.cant_clases from tb_plan tp join tb_moneda m on m.id_moneda = tp.id_moneda";

$result = mysqli_query($conexion, $sql);

?>

<table class="table table-hover table-condensed table-bordered" id="tabladinamica">
    
    <thead>
    <tr style=" background-color: #86e9f8; text-align: center;">
        <td>Id</td>
        <td>Descripcion</td>
        <td>Costo</td>
        <td>Dias/Clases</td>
        <td>Editar</td>
        <td>Borrar</td>
    </tr>
    </thead>
    <tbody>


    <?php


    while ($ver = mysqli_fetch_row($result)) :
    ?>

        <tr style="font-size: 15px; ">
            <td style="width: 10px; text-align:center; height:5px;"><?php echo utf8_encode($ver[0]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[1]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[2]); ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[3]); ?></td>

            <td style="width: 10px; text-align:center">
                <span class="btn btn-warning btn-sm">
                    <span class="glyphicon glyphicon-pencil" 
                    data-toggle="modal" data-target="#actualizaCategorias" 
                    onclick="agregaDato('<?php echo $ver[0] ?>','<?php echo utf8_encode($ver[1]) ?>')"></span>
                </span>

            </td>
            <td style="width: 20px; text-align:center">
            <span class="btn btn-danger btn-sm">
                <span class="glyphicon glyphicon-remove" onclick="eliminaCategoria('<?php echo $ver[0] ?>')"></span>
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
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "search": "Buscar:",
        searchPlaceholder: "codigo/plan",
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