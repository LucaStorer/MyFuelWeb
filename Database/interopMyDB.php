<?php

  include('connparam.php');

function selectreq($tablename)
{

  include('connparam.php');


  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //  $sql = "SELECT ID,DATE_FORMAT(`DATA`,'%d/%m/%Y') as DATA,`KMTOT`,`LITRI`,`KM`,`EURO`,`EURO_LITRO`,`LITRI_100KM` FROM HISTORY ORDER BY `KMTOT` DESC ";
  $sql = "SELECT * FROM $tablename";

  $rs_result = $conn->query($sql);

  return $rs_result;
}

function selectKmPrecedenti($tablename)
{

  include('connparam.php');


  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //  $sql = "SELECT ID,DATE_FORMAT(`DATA`,'%d/%m/%Y') as DATA,`KMTOT`,`LITRI`,`KM`,`EURO`,`EURO_LITRO`,`LITRI_100KM` FROM HISTORY ORDER BY `KMTOT` DESC ";
  $sql = "SELECT MAX(`KMTOT`) as KMTOT FROM $tablename";

  $rs_result = $conn->query($sql);

  return $rs_result;
}

if(isset($_POST['delete']))
{

  $idrecord =  $_POST['ID'];

  include('connparam.php');


  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //   $sql = "DELETE FROM $tablename WHERE ID_CLIENTE = $id";
  $sql = "DELETE FROM `u760134217_mf`.`HISTORY` WHERE `HISTORY`.`ID` = $idrecord";

  if (mysqli_query($conn, $sql)) {
     echo "Record eliminato con successo";

  } else {
    ?>
    <script>
    alert('Errore eliminazione');
    alert('<? echo "Error: " . $sql . "<br>" . mysqli_error($conn); ?>');
    //    window.location='../Mypages/interventi.php'
    </script>
    <?php
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);

}


// data insert code starts here.
if(isset($_POST['insertprodotto']))
{

  $DATE = $_POST['datepicker'];
	$KMTOT = $_POST['km'];
	$LITRI = $_POST['litri'];
	$KM = $_POST['kmparz'];
	$EURO = $_POST['euro'];
	$EURO_KM = $_POST['eurokm'];
	$EURO_LITRO = $_POST['eurolitro'];
	$LITRI_100KM = $_POST['litri100km'];
	$PARZIALE = 0; //$_POST['PARZIALE'];


  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO `u760134217_mf`.`HISTORY` (`DATA`, `KMTOT`,`LITRI`,`KM`,`EURO`,`EURO_KM`,`EURO_LITRO`,`LITRI_100KM`,`PARZIALE`)
  				VALUES (STR_TO_DATE( '$DATE',   '%d/%m/%Y' ),'$KMTOT','$LITRI','$KM','$EURO','$EURO_KM','$EURO_LITRO','$LITRI_100KM','$PARZIALE');";

  // $sql = "INSERT INTO risorse (NOME,  TIPO,COSTO_ORA)
  // VALUES ('$nome', '$tipo','$costo')";

  if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";

    ?>
    <script>
    window.location='../pages/home.php'
    </script>
    <?php
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    ?>
    <script>
    alert('Errore inserimento Dati');
    window.location='../home.php'
    </script>
    <?php

  }

  mysqli_close($conn);

}else{

}



?>
