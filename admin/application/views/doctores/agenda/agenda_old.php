
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />


	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<!-- begin #content -->
	<div id="content" class="content">
	    <!-- begin page-header -->
	    <h1 class="page-header">Agenda médica v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <!-- begin row -->
		<div class="row">
	        <!-- begin col-8 -->
			<div class="col-md-12">
	            <!-- begin panel -->
	            <div class="panel panel-inverse" data-sortable-id="index-1">
	                <div class="panel-heading">
	                    <h4 class="panel-title">Agenda del d&iacute;a</h4>
	                </div>
	                <div class="panel-body bg-silver">

	                	<?php 
                          
                          $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
                          
                          echo form_open('Usuario/agenda/');

                          
                        ?>

                        
		                
		                <select class="form-control" id="medicoSelect" name="docs" >

		                	<option selected="true">-- Seleccione Médico --</option>

		                	<?php foreach ($doctores as $key ) {
                        	# code...
                        ?>
							
							<option value="<?php echo $key->id ?>" label="<?php echo $key->nombre ?>"><?php echo $key->nombre ?></option>
							

							<?php } ?>	        
						</select>
	<br>


                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div id="success"></div>

                            

                            <button type="submit" class="btn btn-xl btn-success">Buscar</button>
                            
                          </div>
                        </div>


						 <?php echo form_close(); ?>

						


						<p>&nbsp;</p>
						

					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#pendientes" data-toggle="tab">Pendientes</a></li>
					        <li><a href="#espera" data-toggle="tab"> En espera</a></li>
					        <li><a href="#consulta" data-toggle="tab"> En consulta</a></li>
					        <li><a href="#cancelada" data-toggle="tab"> Canceladas</a></li>
					        <li><a href="#finalizada" data-toggle="tab"> Terminadas</a></li>

					    </ul>
						<div class="tab-content">
							<?php $this->load->view('usuario/agenda/estados/pendientes'); ?>
							
							<?php $this->load->view('usuario/agenda/estados/espera'); ?>
							
							
							<?php $this->load->view('usuario/agenda/estados/consulta'); ?>
							
							
							
							<?php $this->load->view('usuario/agenda/estados/cancelados'); ?>
							
							<?php $this->load->view('usuario/agenda/estados/finalizada'); ?>
						</div>


					       



					      


		                
	                </div>
	            </div>
	            <!-- end panel -->
		</div>
		<!-- end row -->


		        
	</div>
	<!-- end #content -->

				

	