<?php
	
	if(!isset($argv[1]) ) {
		die("Usar: php {$argv[0]} <json_archivo>\n");
	}
	// Lee el fichero en una variable,
	// y convierte su contenido a una estructura de datos
	$str_datos = file_get_contents($argv[1]); //el archivo .json viene por parametro
	$datosJson = json_decode($str_datos,true);

	$dbhost = $datosJson["BD"]["dbhost"]; 
	$dbuser = $datosJson["BD"]["dbuser"];
	$dbpass = $datosJson["BD"]["dbpass"];
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);

	if(! $conn ) {
	  die('No se pudo conectar a la Base de Datos: ' . mysql_error());
	}

	require_once 'fecha.php';

	$nameFile =$fechaHoy.".csv";

	$fp = fopen ( $nameFile, "r" );//cambiar
	//$first_line = true;
	//$columns_names_array = array();
	$values_array = array();
	//$columns_names = "";
	$i=0;
	while (( $data = fgetcsv ( $fp , 2048, "," )) !== false ) { // Mientras hay líneas que leer...

	    
	    $values_row="";
	    foreach($data as $colum) {
	    	$values_row.="\"".$colum."\",";
	    }
	     
	    $values_array[$i]=substr($values_row,0,-1);
	    $i++;
	}
	
	fclose ( $fp );

	$insertar_sql="";
	foreach($values_array as $campo) {      
    	$insertar_sql .= '('.$campo.'), ';
       
    }
    $insertar_sql = 'INSERT INTO estudiante (cedula, nombre, apellidos, correo, telefono) VALUES '.substr($insertar_sql, 0,-2).'; ';
    //echo $insertar_sql;
    //die();
	mysql_select_db($datosJson["BD"]["dbname"]); ///nombre de la base de datos

	$retval = mysql_query($insertar_sql, $conn );

	if(! $retval )
	{
	  die('ERROR: no se puedo guardar en la Base de Datos ' . mysql_error());
	}
	echo "Datos almacenados correctamente\n";//cambiar
	mysql_close($conn);
?>