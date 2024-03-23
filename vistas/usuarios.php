<?php


session_start();

if (isset($_SESSION['usuario'])) {

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <script src="../libraries/js/funciones.js"></script>
        <link rel="shortcut icon" href="../pictures/images/contrasena.png">
        <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../libraries/DataTables/css/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../libraries/DataTables/css/dataTables.bootstrap.min.css">

        <script src="../libraries/DataTables/js/jquery.dataTables.js"></script>
        <script src="../libraries/DataTables/js/dataTables.bootstrap.js"></script>
        
        <title>Users</title>
        <?php require_once "menu.php";
        require_once "../class/conexion.php";
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT idtb_rol,descripcion from tb_rol";
        $sql2 = "SELECT idtb_rol,descripcion from tb_rol";

        $sqle = "SELECT max(idtb_users) from tb_users";
        $c_sqle = mysqli_query($conexion,$sqle);

        $result = mysqli_query($conexion, $sql);
        $result2 = mysqli_query($conexion, $sql2);

        $dato = "";
        $ide = "";

        
        
        ?>
    </head>

    <body>
        <br><br>
        <div class="col-sm-2">
            <div class="container">
                <div class="row" style="position: relative; padding-left: 8%; padding-top: 8%;">
                    <br>
                    <br>

                    <span class="btn btn-primary glyphicon" 
                    style="width: 100px; height: 38px; font-family:SANS-SERIF; font-size: 110%; text-align: center;" 
                    data-toggle="modal" data-target="#newusuario">Nuevo</span>

                </div>
            </div>

        </div>

        <div class="col-sm-9">

            <div id="tablaLoad" style="align-content:left;">

            </div>

        </div>

        <!-- MODAL PARA AGREGAR nuevo usuario	-->

        <div class="modal fade" id="newusuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document" style="width: 550px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
                    </div>
                    <form id="frm_usuarios" class="form-horizontal">
                        <div class="modal-body">
                            <?php while ($v = mysqli_fetch_row($c_sqle)) : 
                                $valor = $v[0];

                            endwhile;

                            if($valor>0 && $valor!= "null"){
                                $ide = $valor + 1;
                            }
                            else {
                                $ide = 100;
                            } 

                            ?>
                            <input type="text" id="ide" name="ide" value="<?php echo $ide; ?>" hidden>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-8">
                                   <input type="text" class="form-control input-sm" id="nombre" name="nombre" required>
                               </div>
                           </div>

                           <div class="form-group">
                            <label class="col-lg-2 control-label">Apellido</label>
                            <div class="col-lg-8">
                               <input type="text" class="form-control input-sm" id="apellido" name="apellido" required>

                           </div>
                       </div>
                       <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-8">
                           <input type="text" class="form-control input-sm" id="email" name="email">
                       </div>
                   </div>

                   <div class="form-group">
                    <label class="col-lg-2 control-label">Telefono</label>
                    <div class="col-lg-8">
                       <input type="text" class="form-control input-sm" id="telefono" name="telefono">
                   </div>
               </div>       
               <div class="form-group">
                <label class="col-lg-2 control-label">Usuario</label>
                <div class="col-lg-8">
                   <input type="text" class="form-control input-sm" id="user" name="user">
               </div>
           </div>  

           <div class="form-group">
            <label class="col-lg-2 control-label">Contraseña</label>
            <div class="col-lg-8">
               <input type="password" class="form-control input-sm" id="password" name="password">
           </div>
       </div>


       <div class="form-group">
        <label class="col-lg-2 control-label">Confirmar Contraseña</label>
        <div class="col-lg-8">
           <input type="password" class="form-control input-sm" id="passwordconfirmacion" name="passwordconfirmacion" onblur="validarpass();">
       </div>

       <div class="col-lg-2">
        <button type= "button" class="btn btn-secondary" style="width: 40px;" 
        onclick="mostrarContrasena()" style="text-align: center;" id="mostrarpass"><i class="fa-regular fa-eye"></i>
    </button>
    <button type= "button" class="btn btn-secondary" style="width: 40px;" 
    onclick="ocultarContrasena()" style="text-align: center;" id="ocultarpass" name="ocultarpass"><i class="fa-regular fa-eye-slash"></i>
</button>
</div>



</div> 
<div class="form-group">
    <label class="col-lg-2 control-label">Tipo de Usuario</label>
    <div class="col-lg-8">
       <select name="tipousuario" id="tipousuario" class="form-control input-sm" style="width: 190px;height: 50px;" >
        <option value="A">Seleccione:</option>
        <?php while ($view = mysqli_fetch_row($result)) : ?>
            <option value="<?php echo $view[0] ?>"><?php echo $view[1]; ?></option>
        <?php endwhile; ?>
    </select>
</div>
</div>   
<P></P> 

<p style="color:red" id="generarpass" name="generarpass"> PRESIONE LA TECLA <strong style="color: BLACK;">F2</strong> PARA GENERAR EL USUARIO</p>      


</div>
</form>
<div class="modal-footer">
    <button type="button" id="btnguardar" class="btn btn-primary" style="text-align: center;" data-dismiss="modal">Guardar</button>
    <a href="usuarios.php"> <span class="btn btn-danger">Cancelar</span></a>

</div>
</div>
</div>
</div>

        <!-- *************************************************************************
**************************************************************************
********************************
MODAL PARA ACTUALIZAR usuarios                                     -->

<div class="modal fade" id="update_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="width: 550px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificar Usuario</h4>
            </div>
            <form id="frm_usuariosactualiza" class="form-horizontal">
                <div class="modal-body">
                    <input type="text" id="idusuarioactualiza" name="idusuarioactualiza" hidden>    
                    <div class="form-group">

                        <label class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-8">
                           <input type="text" class="form-control input-sm" id="nombreactualiza" name="nombreactualiza" required>
                       </div>
                   </div>

                   <div class="form-group">
                    <label class="col-lg-2 control-label">Apellido</label>
                    <div class="col-lg-8">
                       <input type="text" class="form-control input-sm" id="apellidoactualiza" name="apellidoactualiza" required>

                   </div>
               </div>
               <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-8">
                   <input type="text" class="form-control input-sm" id="emailactualiza" name="emailactualiza">
               </div>
           </div>

           <div class="form-group">
            <label class="col-lg-2 control-label">Telefono</label>
            <div class="col-lg-8">
               <input type="text" class="form-control input-sm" id="telefonoactualiza" name="telefonoactualiza">
           </div>
       </div>       
       <div class="form-group">
        <label class="col-lg-2 control-label">Usuario</label>
        <div class="col-lg-8">
           <input type="text" class="form-control input-sm" id="useractualiza" name="useractualiza">
       </div>
   </div>  

   <div class="form-group">
    <label class="col-lg-2 control-label">Tipo de Usuario</label>
    <div class="col-lg-8">
       <select name="tipousuarioactualiza" id="tipousuarioactualiza" class="form-control input-sm" style="width: 190px;">
        <option value="A">Seleccione:</option>
        <?php while ($view = mysqli_fetch_row($result2)) : ?>
            <option value="<?php echo $view[0] ?>"><?php echo $view[1]; ?></option>
        <?php endwhile; ?>
    </select>
</div>
</div>   

</div>
</form>
<div class="modal-footer">
    <button type="button" id="btnactualizar" class="btn btn-primary" style="text-align: center;" data-dismiss="modal">Guardar</button>
    <a href="usuarios.php"> <span class="btn btn-danger">Cancelar</span></a>

</div>
</div>
</div>
</div>


</body>

</html>

<script>
    $('#newusuario').on('shown.bs.modal', function () { $('#nombre').focus();}) 
    $('#update_usuario').on('shown.bs.modal', function () { $('#nombreactualiza').focus();}) 
</script>


<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }

      var tipo = document.getElementById("passwordconfirmacion");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }

      $('#ocultarpass').show();
      $('#mostrarpass').hide();   
  }

  function ocultarContrasena(){
    var tipo = document.getElementById("password");
    if(tipo.type == "text"){
      tipo.type = "password";
  }else{
      tipo.type = "text";
  }

  var tipo = document.getElementById("passwordconfirmacion");
  if(tipo.type == "text"){
      tipo.type = "password";
  }else{
      tipo.type = "text";
  }

  $('#mostrarpass').show();
  $('#ocultarpass').hide();
}

