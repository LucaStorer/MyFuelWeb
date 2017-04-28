<!DOCTYPE html>

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="icon.png">

    <!-- for FF, Chrome, Opera -->
    <link rel="icon" type="image/png" href="icon.png" sizes="16x16">
    <link rel="icon" type="image/png" href="icon.png" sizes="32x32">

    <!-- for IE -->
    <link rel="icon" type="image/x-icon" href="icon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="icon.ico" />

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="icon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="icon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="icon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="icon.png" />

    <link rel="stylesheet" type="text/css" href="MyFuelCSS\style.css" />
    <link rel="stylesheet" type="text/css" href="MyFuelCSS\Table.css" />
    <link rel="stylesheet" type="text/css" media="only screen and (max-width: 480px), only screen and (max-device-width: 480px)" href="MyFuelCSS\Table-mobile.css" />

    <title>MyFuelApp</title>


</head>

<body>

    <center>
        <div class="MyTable">
<div id="grad1">
            <h1 align="center"> MyFuel </h1>
            <h4 align="center">Ver.: 1.0 </h4>
            <h6 align="center"> 20170403 </h6>
</div>
            <hr>

            <center><input type="button" id="Nuovo" name="Nuovo" value="Nuovo" Onclick="window.location.href='MyFuelNew.html'" style="font-size : 15px;"> <input type="button" id="Aggiorna" name="Aggiorna" value="Aggiorna" Onclick="window.location.href='MyFuelIndex.php'" style="font-size : 15px; "></center>

            <hr>

            <?php

// inizializzazione della sessione
session_start();
// controllo sul valore di sessione
if (!isset($_SESSION['login']))
{
 // reindirizzamento alla homepage in caso di login mancato
 header("Location: MyFuelLogin.php");
}

error_reporting(0);
$servername = "localhost";
$username = "u760134217_luca";
$password = "wcallu86";
$dbname = "u760134217_mf";
$datatable = "HISTORY"; // MySQL table name
$results_per_page = 10; // number of results per page

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>

                <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $results_per_page;
$sql = "SELECT ID,DATE_FORMAT(`DATA`,'%d/%m/%Y') as DATA,`KMTOT`,`LITRI`,`KM`,`EURO`,`EURO_LITRO`,`LITRI_100KM` FROM HISTORY ORDER BY `KMTOT` DESC LIMIT $start_from, ".$results_per_page;
$rs_result = $conn->query($sql); 
?>
                    <table class="db-table">
                        <tr>
                           <!-- <th><strong></strong></th> -->
                            <!-- <th><strong>ID</strong></th> -->
                            <th><strong>Data</strong></th>
                            <th><strong>Chilometri</strong></th>
                            <th><strong>Litri</strong></th>
                            <th><strong>Km Parz.</strong></th>
                            <th><strong>Euro</strong></th>
                            <th><strong>€/l</strong></th>
                            <th><strong>l/100Km</strong></th>

                        </tr>
                        <?php 
 while($row = $rs_result->fetch_assoc()) {
?>
                        <tr>
                           <!-- <td><input type='checkbox' name='check[]' value='...' /></td> -->
                            <!--  <td><? echo $row["ID"]; ?></td> -->
                            <td>
                                <div class="fontColor"><? echo $row["DATA"]; ?></div>
                            </td>
                            <td>
                               <strong> <? echo $row["KMTOT"]; ?> </strong>
                            </td>
                            <td>
                                <? echo $row["LITRI"]; ?>
                            </td>
                            <td>
                                <? echo $row["KM"]; ?>
                            </td>
                            <td>
                                <? echo $row["EURO"]; ?>
                            </td>
                            <td>
                                <? echo $row["EURO_LITRO"]; ?>
                            </td>
                            <td>
                                <? echo $row["LITRI_100KM"]; ?>
                            </td>
                        </tr>
                        <?php 
}; 
?>
                    </table>


                    <?php 
$sql = "SELECT COUNT(ID) AS total FROM ".$datatable;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 



?>
                    <hr>

                    <a href='logout.php'>Click here to log out</a>



        </div>

    </center>

</body>

</html>
