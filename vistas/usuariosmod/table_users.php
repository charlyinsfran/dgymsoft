<?php

require_once "../../class/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT u.idtb_users,u.nombre,u.apellido,u.email,u.telefono,u.usuario,u.password,r.descripcion
 from tb_users u JOIN tb_rol r on r.idtb_rol = u.tb_roll";

$result = mysqli_query($conexion, $sql);

?>
<br>
<br>
<label style="font-size: 2em; text-align:center">Users List</label>
<p></p>





<table class="table table-hover table-condensed table-bordered" id="tabladinamica">

    
    <thead>
    <tr style="font-weight: bold; background-color: #86e9f8; text-align: center;">
        <td style="text-align: center;">Codigo</td>
        <td>Nombre</td>
        <td>Email</td>
        <td>Telefono</td>
        <td>Usuario</td>
        <td>Tipo de Usuario</td>
        <td>Editar</td>
        <td>Borrar</td>
    </tr>
    </thead>
    <tbody>


    <?php


    while ($ver = mysqli_fetch_row($result)) :

        
    ?>

        <tr style="font-size: 13;">
            <td style="width: 20px; text-align:center"><?php echo $ver[0]; ?></td>
            <td style="text-align: center;"><?php echo $ver[1].' '.$ver[2]; ?></td>
            <td style="text-align: center;"><?php echo $ver[3]; ?></td>
            <td style="text-align: center;"><?php echo $ver[4]; ?></td>
            <td style="text-align: center;"><?php echo $ver[5]; ?></td>
            <td style="text-align: center;"><?php echo strtoupper($ver[7]); ?></td>
            

            <td style="width: 20px; text-align:center">
                <span class="btn btn-primary btn-xs">
                    <span data-toggle="modal" data-target="#update_usuario" 
                    onclick="agregadato('<?php echo $ver[0] ?>')">Modificar</span>
                </span>

            </td>
            <td style="width: 20px; text-align:center">
            <span class="btn btn-danger btn-xs">
                <span  onclick="eliminausuario('<?php echo $ver[0] ?>')">Eliminar</span>
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
        searchPlaceholder: "Buscar por codigo o nombre",
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