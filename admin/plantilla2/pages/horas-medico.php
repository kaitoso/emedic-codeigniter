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
						<div class="col-md-12">
							<form class="row">
								<div class="col-md-4">
									<h5><strong>Días de descanso</strong></h5>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="dayDo">
										<label class="form-check-label" for="dayDo">Domingo</label>
									</div>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="dayLu">
										<label class="form-check-label" for="dayLu">Lunes</label>
									</div>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="dayMa">
										<label class="form-check-label" for="dayMa">Martes</label>
									</div>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="dayMi">
										<label class="form-check-label" for="dayMi">Miércoles</label>
									</div>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="dayJu">
										<label class="form-check-label" for="dayJu">Jueves</label>
									</div>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="dayVi">
										<label class="form-check-label" for="dayVi">Viernes</label>
									</div>
									<div class="form-group form-check">
										<input type="checkbox" class="form-check-input" id="daySa">
										<label class="form-check-label" for="daySa">Sábado</label>
									</div>
								</div>
								<div class="col-md-8">
									<h5><strong>Horarios</strong></h5>
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntrada"/>
								    </div>
								    <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalida"/>
								    </div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="btn btn-success pull-right">Guardar</button>
								</div>
							</form>
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
	