<?php 
  require_once('./common/header.php');
  require_once('./common/left-menu.php');
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
          <?php require_once('./../src/components/category/list.php'); ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php  
      require_once('./common/footer.php');
  ?>