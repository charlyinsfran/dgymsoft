<?php 

session_start();
$valor = $_GET['dato'];


$nombrecliente = "";
$cedula = "";
$nro_factura = "";
$plan = "";
$costo = "";
$moneda = "";
$fechapago = "";
$vencimiento = "";

/*echo "<pre>";
print_r($_REQUEST);
echo "<pre>";*/

if($valor != ""){
    
    imprimir();
}




function imprimir(){

	# Incluyendo librerias necesarias #
    require "../libraries/fpdf/code128.php";
    include "../class/conexion.php";

    $c = new conectar();
    $conexion = $c->conexion();

    $valor = $_REQUEST['dato'];

    $ultimopago = "SELECT max(nro_pago) FROM tb_pagos";
    $ret_ultimopago = mysqli_query($conexion,$ultimopago);

    while ($vista_ultimopago = mysqli_fetch_row($ret_ultimopago)) {
        $pago_id= $vista_ultimopago[0];
    }

    //--------------------------------------------------------

    $sql = "SELECT p.nro_pago,c.cedula,c.nombre,c.apellido,pl.descripcion,mon.simbolo,pl.costo,p.fecha_actual,p.validohasta from tb_pagos p 
        join tb_clientes c on p.tb_clientes = c.id_clientes
        join tb_plan pl on pl.idtb_plan = p.tb_plan
        join tb_moneda mon on mon.id_moneda = pl.id_moneda where p.nro_pago = '$valor'";
        $result = mysqli_query($conexion, $sql);

    while ($vista = mysqli_fetch_row($result)) {
        $nro_factura = $vista[0];
        $cedula = $vista[1];
        $nombrecliente = $vista[2].' '.$vista[3];
        $plan = $vista[4];
        $costo = $vista[6];
        $moneda = $vista[5];
        $fechapago = $vista[7];
        $vencimiento = $vista[8];

    }





    $pdf = new PDF_Code128('P','mm',array(80,190));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    



    # Encabezado y datos de la empresa #
     $image1 = "../pictures/images/home.png";
    $pdf->Image($image1, 25, 0, 30, 30);
   $pdf->Ln(20);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Nombre de empresa")),0,'C',false);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","RUC: 0000000000"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Direccion San Salvador, El Salvador"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Email: correo@ejemplo.com"),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    date_default_timezone_set('America/Asuncion');
    $fecha = date('d/m/Y H:i:s');

    
    $cajero = $_SESSION['usuario'];

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".$fecha),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja Nro: 1"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: ".strtoupper($cajero)),0,'C',false);
    $pdf->SetFont('Arial','B',10);

    if($valor < 10){
        $mostrar_factura = "0000".$valor;
    }else if($valor > 9 && $valor < 100){
        $mostrar_factura = "000".$valor;
    }



    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Factura Nro: ".$mostrar_factura)),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cliente: ".$nombrecliente),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Documento: ".number_format($cedula, 0, ",", ".")),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Tipo de Plan: ".strtoupper($plan)),0,'C',false);
    $pdf->Ln(3);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    # Tabla de productos #
    
    $pdf->Cell(19,5,iconv("UTF-8", "ISO-8859-1","Precio"),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","Descuento"),0,0,'C');
    $pdf->Cell(28,5,iconv("UTF-8", "ISO-8859-1","Total"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

   
        /*----------  Detalles de la tabla  ----------*/
        
       
        $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1",$moneda.' '.number_format($costo, 0, ",", ".")),0,0,'C');
        $pdf->Cell(22,4,iconv("UTF-8", "ISO-8859-1","0"),0,0,'C');
        $pdf->Cell(28,4,iconv("UTF-8", "ISO-8859-1",$moneda.' '.number_format($costo, 0, ",", ".")),0,0,'C');
        $pdf->Ln(4);
        
        /*----------  Fin Detalles de la tabla  ----------*/
    


    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

  

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$moneda.' '.number_format($costo, 0, ",", ".")),0,0,'C');
    $pdf->Ln(10);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Para poder realizar un reclamo o reembolso debe de presentar este ticket ***"),0,'C',false);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su preferencia - DGYMSOFT"),'',0,'C');

    $pdf->Ln(5);

    # Codigo de barras #
     $pdf->Ln(5);
    $pdf->Code128(5,$pdf->GetY(),"Factura: ".$mostrar_factura." P-> ".$plan,70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',10);
    //$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);
    $pdf->Ln(5);
   
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_Nro_1.pdf",true);

    
}




?>