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
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


  <!-- jQuery 2.2.3 -->
  <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- <script src="../../bootstrap/js/bootstrap.min.js"></script> -->


</head>


<body class="hold-transition lockscreen">

  <!--  Parte di login -->

  <?php
  session_set_cookie_params(0);
  // inizializzazione della sessione
  session_start();
  // se la sessione di autenticazione
  // è già impostata non sarà necessario effettuare il login
  // e il browser verrà reindirizzato alla pagina di scrittura dei post
  if (isset($_SESSION['login']))
  {
    // reindirizzamento alla homepage in caso di login mancato
    header("Location: home.php");
  }
  // controllo sul parametro d'invio
  if(isset($_POST['submit']) && (trim($_POST['submit']) == "Login"))
  {


    // controllo sui parametri di autenticazione inviati
    if( !isset($_POST['username']) || $_POST['username']=="" )
    {
      echo "Attenzione, inserire la username.";
    }
    elseif( !isset($_POST['password']) || $_POST['password'] =="")
    {
      echo "Attenzione, inserire la password.";
    }else{
      // validazione dei parametri tramite filtro per le stringhe
      $login_name = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
      $login_password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
      $login_password = sha1($login_password);


      include('Database/connparam.php');


      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql ="SELECT * FROM user_info WHERE `user_name` = " . "'" . $login_name . "'" . " AND `password` = " . "'" . $login_password . "'" ;

      $rs_result = $conn->query($sql);

      $row_cnt = $rs_result->num_rows;

      //  printf(" Result set has %d rows.\n", $row_cnt);


      // controllo sul risultato dell'interrogazione
      if($row_cnt === 0)
      {

        // reindirizzamento alla login in caso di insuccesso
        header("Location: login.php");

      }else{


        $row = $rs_result->fetch_assoc();

        // echo  $row["ID"];
        //
        //
        //       printf(" Result set  %d .\n",  $row["ID"]);
        //



        // chiamata alla funzione per l'estrazione dei dati
        //  $res =  $data->estrai($auth);
        // creazione del valore di sessione
        $_SESSION['login'] = $row["ID"];
        $_SESSION['name'] = $row["name"];
        $_SESSION['login_password'] = $row["password"];
        $_SESSION['avatar'] = $row["avatar"];

        echo   $_SESSION['name'];
        echo   $_SESSION['avatar'];

        include ('../Database/logDB.php');
        $LogDB = new LogDB();
        $LogDB->InsertLog($_SESSION['login'],"ACCESS","info","LOGIN","","SUCCESS");

        // disconnessione da MySQL
        //  $data->disconnetti();
        // reindirizzamento alla pagina di amministrazione in caso di successo
        header("Location: home.php");
      }

    }
  }else{
    // form per l'autenticazione
    ?>



    <!--  -->





    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="#"><b>MyFuel</b>2.0</a>
      </div>
      <!-- User name -->
      <!-- <div class="lockscreen-name">John Doe</div> -->

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="img/favicon.png" alt="User Image" style="height:80px; width:80px;">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="input-group">
            <input type="text" name="username" class="form-control" placeholder="name" required>

            <!-- <div class="input-group-btn">
            <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
          </div> -->
        </div>
        <div class="input-group">
          <input type="password" name ="password" class="form-control" placeholder="password" required>

          <div class="input-group-btn">
            <button type="submit" name="submit" class="btn"  value="Login"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <!-- <div class="help-block text-center">
    Enter your password to retrieve your session
  </div>
  <div class="text-center">
  <a href="login.html">Or sign in as a different user</a>
</div> -->
<div class="lockscreen-footer text-center">
  Copyright &copy; 2017 <b><a href="#" class="text-black">Luca Storer</a></b><br>
  All rights reserved
</div>
</div>
<!-- /.center -->

<?php

};

?>


</body>
</html>
