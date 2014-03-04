<?php

$student = $_REQUEST['student'];
// Creo un arreglo el 
$lista = array($student['cedula'], $student['nombre'], $student['apellidos'], $student['correo'], $student['telefono']);
 
require_once 'fecha.php';

$nameFile =$fechaHoy.".csv";

//abrir archivo o crear si no exite
$fp = fopen($nameFile, 'a');

//guardar linea en archivo
fputcsv($fp, $lista);

//cerrar archivo
fclose($fp);

?>

<script type="text/javascript"> 
if(confirm('Estudiante Ingresado, desea ingresar otro?')) {
    window.location.href = 'index.html';
}

</script>