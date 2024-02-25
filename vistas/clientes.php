
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../pictures/iconos/list_clientes.png">
        <link rel="stylesheet" href="../libraries/css/stylesfiletype.css">
        <title>Clientes</title>
        <?php 
        require_once "menu.php";

        require_once "../class/conexion.php";
        $c = new conectar();
        $conexion = $c->conexion();

        $valor = 0;
        $ide = 0;

        $consulta = "SELECT MAX(id_clientes) from tb_clientes";
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
        <h3 style="text-align: center;">Clientes</h3>

        <span class="boton btn btn-primary" data-toggle="modal" data-target="#new_cliente">Nuevo</span>
        <div id="tableclientesload" style="align-content:left;">

        </div>

    </div>

    <!-- MODAL PARA AGREGAR NUEVO PLAN	-->

    <div class="modal fade" id="update_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document" style="width: 500px; ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Datos</h4>
                </div>
                <div class="modal-body">


                    <form id="frm_clientesupdate" >

                        <input type="text" name="id_update" id="id_update" hidden  >
                        <label>Nombres</label>
                        <div class="input-group">
                            <input name="nombre_update" id="nombre_update" type="text" required class="form-control input-sm" placeholder="Nombre">
                            <span class="input-group-addon"></span>
                            <input name="apellido_update" id="apellido_update" type="text"  class="form-control input-sm" placeholder="Apellido">
                            
                        </div>
                        <p></p>
                        <div class="input-group">
                            <input name="cedula_update" id="cedula_update" type="text" required class="form-control input-sm" placeholder="Cedula ó R.U.C">
                            <span class="input-group-addon"></span>
                            <input name="ocupacion_update" id="ocupacion_update" type="text"  class="form-control input-sm" placeholder="Ocupacion / Profesion">
                        </div>

                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="form-control input-sm" id="fecha_nacimiento_update" name="fecha_nacimiento_update" style="width: 200px;" placeholder="FECHA DE NACIMIENTO">
                        <p></p>
                        <label>Email</label>
                        <input type="text" class="form-control input-sm" id="email_update" name="email_update" style="width: 300px;" placeholder="Email Ej: joperez@hotmail.com">
                        <p></p>
                        <div class="input-group">
                            <input name="telefono_update" id="telefono_update" type="text" required class="form-control input-sm" placeholder="Telefono">
                            <span class="input-group-addon"></span>
                            <input name="direccion_update" id="direccion_update" type="text"  class="form-control input-sm" placeholder="Direccion">
                        </div>

                        <label>Ciudad</label>
                        <p></p>
                        <select class="form-control input-sm" name="ciudad_update" id="ciudad_update" style="width: 190px;" required>
                            <option value="A">Seleccione ciudad:</option>
                            <?php while ($view = mysqli_fetch_row($result2)) : ?>
                                <option value="<?php echo $view[0] ?>"><?php echo $view[1] . ' (' . $view[2]. ')'; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <p></p>
                        <label>Antropometria</label>
                        <div class="input-group">
                            <input name="peso_update" id="peso_update" type="text" required class="form-control input-sm" placeholder="PESO(KG)" onkeyup="sumarupdate();">
                            <span class="input-group-addon"></span>
                            <input name="altura_update" id="altura_update" type="text"  class="form-control input-sm" placeholder="ALTURA(M)" onkeyup="sumarupdate();">
                            <span class="input-group-addon"></span>
                            <input name="imc_update" id="imc_update" type="text"  class="form-control input-sm" placeholder="" readonly >

                        </div>
                        
                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" id="btnUPDCliente" class="btn btn-success" data-dismiss="modal" style="">Guardar</button>
                    <a href="clientes.php"> <span class="btn btn-info">Cancelar</span></a>

                </div>
            </div>
        </div>
    </div>

        <!-- *************************************************************************
**************************************************************************
********************************
MODAL PARA ACTUALIZAR CATEGORIAS                                     -->

