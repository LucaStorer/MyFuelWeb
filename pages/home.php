
<?php

include('include/head.php');

?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">

   <div class="col-lg-12">

        <ul class="nav nav-tabs">
           <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
           <li><a data-toggle="tab" href="#statistics">statistics</a></li>

         </ul>

         <div class="tab-content" style="padding:15px;">
           <div id="home" class="tab-pane fade in active">

             <div class="col-lg-12">
         <?php
         include('subpage/table.php');
         ?>
           </div>

           </div>
           <div id="statistics" class="tab-pane fade">

             <div class="col-lg-12">
         <?php
         include('subpage/statistic.php');
         ?>
           </div>

           </div>

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
