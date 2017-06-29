<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyFuel 2.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="img/favicon.ico">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

  <!-- DataTables Responsive CSS -->
  <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


  <!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- <script src="../../bootstrap/js/bootstrap.min.js"></script> -->

  <!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>


<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet" href="dist/css/AdminLTE.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
page. However, you can choose any other skin. Make sure you
apply the skin class to the body tag so the changes take effect.
-->
<link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">

</head>

<body class="  skin-purple sidebar-collapse ">

  <?php

  // inizializzazione della sessione
  session_start();

  // controllo sul valore di sessione
  if (!isset($_SESSION['login']))
  {
    // reindirizzamento alla homepage in caso di login mancato
   header("Location: login.php");

  }else{

    $login_id =   $_SESSION['login'];
    $login_name =  $_SESSION['name'];


  };

  ?>


  <header class="main-header">

    <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>My</b>F</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>MyFuel </b>2.0</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="Database/logout.php" ><i class="fa fa-sign-out"></i></a>
              </li>

            </ul>
          </div>
        </nav>
      </header>

  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <div class="row">

          <div class="col-lg-12">

            <?php

            include('Database/interopMyDB.php');

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
                        € \ Km
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    while($rowATRI = $rs_resultATRI->fetch_assoc()) {
                      ?>
                      <tr>

                        <td>
                          <button type="button" class="btn pull-default btn-danger btn-xs" href="#" onclick="deleterecordAttRis(<? echo $idat; ?> ,<? echo $rowATRI["ID_RISORSA"]; ?>);return false;">
                            <i class="fa fa-times fa-fw"></i>
                          </button>
                        </td>
                        <td>
                <button type="button" class="btn pull-default btn-purple btn-xs" href="#" data-toggle="modal"
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
                          <? echo $rowATRI["EURO_KM"]; ?>
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

  <script src="js/home.js"></script>

<?php

  include('subpage/footer.php');

    ?>
