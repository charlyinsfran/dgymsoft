<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../pictures/iconos/rutinas.png">
    <title>Routines</title>
    <?php 
    require_once "menu.php";

    require_once "../class/conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();

    $valor = 0;
    $ide = 0;

    $consulta = "SELECT MAX(id_rutina) from tb_rutina";
    $con_result = mysqli_query($conexion,$consulta);





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

    <div class="col-sm-8">
        <h3 style="text-align: center;">Rutinas</h3>

        <span class="boton btn btn-primary" data-toggle="modal" data-target="#new_routine">Nueva Rutina</span>
        <div id="tablerutinaload" style="align-content:left;">

        </div>

    </div>

    <!-- MODAL PARA AGREGAR NUEVO 	-->

    <div class="modal fade" id="new_routine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Rutina</h4>
                </div>
                <div class="modal-body">


                    <form id="frm_routines">
                    <?php while ($v = mysqli_fetch_row($con_result)) : 
                    $valor = $v[0];

                    endwhile;

                    if($valor>0 && $valor!= "null"){
                        $ide = $valor + 1;
                    }
                    else {
                        $ide = 70;
                    } 

                    ?>
                        <input type="text" name="id" id="id" value="<?php echo $ide; ?>" hidden>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">

                        <p></p>
                        
                        <div class="input-group">
                        <input type="text" class="form-control" id="calentamiento" name="calentamiento" placeholder="Calentamiento">
                        <span class="input-group-addon"></span>
                        <input name="tiempo" id="tiempo" type="text"  class="form-control" placeholder="Tiempo">
                        </div>

                        <p></p>
                        <label>Serie 1:</label>
                        <div class="input-group">
                        <input name="first_ejercicio" id="first_ejercicio" type="text" required class="form-control" placeholder="Ejercicio">
                        <span class="input-group-addon"></span>
                        <input name="first_repeticiones" id="first_repeticiones" type="text"  class="form-control" placeholder="Repeticiones">
                        </div>

                        <p></p>
                        <label>Serie 2:</label>
                        <div class="input-group">
                        <input name="second_ejercicio" id="second_ejercicio" type="text" required class="form-control" placeholder="Ejercicio">
                        <span class="input-group-addon"></span>
                        <input name="second_repeticiones" id="second_repeticiones" type="text"  class="form-control" placeholder="Repeticiones">
                        </div>

                        <p></p>
                        <label>Serie 3:</label>
                        <div class="input-group">
                        <input name="third_ejercicio" id="third_ejercicio" type="text" required class="form-control" placeholder="Ejercicio">
                        <span class="input-group-addon"></span>
                        <input name="third_repeticiones" id="third_repeticiones" type="text"  class="form-control" placeholder="Repeticiones">
                        </div>

                        <p></p>
                        <label>Descanso entre series (min)</label>
                        <input type="range" value="0" min="0" max="60" onInput="this.nextElementSibling.value = this.value"
                         class="form-control" style="width:200px; height: 10%;" name="descanso" id="descanso">
                            <output><span>0 min</span></output>


                   
                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAddRoutine" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    <a href="routines.php"> <span class="btn btn-danger">Cancelar</span></a>

                </div>
            </div>
        </div>
    </div>

        <!-- MODAL PARA ACTUALIZAR   -->

        <div class="modal fade" id="update_routine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Rutina</h4>
                </div>
                <div class="modal-body">


                    <form id="frm_routinesupdate">
                        <label>Descripcion</label>
                        <input type="text" name="id_update" id="id_update" hidden>
                        <input type="text" class="form-control" id="descripcion_update" name="descripcion_update">

                        <p></p>
                        <label>Calentamiento</label>
                        <div class="input-group">

                        <input type="text" class="form-control" id="calentamiento_update" name="calentamiento_update">
                        <span class="input-group-addon"></span>
                        <input name="tiempo_update" id="tiempo_update" type="text"  class="form-control">
                        </div>

                        <p></p>
                        <label>Serie 1:</label>
                        <div class="input-group">
                        <input name="first_ejercicio_update" id="first_ejercicio_update" type="text" required class="form-control" placeholder="Ejercicio">
                        <span class="input-group-addon"></span>
                        <input name="first_repeticiones_update" id="first_repeticiones_update" type="text"  class="form-control" placeholder="Repeticiones">
                        </div>

                        <p></p>
                        <label>Serie 2:</label>
                        <div class="input-group">
                        <input name="second_ejercicio_update" id="second_ejercicio_update" type="text" required class="form-control" placeholder="Ejercicio">
                        <span class="input-group-addon"></span>
                        <input name="second_repeticiones_update" id="second_repeticiones_update" type="text"  class="form-control" placeholder="Repeticiones">
                        </div>

                        <p></p>
                        <label>Serie 3:</label>
                        <div class="input-group">
                        <input name="third_ejercicio_update" id="third_ejercicio_update" type="text" class="form-control" placeholder="Ejercicio">
                        <span class="input-group-addon"></span>
                        <input name="third_repeticiones_update" id="third_repeticiones_update" type="text"  class="form-control" placeholder="Repeticiones">
                        </div>

                        <p></p>
                        <label>Descanso entre series (min)</label>
                        <input type="text" min="0" max="60"class="form-control" style="width:200px; height: 10%;" name="descanso_update" id="descanso_update">
                            
                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" id="btnUpdateRoutine" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    <a href="routines.php"> <span class="btn btn-danger">Cancelar</span></a>

                </div>
            </div>
        </div>
    </div>