window.onkeydown = presionartecla;

function presionartecla(){
    tecla_tab = event.keyCode;
    var nom = document.getElementById('nombre');
    var ape = document.getElementById('apellido');

    if(tecla_tab == 113){

        if(nom.value == "" && ape.value == ""){
            $('#nombre').focus();
            alertify.alert("INGRESE NOMBRE Y APELLIDO");
            
        }else{

            var one = document.getElementById("nombre").value.substr(0,1);
            var two = document.getElementById("apellido").value;
            document.getElementById('user').value = one.toUpperCase()+ two.toUpperCase();
        }
    }

}


</script>

<script>
    function agregadato(idusuario) {
        $.ajax({
            type: "POST",
            data: "idusuario=" + idusuario,
            url: "../process/usuarios_actions/bring_data.php",
            success: function(r) {

                dato = jQuery.parseJSON(r);

                $('#idusuarioactualiza').val(dato['idtb_users']);
                $('#nombreactualiza').val(dato['nombre']);
                $('#apellidoactualiza').val(dato['apellido']);
                $('#emailactualiza').val(dato['email']);
                $('#telefonoactualiza').val(dato['telefono']);
                $('#useractualiza').val(dato['usuario']);
                $('#tipousuarioactualiza').val(dato['id_rol']);

            }
        });
    }
