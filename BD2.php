<?php
	$dbhost = 'localhost';  //$dbhost = 'localhost:3036';
	$dbuser = 'root';
	$dbpass = '12345';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);

	if(! $conn ) {
	  die('Could not connect: ' . mysql_error());
	}

	if(!isset($argv[1]) ) {
		die("Usage: php {$argv[0]} <csv_file>\n");
	}

	$fp = fopen ( $argv[1] , "r" );//cambiar
	$first_line = true;
	$columns_names_array = array();
	$values_array = array();
	$columns_names = "";
	$i=0;
	while (( $data = fgetcsv ( $fp , 2048, ";" )) !== false ) { // Mientras hay líneas que leer...

	    if($first_line){
	    	$columns_names_array = $data;

	    	foreach($columns_names_array as $colum) {
		       $columns_names.=$colum.",";
		    }
	    	$first_line = false;
	    	continue;
	    }
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
    $insertar_sql = 'INSERT INTO estudiantes ('.substr($columns_names, 0,-1).') VALUES '.substr($insertar_sql, 0,-2).'; ';
    //echo $insertar_sql;
    //die();
	mysql_select_db('proyectoweb1');

	$retval = mysql_query($insertar_sql, $conn );

	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	echo "Entered data successfully\n";
	mysql_close($conn);
?>