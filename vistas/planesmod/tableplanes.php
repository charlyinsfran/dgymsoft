<?php

require_once "../../class/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT tp.idtb_plan,tp.descripcion,m.simbolo,ROUND(tp.costo),tp.cant_clases from tb_plan tp join tb_moneda m on m.id_moneda = tp.id_moneda order by tp.cant_clases ASC";

$result = mysqli_query($conexion, $sql);

?>


<table class="table table-hover table-condensed table-bordered display" id="tabladinamica">
    <br>
    <thead style="text-align: center; background-color: #73f0a1;">
    <tr>
        <td style="text-align: center;">Id</td>
        <td style="text-align: center;">Descripcion</td>
        <td style="text-align: center;">Costo</td>
        <td style="text-align: center;">Dias/Clases</td>
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
            <td style="text-align: center;"><?php echo $ver[2].'. '.number_format($ver[3], 0, ",", ".");?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[4]); ?></td>

            <td style="width: 10px; text-align:center">
                <span class="btn btn-primary btn-xs">
                    <span  
                    data-toggle="modal" data-target="#updateplan" 
                    onclick="agregadato('<?php echo $ver[0] ?>')"> Modificar</span>
                </span>

            </td>
            <td style="width: 20px; text-align:center">
            <span class="btn btn-danger btn-xs" >
                <span onclick="deleteplan('<?php echo $ver[0] ?>')"> Eliminar</span>
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