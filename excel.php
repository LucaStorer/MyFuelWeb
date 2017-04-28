<!DOCTYPE html>

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>

<a href="#" id="test" onClick="fnExcelReport();">download</a>

<?php

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
                    <table class="db-table" id="myTable">
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


<script>

function fnExcelReport() {



    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

    tab_text = tab_text + '<x:Name>Test Sheet</x:Name>';

    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

    tab_text = tab_text + "<table border='1px'>";
    tab_text = tab_text + $('#myTable').html();
    tab_text = tab_text + '</table></body></html>';

    var data_type = 'data:application/vnd.ms-excel';
    
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
            var blob = new Blob([tab_text], {
                type: "application/csv;charset=utf-8;"
            });
            navigator.msSaveBlob(blob, 'Test file.xls');
        }
    } else {
        $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
        $('#test').attr('download', 'Test file.xls');
    }

}


</script>

</body>
</html>