<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../pictures/iconos/metodo-de-pago.png">
        <title>Pagos</title>
        <?php 
        require_once "menu.php";

        require_once "../class/conexion.php";
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT id_clientes,nombre,apellido,cedula from tb_clientes";
        $result = mysqli_query($conexion, $sql);

        $sql_plan = "SELECT pl.idtb_plan,pl.descripcion,mon.simbolo,pl.costo from tb_plan pl join tb_moneda mon on pl.id_moneda = mon.id_moneda";
        $result2 = mysqli_query($conexion, $sql_plan);

        $valor = 0;
        $print = 0;
        $consulta = "SELECT MAX(id_pagos) from tb_pagos";
        $query = mysqli_query($conexion,$consulta);
        
        



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

        #pagonro{
            width: 100px;
        }

        #clientelabel{
            padding-left: 500px;
            padding-top: -10px;
            padding: -50px;
        }
    </style>
</head>
<br>
<br>

<body>
    <div class="col-sm-2">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>

    <div class="col-sm-8">
        <h3 style="text-align: center;">Pagos</h3>

        <span class="boton btn btn-primary" data-toggle="modal" data-target="#new_pago">Nuevo Pago</span>
        <div id="tablepagoload" style="align-content:left;">

        </div>

    </div>

    <!-- MODAL PARA AGREGAR NUEVO PLAN	-->

    <div class="modal fade" id="new_pago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2861a2;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: white;">Nuevo Pago</h4>
                </div>
                <div class="modal-body">


                    <form id="frm_pagos">


                        <?php while ($v = mysqli_fetch_row($query)) : 
                        $valor = $v[0];

                    endwhile;

                    if($valor>0 && $valor!= "null"){
                        $print = $valor + 1;
                    }
                    else {
                        $print = 1;
                    } 


                    if($print < 9){
                        $dato = "000";
                    }else if($print > 9 && $print < 99){
                        $dato = "00";
                    }else if($print > 99 && $print < 999){
                        $dato = "0";
                    }

                    ?>

                        <label>Pago Nro</label>
                        <p></p>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="" value="001-001-001-" readonly>
                            <span class="input-group-addon" style="width: -10%"></span>
                            <input type="text"  class="form-control" id="factura" name="factura" value="<?php echo $dato.$print; ?>" placeholder="">
                        </div>
                        
                        <p></p>
                        <label>Cliente</label>
                        <p></p>
                        <select class="js-example-responsive" style="width: 75%; height: 20%;" name="cliente" id="cliente">
                            <option value="A">Seleccione cliente:</option>
                            <?php while ($view = mysqli_fetch_row($result)) : ?>
                                <option value="<?php echo $view[0] ?>"><?php echo $view[1] .' '. $view[2]. ' - C.I.N° ' . number_format($view[3], 0, ",", "."); ?></option>

                            <?php endwhile; ?>
                        </select>
                        <p></p>
                        <label>Plan</label>
                        <p></p>
                        <select class="js-example-responsive" style="width: 75%; height: 20%;" name="plan" id="plan">
                            <option value="A">Seleccione Plan:</option>
                            <?php while ($view = mysqli_fetch_row($result2)) : ?>
                                <option value="<?php echo $view[0] ?>"><?php echo strtoupper($view[1]).' - '. $view[2].'. '.number_format($view[3], 0, ",", "."); ?></option>

                            <?php endwhile; ?>
                        </select>
                        <p></p>
                        <label>Monto</label>
                        <div class="input-group" style="width:300px;">
                          <span class="input-group-addon ">$</span>
                          <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="monto" name="monto">
                          <span class="input-group-addon">.00</span>
                      </div>

                      <p></p>
                      <label>Proximo Vencimiento</label>
                      <div class="input-group" style="width:300px;">
                          <span class="input-group-addon"></span>
                          <input type="date" class="form-control" id="vencimiento" name="vencimiento">
                          
                      </div>



                  </form>



              </div>
              <div class="modal-footer" style="background-color: #2861a2;">
                <button type="button" id="btnSave" class="btn btn-success" data-dismiss="modal">Guardar</button>
                <a href="pagos.php"> <span class="btn btn-danger">Cancelar</span></a>

            </div>
        </div>
    </div>
</div>

        <!-- *************************************************************************
**************************************************************************
********************************
MODAL PARA ACTUALIZAR                                      -->




</body>

</html>

<!--          funcion para convertir a decimales al tipea -->
<script>

    Number.prototype.format = function(n, x, s, c) {

        let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',

        num = this.toFixed(Math.max(0, ~~n));

        return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));

    };

            // Restricts input for the given textbox to the given inputFilter.

    function setInputFilter(textbox, inputFilter) {

        ["input"].forEach(function(event) {

            textbox.addEventListener(event, function() {

                if (this.id === "monto") {

                    if (this.value !== "") {

                        let str = this.value;

                        let oldstr= str.substring(0, str.length - 1);

                        let millares = ".";

                        let decimales = ".";

                        str = str.split(millares).join("");

                        if (isNaN(str)) {

                            this.value = oldstr;

                        } else {

                            let numero = parseInt(str);

                            this.value = numero.format(0, 3, millares, decimales);

                        }

                    }

                }

            });

        });

    }

    setInputFilter(document.getElementById("monto"), function(value) {

                //declare an object RegExp

        let regex = new RegExp(/^-?\d*$/);

                //test the regexp

        return regex.test(value);

    });

</script>


<!-- --->

<script>
    $(document).ready(function() {


        $('#cliente').select2({
            dropdownParent: $('#new_pago'),
            placeholder: "Seleccione Cliente"
        });

        $('#plan').select2({
            dropdownParent: $('#new_pago'),
            placeholder: "Seleccione Plan"
        });
        

    });
</script>

<!-- FUNCION PARA PERMITIR SOLO NUMEROS--->


<script>
    
    formulario = document.querySelector('#frm_pagos');
    formulario.monto.addEventListener('keypress', function(e) {
        if (!soloNumeros(event)) {
            alertify.warning("Solo se permiten numeros");
            e.preventDefault();
        }})

    //Solo permite introducir numeros.
    function soloNumeros(e) {
        var key = e.charCode;
        return key >= 48 && key <= 57;}
    </script>
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#tablepagoload').load("pagosmod/table_pagos.php");
        
        $('#btnSave').click(function() {

            $vacios = validarFormVacio('frm_pagos');


            if (vacios > 0) {
                alertify.alert("No se permiten campos vacíos");
                return false;
            }

            datos = $('#frm_pagos').serialize();
            $.ajax({

                type: "POST",
                data: datos,
                url: "../process/pagos_actions/n_pago.php",
                success: function(r) {

                    if (r == 1) {
                        alertify.success("Plan Registrado");
                        $('#tablepagoload').load("pagosmod/table_pagos.php");
                        $('#frm_pagos')[0].reset();
                        //DataTable.reload();
                        window.location = "pagos.php";



                    } else {
                        alertify.error("Error/Dato Duplicado");
                    }

                }
            });
        });
    });
</script>

<script>
    function anularpago(idpago) {
        alertify.confirm('¿Desea eliminar?', function() {
            $.ajax({
                type: "POST",
                data: "idpago=" + idpago,
                url: "../process/pagos_actions/anularpago.php",
                success: function(r) {
                    if (r == 1) {
                        $('#tablepagoload').load("pagosmod/table_pagos.php");
                        $('#frm_pagos')[0].reset();
                        DataTable.reload();
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