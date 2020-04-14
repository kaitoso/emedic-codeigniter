<?php
	include('inc/header.php');
	include('inc/navbar.php');
?>


	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<div id="content" class="content mr-220">
	    <!-- begin page-header -->
	    <h1 class="page-header">Mis clínicas</h1>
	    <!-- end page-header -->
	    <!-- begin row -->
	    <div class="row ">
			
			 <?php 
                        if (isset($clinicas) and is_array($clinicas)) {
                            # code...
                        

                        foreach ($clinicas as $key ) {
                        # code...
                     ?>

            <?php if ($key->id%2==1) {
            	# code...
           ?>

			<div class="col-md-3 col-sm-6">
				<div class="card text-center">
					<div class="card-body">
						<a href="#">
							<img src="../images/emedic/053-medico-82.svg" class="img-fluid">
							<p class="card-text"><?php echo $key->nombre; ?></p>
						</a>
					</div>
				</div>
			</div>

			<?php } ?>
			
	 		<?php if ($key->id%2==0) {
             	# code...
              ?>
			<div class="col-md-3 col-sm-6">
				<div class="card text-center">
					<div class="card-body">
						<a href="#">
							<img src="../images/emedic/044-medico-89.svg" class="img-fluid">
							<p class="card-text"><?php echo $key->nombre ?></p>
						</a>
					</div>
				</div>
			</div>



			<?php } ?>
				
				<?php } ?>
			
			</div>
		</div>
	

				
<?php
    include('inc/footer.php');
?>