</body>

</html>

<script>
    $('#new_routine').on('shown.bs.modal', function () { $('#descripcion').focus();}) 
     $('#update_routine').on('shown.bs.modal', function () { $('#descripcion_update').focus();})
       
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('#tablerutinaload').load("routinesmod/tablerutinas.php");
        
        $('#btnAddRoutine').click(function() {

            $vacios = validarFormVacio('frm_routines');


            if (vacios > 0) {
                alertify.alert("No se permiten campos vacíos");
                return false;
            }

            datos = $('#frm_routines').serialize();
            $.ajax({

                type: "POST",
                data: datos,
                url: "../process/routines_actions/new_routine.php",
                success: function(r) {

                    if (r == 1) {
                        $('#frm_routines')[0].reset();
                        $('#tablerutinaload').load("routinesmod/tablerutinas.php");
                        alertify.success("Rutina Agregada");
                        window.location = "routines.php";


                    } else {
                        alertify.error("Error/Dato Duplicado");
                    }

                }
            });
        });
    });
</script>

<script>
    function agregadato(idrutina) {
        $.ajax({
            type: "POST",
            data: "idrutina=" + idrutina,
            url: "../process/routines_actions/bring_data.php",
            success: function(r) {

                dato = jQuery.parseJSON(r);

                $('#id_update').val(dato['id_rutina']);
                $('#descripcion_update').val(dato['descripcion']);
                $('#calentamiento_update').val(dato['calentamiento']);
                $('#tiempo_update').val(dato['tiempo']);
                $('#first_ejercicio_update').val(dato['ejercicio1']);
                $('#first_repeticiones_update').val(dato['repeticiones1']);
                $('#second_ejercicio_update').val(dato['ejercicio2']);
                $('#second_repeticiones_update').val(dato['repeticiones2']);
                $('#third_ejercicio_update').val(dato['ejercicio3']);
                $('#third_repeticiones_update').val(dato['repeticiones3']);
                $('#descanso_update').val(dato['descanso']);
               


            }
        });
    }
</script>


<script>
    $(document).ready(function() {

        $('#btnUpdateRoutine').click(function() {
            datos = $('#frm_routinesupdate').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "../process/routines_actions/update_routine.php",
                success: function(r) {
                    if (r == 1) {
                        $('#frm_routines')[0].reset();
                        $('#tablerutinaload').load("routinesmod/tablerutinas.php");
                        alertify.success("Registro Actualizado");
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

    function deleterutina(ide) {
        alertify.confirm('¿Desea eliminar?', function() {
            $.ajax({
                type: "POST",
                data: "ide=" + ide,
                url: "../process/routines_actions/delete_data.php",
                success: function(r) {
                    if (r == true) {
                        $('#tablerutinaload').load("routinesmod/tablerutinas.php");
                        $('#frm_routines')[0].reset();
                        DataTable.reload();
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