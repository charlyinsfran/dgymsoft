<?php

require_once "../../class/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT id_rutina,descripcion,calentamiento,tiempo,
                                ejercicio1,repeticiones1,ejercicio2,repeticiones2,
                                ejercicio3,repeticiones3,descanso from tb_rutina";

$result = mysqli_query($conexion, $sql);

?>


<table class="table table-hover table-condensed table-bordered display" id="tabladinamica">
    <br>
    <thead style="text-align: center; background-color: #73f0a1;">
    <tr>
        <td style="text-align: center;">Id</td>
        <td style="text-align: center;">Descripcion</td>
        <td style="text-align: center;">Calentamiento</td>
        <td style="text-align: center;">Serie 1</td>
        <td style="text-align: center;">Descanso</td>
        <td style="text-align: center;">Serie 2</td>
        <td style="text-align: center;">Descanso</td>
        <td style="text-align: center;">Serie 3</td>
        <td>Editar</td>
        <td>Borrar</td>
    </tr>
    </thead>


    <tbody>


    <?php
    while ($ver = mysqli_fetch_row($result)) :
    ?>

        <tr style="font-size: 12px; width: 1%; white-space: nowrap; text-align: center;">
            <td><?php echo utf8_encode($ver[0]); ?></td>
            <td><?php echo strtoupper($ver[1]); ?></td>
            <td><?php echo '<b>'.strtoupper($ver[2]).'</b>'.'<br>'.$ver[3]; ?></td>
            <td><?php echo '<b>'.strtoupper($ver[4]).'</b>'.'<br>'.$ver[5]; ?></td>
            <td><?php echo strtoupper($ver[10]); ?></td>
            <td><?php echo '<b>'.strtoupper($ver[6]).'</b>'.'<br>'.$ver[7]; ?></td>
            <td><?php echo strtoupper($ver[10]); ?></td>
            <td><?php echo '<b>'.strtoupper($ver[8]).'</b>'.'<br>'.$ver[9]; ?></td>
            <td style="width: 10px; text-align:center">
                <span class="btn btn-primary btn-xs">
                    <span  
                    data-toggle="modal" data-target="#update_routine" 
                    onclick="agregadato('<?php echo $ver[0] ?>')"> Modificar</span>
                </span>

            </td>
            <td style="width: 20px; text-align:center">
            <span class="btn btn-danger btn-xs" >
                <span onclick="deleterutina('<?php echo $ver[0] ?>')"> Eliminar</span>
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
        searchPlaceholder: "codigo",
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