<div class="modal fade" id="new_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="width: 500px; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
            </div>
            <div class="modal-body">


                <form id="frm_clientes" enctype="multipart/form-data">

                    <?php while ($v = mysqli_fetch_row($con_result)) : 
                        $valor = $v[0];

                    endwhile;

                    if($valor>0 && $valor!= "null"){
                        $ide = $valor + 1;
                    }
                    else {
                        $ide = 1000;
                    } 

                    ?>

                    <input type="text" name="id" value="<?php echo $ide;?>" hidden>
                    <label>Nombres</label>
                    <div class="input-group">
                        <input name="nombre" id="nombre" type="text" required class="form-control input-sm" placeholder="Nombre">
                        <span class="input-group-addon"></span>
                        <input name="apellido" id="apellido" type="text"  class="form-control input-sm" placeholder="Apellido">

                    </div>
                    <p></p>
                    <div class="input-group">
                        <input name="cedula" id="cedula" type="text" required class="form-control input-sm" placeholder="Cedula ó R.U.C">
                        <span class="input-group-addon"></span>
                        <input name="ocupacion" id="ocupacion" type="text"  class="form-control input-sm" placeholder="Ocupacion / Profesion">
                    </div>

                    <label>Fecha de Nacimiento</label>
                    <input type="date" class="form-control input-sm" id="fecha_nacimiento" name="fecha_nacimiento" style="width: 200px;" placeholder="FECHA DE NACIMIENTO">
                    <p></p>
                    <label>Email</label>
                    <input type="text" class="form-control input-sm" id="email" name="email" style="width: 300px;" placeholder="Email Ej: joperez@hotmail.com">
                    <p></p>
                    <div class="input-group">
                        <input name="telefono" id="telefono" type="text" required class="form-control input-sm" placeholder="Telefono">
                        <span class="input-group-addon"></span>
                        <input name="direccion" id="direccion" type="text"  class="form-control input-sm" placeholder="Direccion">
                    </div>

                    <label>Ciudad</label>
                    <p></p>
                    <select class="form-control input-sm" name="ciudad" id="ciudad" style="width: 190px;" required>
                        <option value="A">Seleccione ciudad:</option>
                        <?php while ($view = mysqli_fetch_row($result)) : ?>
                            <option value="<?php echo $view[0] ?>"><?php echo $view[1] . ' (' . $view[2]. ')'; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <p></p>
                    <label>Antropometria</label>
                    <div class="input-group">
                        <input name="peso" id="peso" type="text" required class="form-control input-sm" placeholder="PESO(KG)" onkeyup="sumar();">
                        <span class="input-group-addon"></span>
                        <input name="altura" id="altura" type="text"  class="form-control input-sm" placeholder="ALTURA(M)" onkeyup="sumar();">
                        <span class="input-group-addon"></span>
                        <input name="imc" id="imc" type="text"  class="form-control input-sm" placeholder="" readonly >

                    </div>




                    <label>Photo</label>
                    <input type="file" id="imagen" name="imagen" class="input-file archivo" >

                </form>



            </div>
            <div class="modal-footer">
                <button type="button" id="btnAddCliente" class="btn btn-success" data-dismiss="modal" style="">Guardar</button>
                <a href="clientes.php"> <span class="btn btn-info">Cancelar</span></a>

            </div>
        </div>
    </div>
</div>

</body>

</html>


<script>
    function sumar() {
        form = document.querySelector('#frm_clientes');
        var peso = document.getElementById('peso').value;
        var altura = document.getElementById('altura').value;
        if(peso > 0 || peso != ""){

            if(altura > 0 || altura != ""){
                var imc = peso/(altura * altura);
            }else {
                document.getElementById('imc').value = "";
                document.getElementById('imc').value = 0;       
            }   

        }else{
            alertify.alert("Debe ingresar el peso");
        }


        //imc: obesidad
        if(imc > 30){
           form.imc.style.color="#cb4335";
       }
        //imc: sobrepeso
       else if(imc < 29.9 && imc > 25){
        form.imc.style.color=" #d35400";
    }
        //imc: peso normal
    else if(imc < 24.9 && imc > 18.5 ){
        form.imc.style.color="#27ae60";
    }
    else if(imc < 18.5){
        form.imc.style.color=" #e74c3c";
    }
    document.getElementById('imc').value = imc.toFixed(2);
}


