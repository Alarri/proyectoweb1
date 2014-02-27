<?php
// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
date_default_timezone_set('America/Costa_Rica');
//Imprimimos la fecha actual dandole un formato
$nameFile =date("dmY").".csv";
echo $nameFile;
?>