<?php
	$host='localhost';
	$user='u760134217_luca';
	$password='wcallu86';
	
	$connection = mysql_connect($host,$user,$password);
	
	
	$DATE = $_POST['DATE'];
	$KMTOT = $_POST['KMTOT'];
	$LITRI = $_POST['LITRI'];
	$KM = $_POST['KM'];
	$EURO = $_POST['EURO'];
	$EURO_KM = $_POST['EURO_KM'];
	$EURO_LITRO = $_POST['EURO_LITRO'];
	$LITRI_100KM = $_POST['LITRI_100KM'];
	$PARZIALE = $_POST['PARZIALE'];	
	
	if(!$connection){
		die('Connection Failed');
	}
	else{
		$dbconnect = @mysql_select_db('u760134217_mf', $connection);
		
		if(!$dbconnect){
			die('Could not connect to Database');
		}
		else{
			$query = "INSERT INTO `u760134217_mf`.`HISTORY` (`DATA`, `KMTOT`,`LITRI`,`KM`,`EURO`,`EURO_KM`,`EURO_LITRO`,`LITRI_100KM`,`PARZIALE`)
				VALUES ('$DATE','$KMTOT','$LITRI','$KM','$EURO','$EURO_KM','$EURO_LITRO','$LITRI_100KM','$PARZIALE');";
			mysql_query($query, $connection) or die(mysql_error());
			
			echo 'Successfully added.';
			echo $query;
		}
	}
?>	