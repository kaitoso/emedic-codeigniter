<?php
	include('inc/header.php');
	include('inc/navbar.php');
	include('inc/lateral.php');
?>
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="../assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />


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
		                
		                <select class="form-control" id="medicoSelect" onchange="#">
							<option>-- Seleccione Médico --</option>
							<option value="1" label="DR. Pedro Fernández">DR. Pedro Fernández</option>
							<option value="4" label="Dr. Angel Fernández">Dr. Angel Fernández</option>
							<option value="5" label="Dr. Roberto Zepeda">Dr. Roberto Zepeda</option>	        
						</select>
						<p>&nbsp;</p>
						

					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#default-tab-1" data-toggle="tab">Pendientes</a></li>
					        <li><a href="#default-tab-2" data-toggle="tab"> En espera</a></li>
					        <li><a href="#default-tab-3" data-toggle="tab"> En consulta</a></li>
					        <li><a href="#default-tab-4" data-toggle="tab"> Canceladas / Terminadas</a></li>
					    </ul>
					    <div class="tab-content">
					        <div class="tab-pane fade active in" id="default-tab-1">
					            <h3 class="m-t-10">Lista de pacientes pendientes</h3>
								<table id="tabla-citas-hoy" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
								    <thead>
								        <tr>
								            <th>ID_Agenda</th>
								            <th>Tipo agenda</th>
								            <th>Hora agenda</th>
								            <th>Observaciones</th>
								            <th>Rut</th>
								            <th>Paciente</th>
								            <th>OPCIONES</th>
								        </tr>
								    </thead>
								    <tbody id="div_citas"></tbody>
								</table>
					        </div>
					        <div class="tab-pane fade" id="default-tab-2">
						        <h3 class="m-t-10">Lista de pacientes en espera</h3>
					            <table id="tabla-citas-espera" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
			                     <thead>
			                        <tr>
			                           <th>ID_Agenda</th>
			                           <th>Tipo agenda</th>
			                           <th>Hora agenda</th>
			                           <th>Observaciones</th>
			                           <th>Rut</th>
			                           <th>Paciente</th>
			                           <th>OPCIONES</th>
			                        </tr>
			                     </thead>
			                     <tbody id="div_citas_espera"></tbody>
			                  </table>
					        </div>
					        <div class="tab-pane fade" id="default-tab-3">
						        <h3 class="m-t-10">Paciente en consulta</h3>
								<table id="tabla-citas-consulta" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
								    <thead>
								        <tr>
								            <th>ID_Agenda</th>
								            <th>Tipo agenda</th>
								            <th>Hora agenda</th>
								            <th>Observaciones</th>
								            <th>Rut</th>
								            <th>Paciente</th>
								            <th>OPCIONES</th>
								        </tr>
								    </thead>
								    <tbody id="div_citas_consulta"></tbody>
								</table>
					        </div>
					        <div class="tab-pane fade" id="default-tab-4">
						        <h3 class="m-t-10">Lista de pacientes atendidos / cancelados</h3>
					            <table id="tabla-citas-terminadas" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
								    <thead>
								        <tr>
								            <th>ID_Agenda</th>
								            <th>Tipo agenda</th>
								            <th>Hora agenda</th>
								            <th>Observaciones</th>
								            <th>Rut</th>
								            <th>Paciente</th>
								            <th>OPCIONES</th>
								        </tr>
								    </thead>
								    <tbody id="div_citas_terminadas"></tbody>
								</table>
					        </div>
					    </div>

		                
	                </div>
	            </div>
	            <!-- end panel -->
		</div>
		<!-- end row -->


		        
	</div>
	<!-- end #content -->

				
<?php
    include('inc/footer.php');
?>
	