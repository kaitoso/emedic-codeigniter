<?php
    //include('inc/header.php');
     $this->load->view($header); 

    //include('inc/navbar.php');
     $this->load->view($navbar); 
    //include('inc/lateral.php');

     $this->load->view($lateral); 
?>


    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="<?php echo base_url() ?>plantilla2/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>plantilla2/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>plantilla2/assets/plugins/morris/morris.css" rel="stylesheet" />

    <link href="<?php echo base_url() ?>plantilla2/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>plantilla2/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

<?php

      $this->load->view($pagina_interna); 
   // include('inc/footer.php');
?>



                
<?php

      $this->load->view($footer); 
   // include('inc/footer.php');
?>