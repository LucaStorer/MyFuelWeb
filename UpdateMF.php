<?php
	$host='localhost';
	$user='u760134217_luca';
	$password='wcallu86';
	
	$connection = mysql_connect($host,$user,$password);
	
	$ID = $_POST['ID'];	

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
			$query = "UPDATE `u760134217_mf`.`HISTORY` SET `DATA`='$DATE',`KMTOT`='$KMTOT',`LITRI`='$LITRI',`KM`='$KM',`EURO`='$EURO',`EURO_KM`='$EURO_KM',`EURO_LITRO`='$EURO_LITRO',`LITRI_100KM`='$LITRI_100KM',`PARZIALE`='$PARZIALE' WHERE `ID` = $ID;";
			mysql_query($query, $connection) or die(mysql_error());
			
			echo 'Successfully update.';
			echo $query;
		}
	}
?>	