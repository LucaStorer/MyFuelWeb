<?php

  include('connparam.php');

header('Content-type: application/json; charset=utf-8');

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //  $sql = "SELECT ID,DATE_FORMAT(`DATA`,'%d/%m/%Y') as DATA,`KMTOT`,`LITRI`,`KM`,`EURO`,`EURO_LITRO`,`LITRI_100KM` FROM HISTORY ORDER BY `KMTOT` DESC ";
  $sql = sprintf("SELECT * FROM HISTORY");

  $rs_result = $conn->query($sql);

  //loop through the returned data
  $data = array();
  foreach ($rs_result as $row) {
  	$data[] = $row;
  }

  //free memory associated with result
  $rs_result->close();

  //close connection
  $conn->close();

  //now print the data
  print json_encode($data);



 ?>
