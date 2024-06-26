
<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../pictures/iconos/trainer.png">
    <link rel="stylesheet" href="../libraries/css/stylesfiletype.css">
    <title>Entrenadores</title>
    <?php 
    require_once "menu.php";

    require_once "../class/conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();

    $valor = 0;
    $ide = 0;

    $consulta = "SELECT MAX(id_entrenadores) from tb_entrenadores";
    $con_result = mysqli_query($conexion,$consulta);


    $sql = "SELECT c.id_ciudades,c.descripcion,d.descripcion 
    from tb_ciudades c join tb_departamentos d 
    on d.id_departamentos = c.tb_departamentos_id_departamentos order by c.descripcion";

    $result = mysqli_query($conexion, $sql);
    $result2 = mysqli_query($conexion, $sql);

    ?>

    <style>
       .boton { display: inline-block;
        outline: 0;
        border: none;
        cursor: pointer;
        line-height: 1.0rem;
        font-weight: 900;
        background: #007a5a;
        padding: 12px 14px 9px;
        font-size: 12px;
        border-radius: 6px;
        color: #fff;
        height: 36px;
        transition: all 75ms ease-in-out;
        :hover{
            box-shadow: 0 1px 4px rgb(0 0 0 / 50%);
        }
    }
</style>
</head>
<br>
<br>
<body>
    <div class="col-sm-1">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>

    <div class="col-sm-10">
        <h3 style="text-align: center;">Entrenadores</h3>

        <span class="boton btn btn-primary" data-toggle="modal" data-target="#new_trainer">Nuevo</span>
        <div id="tabletrainerload" style="align-content:left;">

        </div>

    </div>

    <!-- MODAL PARA AGREGAR NUEVO PLAN	-->

    <div class="modal fade" id="new_trainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document" style="width: 400px; ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Entrenador</h4>
                </div>
                <div class="modal-body">


                    <form id="frm_trainers" enctype="multipart/form-data">

                        <?php while ($v = mysqli_fetch_row($con_result)) : 
                            $valor = $v[0];

                        endwhile;

                        if($valor>0 && $valor!= "null"){
                            $ide = $valor + 1;
                        }
                        else {
                            $ide = 100;
                        } 

                        ?>

                        <input type="text" name="id" value="<?php echo $ide;?>" hidden >
                        <label>Nombre</label>
                        <div class="input-group">
                            <input name="nombre" id="nombre" type="text" required class="form-control inp" placeholder="Nombre">
                            <span class="input-group-addon"></span>
                            <input name="apellido" id="apellido" type="text"  class="form-control" placeholder="Apellido">
                        </div>


                        <label>Cedula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" style="width: 150px;">
                        <label>Formacion</label>
                        <input type="text" class="form-control" id="formacion" name="formacion" style="width: 180px;">
                        <label>Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                        <label>Ciudad</label>
                        <p></p>
                        <select class="form-control input-sm" name="ciudad" id="ciudad" style="width: 190px;" required>
                            <option value="A">Seleccione ciudad:</option>
                            <?php while ($view = mysqli_fetch_row($result)) : ?>
                                <option value="<?php echo $view[0] ?>"><?php echo $view[1] . ' (' . $view[2]. ')'; ?></option>

                            <?php endwhile; ?>
                        </select>
                        <p></p>
                        <label>Edad</label>
                        <input type="text" class="form-control" id="edad" name="edad" style="width: 80px;">
                        <label>Photo</label>
                        <input type="file" id="imagen" name="imagen" class="input-file archivo" value="">

                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAddTrainer" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    <a href="trainers.php"> <span class="btn btn-danger">Cancelar</span></a>

                </div>
            </div>
        </div>
    </div>

        <!-- *************************************************************************
**************************************************************************
********************************
MODAL PARA ACTUALIZAR CATEGORIAS                                     -->

<div class="modal fade" id="update_trainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="width: 400px; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Entrenador</h4>
            </div>
            <div class="modal-body">
                <form id="frm_trainers_update">
                    <input type="text" name="idtrainer" id="idtrainer" hidden>
                    <label>Nombre</label>
                    <div class="input-group">
                        <input name="nombre_update" id="nombre_update" type="text" required class="form-control inp" placeholder="Nombre">
                        <span class="input-group-addon"></span>
                        <input name="apellido_update" id="apellido_update" type="text"  class="form-control" placeholder="Apellido">
                    </div>
                    <label>Cedula</label>
                    <input type="text" class="form-control" id="cedula_update" name="cedula_update" style="width: 150px;">
                    <label>Formacion</label>
                    <input type="text" class="form-control" id="formacion_update" name="formacion_update" style="width: 180px;">
                    <label>Direccion</label>
                    <input type="text" class="form-control" id="direccion_update" name="direccion_update">
                    <label>Ciudad</label>
                    <p></p>
                    <select class="form-control input-sm" name="ciudad_update" id="ciudad_update" style="width: 190px;" required>
                        <option value="A">Seleccione ciudad:</option>
                        <?php while ($view = mysqli_fetch_row($result2)) : ?>
                            <option value="<?php echo $view[0] ?>"><?php echo $view[1] . ' (' . $view[2]. ')'; ?></option>

                        <?php endwhile; ?>
                    </select>
                    <p></p>
                    <label>Edad</label>
                    <input type="text" class="form-control" id="edad_update" name="edad_update" style="width: 80px;">

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" id="btnUpdateTrainer" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                <a href="trainers.php"><span class="btn btn-danger">Cancelar</span></a>

            </div>
        </div>
    </div>
