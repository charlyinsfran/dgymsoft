<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="pictures/images/contrasena.png">
    <link rel="stylesheet" type="text/css" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="libraries/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="libraries/alertifyjs/css/themes/default.css">

    <script src="libraries/js/jquery-3.2.1.min.js"></script>
    <script src="libraries/js/funciones.js"></script>
    <script src="libraries/alertifyjs/alertify.js"></script>
    <title>LOGIN</title>
</head>
<body style="background-image: url(pictures/backgrounds/fondo_login.jpg); background-position: center; background-repeat: no-repeat; 
background-size: cover;width: 100%;">

<br><br><br>

<div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-6">
            <div class="panel" style="width: 350px;">
                <div class="panel panel-heading" style="text-align: center;">DMARKET - DCHR_SOFT &COPY;</div>
                <div class="panel panel-body" align="center">
                <p><img src="pictures/backgrounds/logotipo.jpg" height="220" width="280" style="text-align: center;"></p>

                <form id="frm_login" action="process/login/login.php" method="POST">
                <div class="col-sm-12">
             
                <input type="text" class="form-control input-sm" name="usuario" id="usuario" 
                style="text-align: center; height: 40px; outline: none; border: none;
                 border-bottom: solid 0.5px; padding: 0 5px; font-size: 18px; font-weight: bold;color: #000000;" placeholder="usuario">
                <p></p>
               
                <input type="password" class="form-control input-sm" name="password" id="password" 
                style="text-align: center; height: 40px; outline: none; border: none;
                 border-bottom: solid 0.5px; padding-left: 20px; font-size: 18px;  font-weight: bold; color: #000000;" placeholder="password">
                <p></p>
                </div>
                <div class="col-sm-12" align="center">
                <span class="btn btn-primary btn-md glyphicon glyphicon-log-in" id="entrarSistema" 
                style="text-align: center; width: 180px; border: none; padding: 5px 5px;background: background: #3498db;"> 
                <label style="font-size: 20px;"> Entrar</label></span>

                
                </div>

                </form>



                </div>
            </div>



        </div>
        
    </div>
</div>
    
</body>
</html>


<script>
    $(document).ready(function() {
        $('#usuario').focus(); });
    
    
</script>

<script>

    $('#entrarSistema').click(function(){
        vacios = validarFormVacio('frm_login');

        if(vacios>0){
            $('#usuario').focus(); 
        alertify.alert("Debes llenar todos los campos");
        return false;
            }




datos=$('#frm_login').serialize();
$.ajax({
    type:"POST",
    data:datos,
    url:"process/loginact/login.php",
    success:function(r){

        if(r==1){
            
            window.location = "vistas/inicio.php";
            //$('#frm_login')[0].reset();
        }else{
            alertify.error("Datos Incorrectos");
        }

    }
});
});
</script>



<script type="text/javascript">

window.onkeydown = presionarenter;


function presionarenter(){
  tecla_tab = event.keyCode;
  if(tecla_tab == 13){
    vacios = validarFormVacio('frm_login');
    if(vacios>0){
        alertify.alert("Debes llenar todos los campos");
        return false;
    }
    datos=$('#frm_login').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"process/loginact/login.php",
        success:function(r){

            if(r==1){
                window.location = "vistas/inicio.php";
                //$('#frm_login')[0].reset();
            }else{
                alertify.error("Datos Incorrectos");
            }

        }
    });
}
}


</script>