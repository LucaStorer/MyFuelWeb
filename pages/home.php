
<?php

include('include/head.php');

?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">

        <div class="col-lg-12">

          <?php

          include('../Database/interopMyDB.php');

          $rs_resultATRI = selectreq("HISTORY");
          ?>

          <div class="box box-solid box-purple">
            <div class="box-header">
              <h3 class="box-title">Rifornimenti</h3>
              <button type="button" class="btn pull-right btn-purple btn-xs" data-toggle="modal" data-target="#ModalNew"><i class="fa fa-plus-circle"></i> Aggiungi</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dtrifornimento" >

                <thead>
                  <tr>
                    <th style="width:5px"></th>
                    <th style="width:5px"></th>
                    <th>
                      Data
                    </th>
                    <th>
                      <strong>Km totali</strong>
                    </th>
                    <th>
                      Litri
                    </th>
                    <th>
                      Km Parziali
                    </th>
                    <th>
                      Totale (€)
                    </th>
                    <th>
                      €\Km
                    </th>
                    <th>
                      €\Litro
                    </th>
                    <th>
                      Litri 100Km
                    </th>
                    <th>
                      Pieno
                    </th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  while($rowATRI = $rs_resultATRI->fetch_assoc()) {
                    ?>
                    <tr>

                      <td>
                        <button type="button" class="btn pull-default btn-danger btn-xs" style="color:white;" href="#" onclick="deleterecordAttRis(<? echo $idat; ?> ,<? echo $rowATRI["ID_RISORSA"]; ?>);return false;">
                          <i class="fa fa-times fa-fw"></i>
                        </button>
                      </td>
                      <td>
                        <button type="button" class="btn pull-default btn-purple btn-xs"style="color:white;" href="#" data-toggle="modal"
                        data-target="#ModalMod"
                        data-idrecord="<? echo $row["ID"]; ?>"
                        data-nome="<? echo $row["NOME"]; ?>"
                        data-tipo="<? echo $row["TIPO"]; ?>"
                        data-costo="<? echo $row["COSTO_ORA"]; ?>">
                        <i class="fa fa-edit fa-fw"></i>
                      </button>

                    </td>
                    <td>
                      <?  echo $rowATRI["DATA"]; ?>
                    </td>

                    <td>
                      <div class="fontColor">
                        <strong>
                          <?  echo $rowATRI["KMTOT"]; ?>
                        </strong>
                      </div>
                    </td>
                    <td>
                      <? echo $rowATRI["LITRI"]; ?>
                    </td>
                    <td>
                      <? echo $rowATRI["KM"]; ?>
                    </td>
                    <td>
                      <? echo $rowATRI["EURO"]; ?>
                    </td>
                    <td>
                      <?php
                      if($rowATRI["PARZIALE"] == '1'){
                        echo "-";
                      }else{
                        echo $rowATRI["EURO_KM"];
                      };
                      ?>
                    </td>
                    <td>
                      <? echo $rowATRI["EURO_LITRO"]; ?>
                    </td>
                    <td>
                      <?php
                      if($rowATRI["PARZIALE"] == '1'){
                        echo "-";
                      }else{
                        echo $rowATRI["LITRI_100KM"];
                      };
                      ?>
                    </td>
                    <td>
                      <?php
                      if($rowATRI["PARZIALE"] == '1'){
                        ?>
                        <i class="fa  fa-tachometer  text-center fa-fw" style="color:lightgrey;" value=0></i>
                        <?php
                      }else{
                        ?>
                        <i class="fa   fa-tachometer  text-center fa-fw"value=1></i>
                        <?php
                      };
                      ?>
                    </td>
                  </tr>
                  <?php
                };
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>
  </section>
</div>
</div>

<?php

include('subpage/modal.php');

?>

<script src="../js/home.js"></script>

<?php

include('include/footer.php');

?>