</div>


</body>

</html>

<script>


   formulario = document.querySelector('#frm_trainers');

   formulario.edad.addEventListener('keypress', function(e) {
    if (!soloNumeros(event)) {
        alertify.alert("solo se permiten numeros");
        e.preventDefault();
    }
})

   formulario.cedula.addEventListener('keypress', function(e) {
    if (!soloNumeros(event)) {
        alertify.alert("solo se permiten numeros");
        e.preventDefault();
    }
})

    //Solo permite introducir numeros.
   function soloNumeros(e) {

    var key = e.charCode;
    return key >= 48 && key <= 57;
}
</script>

<script>
    $('#new_trainer').on('shown.bs.modal', function () { $('#nombre').focus();}) 
    $('#update_trainer').on('shown.bs.modal', function () { $('#nombre_update').focus();}) 
</script>



<script>
   formulario2 = document.querySelector('#frm_trainers_update');
   formulario2.cedula_update.addEventListener('keypress', function(e) {
    if (!soloNumeros(event)) {
        alertify.alert("solo se permiten numeros");
        e.preventDefault();
    }
})
   formulario2.edad_update.addEventListener('keypress', function(e) {
    if (!soloNumeros(event)) {
        alertify.alert("solo se permiten numeros");
        e.preventDefault();
    }
})

   function soloNumeros(e) {

    var key = e.charCode;
    return key >= 48 && key <= 57;
}

</script>

<script>
    $(document).ready(function() {
        $('#ciudad').select2({
            dropdownParent: $('#new_trainer')
        });
        $('#ciudad_update').select2({
            dropdownParent: $('#update_trainer')
        });

    });
</script>

<!-- envia datos al documento donde reciben los post de guardado-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabletrainerload').load("trainermod/tabla_trainers.php");
        $('#btnAddTrainer').click(function() {

            $vacios = validarFormVacio('frm_trainers');


            if (vacios > 0) {
                alertify.alert("No se permiten campos vacíos");
                return false;
            }

            var formData = new FormData(document.getElementById("frm_trainers"));

            $.ajax({
                url: "../process/trainers_actions/newtrainer.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function(r) {

                        $('#frm_trainers')[0].reset();
                        $('#tabletrainerload').load("trainermod/tabla_trainers.php");
                        alertify.success("Agregado con exito");
                        window.location = "trainers.php";


                }
            });

        });
    });

</script>

<!-- envia datos al modal para modificar datos-->
<script>
    function agregadato(idtrainer) {
        $.ajax({
            type: "POST",
            data: "idtrainer=" + idtrainer,
            url: "../process/trainers_actions/bringdata.php",
            success: function(r) {

                dato = jQuery.parseJSON(r);

                $('#idtrainer').val(dato['id_entrenadores']);
                $('#nombre_update').val(dato['nombre']);
                $('#apellido_update').val(dato['apellido']);
                $('#cedula_update').val(dato['cedula']);
                $('#formacion_update').val(dato['formacion']);
                $('#direccion_update').val(dato['direccion']);
                $('#ciudad_update').val(dato['ciudad']);
                $('#edad_update').val(dato['edad']);


            }
        });
    }
</script>

<!-- envia datos al documento donde reciben los post de update-->
<script>
    $(document).ready(function() {

        $('#btnUpdateTrainer').click(function() {
            datos = $('#frm_trainers_update').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "../process/trainers_actions/updatedata.php",
                success: function(r) {
                    if (r == 1) {
                        $('#frm_trainers')[0].reset();
                        $('#tabletrainerload').load("trainermod/tabla_trainers.php");
                        alertify.success("Actualizado!!");
                        DataTable.reload();



                    } else {
                        alertify.error("Error al Actualizar");
                    }

                }
            });

        });

    });
</script>

<script>

function eliminatrainer(ide) {
            alertify.confirm('¿Desea eliminar?', function() {
                $.ajax({
                    type: "POST",
                    data: "ide=" + ide,
                    url: "../process/trainers_actions/deletedata.php",
                    success: function(r) {
                        if (r == 1) {
                            
                        $('#tabletrainerload').load("trainermod/tabla_trainers.php");
                        alertify.success("Registro Eliminado");
                        } else {
                            alertify.error("No se pudo eliminar");
                        }
                    }
                });
            }, function() {
                alertify.error('Cancelo !')
            });

        }
</script>




<?php
} else {
    header("location:../index.php");
}
?>