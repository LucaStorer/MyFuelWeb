<?php
	$host='localhost';
	$user='u760134217_luca';
	$password='wcallu86';
	
	$connection = mysql_connect($host,$user,$password);
	
	$ID = $_POST['ID'];	
	
	if(!$connection){
		die('Connection Failed');
	}
	else{
		$dbconnect = @mysql_select_db('u760134217_mf', $connection);
		
		if(!$dbconnect){
			die('Could not connect to Database');
		}
		else{
			$query = "DELETE FROM `u760134217_mf`.`HISTORY` WHERE `HISTORY`.`ID` = $ID;";
			mysql_query($query, $connection) or die(mysql_error());
			
			echo 'Successfully Delete.';
			echo $query;
		}
	}
?>	