</script>


<script type="text/javascript">


    $(document).ready(function() {
        $('#tipousuario').select2({
            dropdownParent: $('#newusuario')
        });
            /*$('#tipousuarioactualiza').select2({
                dropdownParent: $('#update_usuario')
            });*/ 
        var elemento = document.getElementById("ocultarpass");
        elemento.style.display = "none";

        
        $('#tablaLoad').load("usuariosmod/table_users.php");
        $('#btnguardar').click(function() {

            $vacios = validarFormVacio('frm_usuarios');


            if (vacios > 0) {
                alertify.alert("No se permiten campos vacíos");
                return false;
            }

            datos = $('#frm_usuarios').serialize();
            $.ajax({

                type: "POST",
                data: datos,
                url: "../process/usuarios_actions/new_user.php",
                success: function(r) {

                    if (r == 1) {
                        alertify.success("Registro Añadido");
                        $('#tablaLoad').load("usuariosmod/table_users.php");
                        $('#frm_usuarios')[0].reset();
                        DataTable.reload();

                    } else {
                        alertify.error("Error al agregar");
                    }

                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#btnactualizar').click(function() {

            datos = $('#frm_usuariosactualiza').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../process/usuarios_actions/update_users.php",
                success: function(r) {


                    if (r == 1) {
                        alertify.success("Registro Actualizado");
                        $('#tablaLoad').load("usuariosmod/table_users.php")
                        $('#frm_usuariosactualiza')[0].reset();
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
    function eliminausuario(idusuario) {
        alertify.confirm('¿Desea eliminar?', function() {
            $.ajax({
                type: "POST",
                data: "idusuario=" + idusuario,
                url: "../process/usuarios_actions/delete_user.php",
                success: function(r) {
                    if (r == 1) {
                       $('#tablaLoad').load("usuariosmod/table_users.php")
                       DataTable.reload();
                   } else {
                    alertify.error("No se pudo eliminar");
                }
            }
        });
        }, function() {
            alertify.error('Cancelo!')
        });

    }
</script>


<script>

    var pwd1 = document.getElementById("password");
    var pwd2 = document.getElementById("passwordconfirmacion"); 


    function validarpass(){

        if(pwd1.value != "" && pwd2.value != ""){

            if(pwd1.value != pwd2.value) {

             alertify.message("Las contraseñas no coinciden");
         }
         
    }

}


</script>



<?php
} else {
    header("location:../index.php");
}
?>