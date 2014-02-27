<?php

$student = $_REQUEST['student'];
// Creo un arreglo el 
$lista = array($student['cedula'], $student['nombre'], $student['apellidos'], $student['correo'], $student['telefono']);
 
date_default_timezone_set('America/Costa_Rica');
//Imprimimos la fecha actual dandole un formato
//Buscamos la fecha del sistema para crear el nombre del archivo .CSV
$nameFile = date("dmY").".csv";

//abrir archivo o crear si no exite
$fp = fopen('archivo.csv', 'a');

//guardar linea en archivo
fputcsv($fp, $lista);

//cerrar archivo
fclose($fp);

?>

<script type="text/javascript"> 
if(confirm('Etudiante Ingresado, desea ingresar otro?')) {
    window.location.href = 'index.html';
}

</script>