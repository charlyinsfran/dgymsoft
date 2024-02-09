
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../pictures/iconos/planes.png">
        <title>Planes</title>
        <?php 
        require_once "menu.php";

        require_once "../class/conexion.php";
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT id_moneda,descripcion,simbolo from tb_moneda";
        $result = mysqli_query($conexion, $sql);



        ?>
    </head>
<br>
<br>
<br>
<br>
    <body>
        <div class="col-sm-1">
            <div class="container">
                <div class="row"></div>
            </div></div>
        <div class="col-sm-3">
            <div class="container">
                <div class="row">
                    <span class="btn btn-primary" 
                    style="width: 180px; height: 40px; font-family:SANS-SERIF; font-size: 100%;" 
                    data-toggle="modal" data-target="#newplan">Nuevo Plan</span>

                </div>
            </div>

        </div>

        <div class="col-sm-6">

            <div id="tableplanload" style="align-content:left;">

            </div>

        </div>

        <!-- MODAL PARA AGREGAR NUEVO PLAN	-->

        <div class="modal fade" id="newplan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">New Plan</h4>
                    </div>
                    <div class="modal-body">


                        <form id="frm_planes">
                            
                            <label>Descripcion</label>
                            <input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
                            <label>Moneda</label>
                            <p></p>
                            <select class="form-control input-sm" name="moneda" id="moneda" style="width: 250px;" required>
                                <option value="A">Seleccione moneda:</option>
                                <?php while ($view = mysqli_fetch_row($result)) : ?>
                                    <option value="<?php echo $view[0] ?>"><?php echo $view[1] . ' - ' . $view[2]; ?></option>
           
                                <?php endwhile; ?>
                            </select>
                            <p></p>
                            <label>Costo</label>
                            <input type="text" class="form-control input-sm" id="costo" name="costo">
                            <label>Clases/Dias</label>
                            <input type="text" class="form-control input-sm" id="dias" name="dias">
                        </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnAddPlan" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                        <a href="planes.php"> <span class="btn btn-danger">Cancelar</span></a>

                    </div>
                </div>
            </div>
        </div>

        <!-- *************************************************************************
**************************************************************************
********************************
MODAL PARA ACTUALIZAR CATEGORIAS                                     -->

        <div class="modal fade" id="actualizaCategorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Actualiza Categorias</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frm_CategoriasUpdates">
                            <input type="text" hidden="" id="idcategoriaold" name="idcategoriaold">
                            <label>Descripcion</label>
                            <input type="text" id="categoriaupdate" name="categoriaupdate" class="form-control input-sm">
                            <p></p>
                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnActualizaCategoria" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                        <a href="categorias.php"><span class="btn btn-danger">Cancelar</span></a>

                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>

    <script>
        $('#newplan').on('shown.bs.modal', function () { $('#descripcion').focus();}) 
        //$('#actualizaCategorias').on('shown.bs.modal', function () { $('#categoriaupdate').focus();}) 
    </script>

<script>
    $(document).ready(function() {
            $('#moneda').select2({
                dropdownParent: $('#newplan')
            });
            
        });
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableplanload').load("planesmod/tableplanes.php");
            
            $('#btnAddPlan').click(function() {

                $vacios = validarFormVacio('frm_planes');


                if (vacios > 0) {
                    alertify.alert("No se permiten campos vacíos");
                    return false;
                }

                datos = $('#frm_planes').serialize();
                $.ajax({

                    type: "POST",
                    data: datos,
                    url: "../process/planes_actions/newplan.php",
                    success: function(r) {

                        if (r == 1) {
                            alertify.success("Plan Registrado");
                            $('#tableplanload').load("planesmod/tableplanes.php");
                            $('#frm_planes')[0].reset();
                            DataTable.reload();

                        } else {
                            alertify.error("Error/Dato Duplicado");
                        }

                    }
                });
            });
        });
    </script>

<!--

    <script>
        function agregaDato(idcategoria, descripcion) {
            $('#idcategoriaold').val(idcategoria);
            $('#categoriaupdate').val(descripcion);

        }
    </script>

    <SCript>
        $(document).ready(function() {
          
            $('#btnActualizaCategoria').click(function() {

                datos = $('#frm_CategoriasUpdates').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/categorias/actualizacategorias.php",
                    success: function(r) {


                        if (r == 1) {
                            alertify.success("Registro Actualizado");
                            $('#tablaCategoriaLoad').load("categorias/table_categorias.php");


                        } else {
                            alertify.error("Error al Actualizar");
                        }

                    }
                });
            });


        });
    </SCript>


    <script>
        function eliminaCategoria(idcategoria) {
            alertify.confirm('¿Desea eliminar?', function() {
                $.ajax({
                    type: "POST",
                    data: "idcategoria=" + idcategoria,
                    url: "../procesos/categorias/eliminarcategorias.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#tablaCategoriaLoad').load("categorias/table_categorias.php");
                            alertify.success("Eliminado con exito!!");
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