function sumarupdate() {
    form2 = document.querySelector('#frm_clientesupdate');
    var peso = document.getElementById('peso_update').value;
    var altura = document.getElementById('altura_update').value;
    if(peso > 0 || peso != ""){

        if(altura > 0 || altura != ""){
            var imc = peso/(altura * altura);
        }else {
            document.getElementById('imc_update').value = "";
            document.getElementById('imc_update').value = 0;       
        }   

    }else{
        alertify.alert("Debe ingresar el peso");
    }


        //imc: obesidad
    if(imc > 30){
       form2.imc_update.style.color="#cb4335";
   }
        //imc: sobrepeso
   else if(imc < 29.9 && imc > 25){
    form2.imc_update.style.color=" #d35400";
}
        //imc: peso normal
else if(imc < 24.9 && imc > 18.5 ){
    form2.imc_update.style.color="#27ae60";
}
else if(imc < 18.5){
    form2.imc_update.style.color=" #e74c3c";
}

document.getElementById('imc_update').value = imc.toFixed(2);
}
</script>

<script>
   formulario = document.querySelector('#frm_clientes');
   formulario.cedula.addEventListener('keypress', function(e) {
    if (!soloNumeros(event)) {
        alertify.alert("solo se permiten numeros");
        e.preventDefault();
    }})

   formulario.telefono.addEventListener('keypress', function(e) {
    if (!soloNumeros(event)) {
        alertify.alert("solo se permiten numeros");
        e.preventDefault();
    }})

    //Solo permite introducir numeros.
   function soloNumeros(e) {
    var key = e.charCode;
    return key >= 48 && key <= 57;}
</script>

<script>
    $('#new_cliente').on('shown.bs.modal', function () { $('#nombre').focus();}) 
    $('#update_cliente').on('shown.bs.modal', function () { $('#nombre_update').focus();}) 
</script>


<script>
    $(document).ready(function() {
        $('#ciudad').select2({
            dropdownParent: $('#new_cliente')
        });
        $('#ciudad_update').select2({
            dropdownParent: $('#update_cliente')
        });

    });
</script>

<!-- envia datos al documento donde reciben los post de guardado-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableclientesload').load("clientesmod/table_clientes.php");
        $('#btnAddCliente').click(function() {

            $vacios = validarFormVacio('frm_clientes');


            if (vacios > 0) {
                alertify.alert("No se permiten campos vacíos");
                return false;
            }

            var formData = new FormData(document.getElementById("frm_clientes"));

            $.ajax({
                url: "../process/clientes_actions/newcliente.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function(r) {

                    $('#frm_clientes')[0].reset();
                    $('#tableclientesload').load("clientesmod/table_clientes.php");
                    alertify.success("Agregado con exito");

                }
            });

        });
    });

</script>

<!-- envia datos al modal para modificar datos-->
<script>
    function agregadato(idcliente) {
        $.ajax({
            type: "POST",
            data: "idcliente=" + idcliente,
            url: "../process/clientes_actions/bringdata.php",
            success: function(r) {

                dato = jQuery.parseJSON(r);

                $('#id_update').val(dato['id_clientes']);
                $('#nombre_update').val(dato['nombre']);
                $('#apellido_update').val(dato['apellido']);
                $('#cedula_update').val(dato['cedula']);
                $('#ocupacion_update').val(dato['ocupacion']);
                $('#fecha_nacimiento_update').val(dato['fecha_nac']);
                $('#email_update').val(dato['email']);
                $('#telefono_update').val(dato['telefono']);
                $('#direccion_update').val(dato['direccion']);
                $('#ciudad_update').val(dato['tb_ciudades']);
                $('#altura_update').val(dato['altura']);
                $('#peso_update').val(dato['peso']);
                $('#imc_update').val(dato['imc']);


            }
        });
    }
</script>

<!-- envia datos al documento donde reciben los post de update-->
<script>
    $(document).ready(function() {

        $('#btnUPDCliente').click(function() {
            datos = $('#frm_clientesupdate').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "../process/clientes_actions/updatedata.php",
                success: function(r) {
                    if (r == 1) {
                        $('#frm_clientesupdate')[0].reset();
                        $('#tableclientesload').load("clientesmod/table_clientes.php");
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

    function eliminacliente(ide) {
        alertify.confirm('¿Desea eliminar?', function() {
            $.ajax({
                type: "POST",
                data: "ide=" + ide,
                url: "../process/clientes_actions/deletedata.php",
                success: function(r) {
                    if (r == 1) {
                        $('#tableclientesload').load("clientesmod/table_clientes.php");
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