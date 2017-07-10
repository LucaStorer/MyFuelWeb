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


// data insert code starts here.
if(isset($_POST['insert']))
{

  $nome = $_POST['nome'];
  $tipo = $_POST['tipo'];
  $costo = $_POST['costo'];

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO risorse (NOME,  TIPO,COSTO_ORA)
  VALUES ('$nome', '$tipo','$costo')";

  if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";

    ?>
    <script>
    window.location='../home.php'
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
