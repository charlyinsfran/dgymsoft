<?php
  $mysqlDatabaseName = 'd_gymdb';
  $mysqlUserName = 'root';
  $mysqlPassword = '';
  $mysqlHostName = 'localhost';


    date_default_timezone_set('America/Asuncion');
    $fecha = date('Ymd');
  

  // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
  $salida_sql = $fecha . '-' . $mysqlDatabaseName . 'backup'. '.sql';
  //$mysqlExportPath ='Su-nombre-de-archivo-deseado.sql';

  //Por favor, no haga ningún cambio en los siguientes puntos
  //Exportación de la base de datos y salida del status
  $command = 'mysqldump --column-statistics=0 --opt -h' . $mysqlHostName . ' -u' . $mysqlUserName . ' --password="' . $mysqlPassword . '" ' . $mysqlDatabaseName . ' > ' . $salida_sql;
 system($command, $output);


$zip = new ZipArchive(); //Objeto de Libreria ZipArchive

//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
$salida_zip = $mysqlDatabaseName  . 'Respaldo'  . '.zip';

if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) { //Creamos y abrimos el archivo ZIP
    $zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
    $zip->close(); //Cerramos el ZIP
    unlink($salida_sql); //Eliminamos el archivo temporal SQL
    header("Location: $salida_zip"); // Redireccionamos para descargar el Arcivo ZIP
} else {
    echo 'Error'; //Enviamos el mensaje de error
}