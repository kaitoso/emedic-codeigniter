



  <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
  <div id="content" class="content mr-220">
      <!-- begin page-header -->
      <h1 class="page-header">Mis clínicas</h1>
      <!-- end page-header -->
      <!-- begin row -->
      <div class="row ">


          <?php foreach ($clinicas as $key) {
         # code...

      ?>

      <div class="col-md-3 col-sm-6">
          <div class="card text-center">
            <div class="card-body">


              <a href="<?php echo  base_url('Docs/set_clinica/'.$key->id); ?>">
                <img src="<?php echo base_url() ?>plantilla2/images/emedic/053-medico-82.svg" class="img-fluid">
                <p class="card-text"><?php echo $key->nombre; ?></p>
              </a>
            </div>
          </div>
             
        </div>

        <?php 
    
               } ?>




  
    

    </div>
  </div>


        
