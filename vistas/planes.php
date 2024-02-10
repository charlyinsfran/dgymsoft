
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
                padding: 8px 14px 9px;
                font-size: 12px;
                border-radius: 4px;
                color: #fff;
                height: 36px;
                transition: all 75ms ease-in-out;
                :hover{
                    box-shadow: 0 1px 4px rgb(0 0 0 / 30%);
                }
            }
        </style>
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
        <div class="col-sm-2">
            <div class="container">
                <div class="row">
                    <span class="boton btn btn-primary" 
                      data-toggle="modal" data-target="#newplan">Nuevo Plan</span>

                </div>
            </div>

        </div>

        <div class="col-sm-7">

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

        <div class="modal fade" id="updateplan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Planes</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frm_planupdate">
                            <input type="text" name="idee" id="idee" hidden>
                           <label>Descripcion</label>
                            <input type="text" class="form-control input-sm" id="descripcion_update" name="descripcion_update">
                            <label>Moneda</label>
                            <p></p>
                            <select class="form-control input-sm" name="moneda_update" id="moneda_update" style="width: 250px;" required>
                                <option value="A">Seleccione moneda:</option>
                                <?php while ($view2 = mysqli_fetch_row($result2)) : ?>
                                    <option value="<?php echo $view2[0] ?>"><?php echo $view2[1] . ' - ' . $view2[2]; ?></option>
           
                                <?php endwhile; ?>
                            </select>
                            <p></p>
                            <label>Costo</label>
                            <input type="text" class="form-control input-sm" id="costo_update" name="costo_update">
                            <label>Clases/Dias</label>
                            <input type="text" class="form-control input-sm" id="dias_update" name="dias_update">
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
            $('#moneda_update').select2({
                dropdownParent: $('#updateplan')
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


    <script>
        
        function agregadato(idplan) {
            $.ajax({
                type: "POST",
                data: "idplan=" + idplan,
                url: "../process/planes_actions/bringdataupdate.php",
                success: function(r) {

                    dato = jQuery.parseJSON(r);

                    $('#idee').val(dato['idtb_plan']);
                    $('#descripcion_update').val(dato['descripcion']);
                    $('#moneda_update').val(dato['id_moneda']);
                    $('#costo_update').val(dato['costo']);
                    $('#dias_update').val(dato['cant_clases']);
                   
                    
                    

                }
            });
        }
    
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

