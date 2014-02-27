<?php

$linea = array('205690979', 'Alberth', 'Arrieta Alfaro', 'alberth.arrieta@gmail.com', '88546771')
$lista = array ($linea, $linea);

$fp = fopen('archivo.csv', 'w');

foreach ($lista as $campos) {
    fputcsv($fp, $campos);
}

fclose($fp);
?>