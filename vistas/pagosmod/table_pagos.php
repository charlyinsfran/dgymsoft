<?php
session_start();
require_once "../../class/conexion.php";

error_reporting(0);

$c = new conectar();
$conexion = $c->conexion();

$sesion = $_SESSION['usuario']; //nombre del usuario logueado
$tipo = $_SESSION['tipousuario'];// tipo de usuario(rol)

$sql = "SELECT pa.nro_pago,CONCAT(cl.nombre, ' ',cl.apellido),p.descripcion,pa.montopagado,pa.fecha_actual,pa.validohasta,m.simbolo 
FROM tb_pagos pa 
join tb_clientes cl ON cl.id_clientes = pa.tb_clientes
join tb_plan p on p.idtb_plan = pa.tb_plan
join tb_moneda m on m.id_moneda = p.id_moneda;";

$result = mysqli_query($conexion, $sql);




if($tipo == "administrador"){ 

?>


<table class="table table-hover table-condensed table-bordered display" id="tabladinamica" style="font-size: 15px;">
    <br>


    <thead style="text-align: center; background-color: #73f0a1;">
        <tr>
            <td style="text-align: center;">Factura Nro</td>
            <td style="text-align: center;">Cliente</td>
            <td style="text-align: center;">Plan</td>
            <td style="text-align: center;">Cuota</td>
            <td style="text-align: center;">Fecha de Pago</td>
            <td style="text-align: center;">Vencimiento</td>



            <td>Operacion</td>
            <td>Print</td>


        </tr>
    </thead>


    <tbody style="font-size: 10px;">


        <?php
        while ($ver = mysqli_fetch_row($result)) :

            $fechavencimientomostrar = date('d-m-Y',strtotime($ver[5]));
            $fechapago = date('d-m-Y',strtotime($ver[4]));

            $fact_db = $ver[0];
            if($fact_db < 10){
                $cadena = "000";
            }else if($fact_db >= 10 && $fact_db < 100){
                $cadena = "00";
            }else if($fact_db >= 100 && $fact_db < 1000){
                $cadena = "0";
            }



            ?>

            <tr style="font-size: 12px; width: 1%; white-space: nowrap; text-align: center;">
                <td><?php echo $cadena.$ver[0]; ?></td>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo strtoupper($ver[2]); ?></td>
                <td><?php echo $ver[6].'. '.number_format($ver[3], 0, ",", "."); ?></td>
                <td><?php echo $fechapago; ?></td>
                <td><?php echo '<b>'.$fechavencimientomostrar.'</b>'; ?>
          </td>

          <?php  ?>

          <td style="width: 10px; text-align:center">
            <span class="btn btn-danger btn-xs" style="border-color: red;">
                <span  
                 
                onclick="anularpago('<?php echo $ver[0] ?>')"> Anular</span>
            </span>

        </td>
        <td style="width: 10px; text-align:center">
            <span class="btn btn-default btn-xs">
                <a href="model_print.php?dato=<?php echo $ver[0];?>"><span data-toggle="modal" data-target="#impresion_modal"> Imprimir Factura</span></a>
            </span>

        </td>

    </tr>


<?php endwhile; ?>
</tbody>


</table>

<?php  } else if($tipo == "caja") {?>

    <table class="table table-hover table-condensed table-bordered display" id="tabladinamica" style="font-size: 15px;">
    <br>


    <thead style="text-align: center; background-color: #73f0a1;">
        <tr>
            <td style="text-align: center;">Factura Nro</td>
            <td style="text-align: center;">Cliente</td>
            <td style="text-align: center;">Plan</td>
            <td style="text-align: center;">Cuota</td>
            <td style="text-align: center;">Fecha de Pago</td>
            <td style="text-align: center;">Vencimiento</td>



            
            <td>Print</td>


        </tr>
    </thead>


    <tbody style="font-size: 10px;">


        <?php
        while ($ver = mysqli_fetch_row($result)) :

            $fechavencimientomostrar = date('d-m-Y',strtotime($ver[5]));
            $fechapago = date('d-m-Y',strtotime($ver[4]));

            $fact_db = $ver[0];
            if($fact_db < 10){
                $cadena = "000";
            }else if($fact_db >= 10 && $fact_db < 100){
                $cadena = "00";
            }else if($fact_db >= 100 && $fact_db < 1000){
                $cadena = "0";
            }



            ?>

            <tr style="font-size: 12px; width: 1%; white-space: nowrap; text-align: center;">
                <td><?php echo $cadena.$ver[0]; ?></td>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo strtoupper($ver[2]); ?></td>
                <td><?php echo $ver[6].'. '.number_format($ver[3], 0, ",", "."); ?></td>
                <td><?php echo $fechapago; ?></td>
                <td><?php echo '<b>'.$fechavencimientomostrar.'</b>'; ?>
          </td>

          <?php  ?>

          
        <td style="width: 10px; text-align:center">
            <span class="btn btn-default btn-xs">
                <a href="model_print.php?dato=<?php echo $ver[0];?>"><span data-toggle="modal" data-target="#impresion_modal"> Imprimir Factura</span></a>
            </span>

        </td>

    </tr>


<?php endwhile; ?>
</tbody>
</table>

<?php  } ?>





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
            searchPlaceholder: "Numero de factura",
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





