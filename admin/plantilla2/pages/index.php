<?php
	include('inc/header.php');
	include('inc/navbar.php');
	include('inc/lateral.php');
?>
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="<?php echo base_url() ?>plantilla2/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>plantilla2/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>plantilla2/assets/plugins/morris/morris.css" rel="stylesheet" />


	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<div id="content" class="content">
	    <!-- begin page-header -->
	    <h1 class="page-header">Dashboard v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <!-- begin row -->
	    <div class="row">
			<div class="col-12">
				<div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
	                <div class="panel-heading p-0">
	                    <div class="panel-heading-btn m-r-10 m-t-10">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                    </div>
	                    <!-- begin nav-tabs -->
	                    <div class="tab-overflow">
							<ul class="nav nav-tabs nav-tabs-inverse" id="tabs_menu">
								<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-success"><i class="fa fa-arrow-left"></i></a></li>
				                <li class="" style="display: none;"><a href="#inicio" data-toggle="tab"><i class="icon-home m-r-5"></i> <span class="hidden-xs">Inicio</span></a></li>
				                <li class="" style="display: none;"><a href="#paciente" data-toggle="tab"><i class="medicon-paciente m-r-5"></i> <span class="hidden-xs">Pacientes</span></a></li>
				                <li class="" style="display: none;"><a href="#medicamentos" data-toggle="tab"><i class="medicon-pill m-r-5"></i> <span class="hidden-xs">Medicamentos</span></a></li>
				                <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-success"><i class="fa fa-arrow-right"></i></a></li>
				            </ul>
	                    </div>
	                </div>
		            <div class="tab-content">
		                <div class="tab-pane fade" id="inicio">
		                    <div class="height-sm" data-scrollbar="true">
		                        Inicio
		                    </div>
		                </div>
		                <div class="tab-pane fade" id="paciente">
		                    <div class="height-sm" data-scrollbar="true">
		                        Pacientes
		                    </div>
		                </div>
		                <div class="tab-pane fade" id="medicamentos">
		                    <div class="height-sm" data-scrollbar="true">
		                        Medicamentos
		                    </div>
		                </div>
		            </div>
                </div>
					
			</div>
	    </div>
	</div>

				
<?php
    include('inc/footer.php');
?>