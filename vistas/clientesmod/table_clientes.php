<?php

require_once "../../class/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT cl.id_clientes,cl.nombre,cl.apellido,cl.cedula,cl.ocupacion,(YEAR(curdate())-YEAR(cl.fecha_nac)),cl.email,c.descripcion,cl.telefono,cl.direccion,cl.altura,cl.peso,cl.imc,cl.estado
FROM tb_clientes cl JOIN tb_ciudades c on cl.tb_ciudades = c.id_ciudades";

$result = mysqli_query($conexion, $sql);

?>


<table class="table table-hover table-condensed table-bordered display" id="tabladinamica">
    <br>
    <thead style="text-align: center; background-color: #73f0a1;">
        <tr>
            <td style="text-align: center;">Id</td>
            <td style="text-align: center;">Nombre</td>
            <td style="text-align: center;">Cedula</td>
            <td style="text-align: center;">Ocupacion</td>
            <td style="text-align: center;">Edad</td>
            <td style="text-align: center;">Email</td>
            <td style="text-align: center;">Ciudad</td>
            <td style="text-align: center;">Telefono</td>
            <td style="text-align: center;">Direccion</td>
            <td style="text-align: center;">Altura</td>
            <td style="text-align: center;">Peso</td>
            <td style="text-align: center;">IMC</td>
            <td style="text-align: center;">Estado</td>
            <td>Editar</td>
            <td>Borrar</td>
        </tr>
    </thead>


    <tbody>


        <?php

        date_default_timezone_set('America/Asuncion');
        $fechaactual = date('Y-m-d');




        while ($ver = mysqli_fetch_row($result)) :

            
            
            ?>

            <tr style="font-size: 13px; ">
                <td style="width: 10px; text-align:center; height:5px;"><?php echo utf8_encode($ver[0]); ?></td>
                <td style="text-align: center;"><?php echo strtoupper($ver[1].' '.$ver[2]); ?></td>
                <td style="text-align: center;"><?php echo strtoupper($ver[3]); ?></td>
                <td style="text-align: center;"><?php echo strtoupper($ver[4]); ?></td>
                <td style="text-align: center;"><?php echo $ver[5]; ?></td>
                <td style="text-align: center;"><?php echo $ver[6]; ?></td>
                <td style="text-align: center;"><?php echo strtoupper($ver[7]); ?></td>
                <td style="text-align: center;"><?php echo $ver[8]; ?></td>
                <td style="text-align: center;"><?php echo $ver[9]; ?></td>
                <td style="text-align: center;"><?php echo $ver[10]; ?></td>
                <td style="text-align: center;"><?php echo $ver[11]; ?></td>
                <td style="text-align: center;"><?php echo $ver[12]; ?></td>
                <td style="text-align: center;"><span class="btn btn-xs btn-success"><?php echo $ver[13]; ?></span></td>


                <td style="width: 10px; text-align:center">
                    <span class="btn btn-primary btn-xs">
                        <span  
                        data-toggle="modal" data-target="#update_cliente" 
                        onclick="agregadato('<?php echo $ver[0] ?>')"> Modificar</span>
                    </span>

                </td>
                <td style="width: 20px; text-align:center">
                    <span class="btn btn-danger btn-xs" >
                        <span onclick="eliminacliente('<?php echo $ver[0] ?>')"> Eliminar</span>
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