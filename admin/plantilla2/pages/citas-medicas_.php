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
	    <h1 class="page-header">Crear consulta médica v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <!-- begin row -->
		<div class="row">
		    <!-- begin col-4 -->
			<div class="col-md-4">
	            <!-- begin panel -->
	            <div class="panel panel-inverse" data-sortable-id="index-1">
	                <div class="panel-heading">
	                    <h4 class="panel-title">Médico</h4>
	                </div>
	                <div class="panel-body bg-silver">
	                    		<select class="form-control" id="medicoSelect">
		                        <option>-- Seleccione Médico --</option>
		                        <option value="1" label="DR. Pedro Fernández" selected>DR. Pedro Fernández</option>
		                        <option value="4" label="Dr. Angel Fernández">Dr. Angel Fernández</option>
		                        <option value="5" label="Dr. Roberto Zepeda">Dr. Roberto Zepeda</option>
			                </select>
			                <br><br>
			                <select class="form-control" id="prestacionSelect" style="">
		                        <option value="3" selected>Consulta Dental</option>
		                        <option value="2">Consulta Pediatrica</option>
		                        <option value="6">Consulta Testing</option>
		                    </select>
	                </div>
	            </div>
	            <!-- end panel -->
	            <!-- begin panel -->
	            <div class="panel panel-inverse" data-sortable-id="index-2">
	                <div class="panel-heading">
	                    <h4 class="panel-title">Paciente</h4>
	                </div>
	                <div class="panel-body bg-silver">
	                    	<select class="form-control" id="pacienteSelect" data-live-search="true">
                            <option>-- Seleccione paciente --</option>
                            <option value="9" data-tokens="35772hh - Pedro Fernandez Palominos" selected>Pedro Fernandez Palominos</option>
                            <option value="11" data-tokens="#RUT - Test Demo2 Demo">Test Demo2 Demo</option>
                            <option value="12" data-tokens="#RUT - test paterno materno">test paterno materno</option>
                            <option value="15" data-tokens="#RUT - Mario Carrillo Rivera">Mario Carrillo Rivera</option>
                        </select>
                        <br>
                        <label id="rut_paciente"><b>RUT: </b>35772hh</label>
                        <br>
                        <div class="alert alert-danger" id="cuadro-alertas" style="">
                            <a id="alertas_paciente" data-trigger="hover" data-html="true" data-toggle="alertas" data-placement="top" data-content="<ul><li>24-11-2017-: Cancela para pedro</li><li>30-11-2017-: test</li><li>30-11-2017-: sin motivo</li></ul>" data-original-title="Alertas del paciente">Este paciente tiene 3 alertas</a>
                        </div>
                        <div class="btn-group" style="width:100%">
	                        <a href="#" id="link_editar_paciente" class="btn btn-primary" data-toggle="modal" data-target="#modalEditarPaciente" style="width:50%">EDITAR<br> PACIENTE</a>
			                <a href="#" id="link_sobrecupo" class="pull-right btn btn-warning" data-toggle="modal" data-target="#modalSobreCupo" style="width:50%">AGENDAR<br> SOBRECUPO</a>
                        </div>
	                </div>
	            </div>
	            <!-- end panel -->
	            <!-- begin panel -->
	            <div class="panel panel-inverse" data-sortable-id="index-3">
	                <div class="panel-heading">
	                    <h4 class="panel-title">Fechas disponibles para agendar</h4>
	                </div>
	                <div class="panel-body bg-silver">
	                    		<div class="calendar_horas"></div>
	                </div>
	            </div>
	            <!-- end panel -->
	        </div>
	        <!-- end col-4 -->
	        <!-- begin col-8 -->
			<div class="col-md-8">
	            <!-- begin panel -->
	            <div class="panel panel-inverse" data-sortable-id="index-1">
	                <div class="panel-heading">
	                    <h4 class="panel-title">Disponibilidad de horario</h4>
	                </div>
	                <div class="panel-body bg-silver">
		                <div class="row text-center">
				            <div class="col-md-2">
				                <div class="form-check">
				                    <label class="form-check-label">
				                    <input class="form-check-input filter_status_all" name="radio_all_hora" value="" checked="" type="radio">
				                    Todas
				                    </label>
				                </div>
				            </div>
				            <div class="col-md-3">
				                <div class="form-check">
				                    <label class="form-check-label">
				                    <input class="form-check-input filter_status_disponible" name="radio_all_hora" value="" type="radio">
				                    Disponibles
				                    </label>
				                </div>
				            </div>
				            <div class="col-md-3">
				                <div class="form-check">
				                    <label class="form-check-label">
				                    <input class="form-check-input filter_status_reservado" name="radio_all_hora" value="" type="radio">
				                    Reservadas
				                    </label>
				                </div>
				            </div>
				            <div class="col-md-4">
				                <div class="form-check">
				                    <label class="form-check-label">
				                    <input class="form-check-input filter_status_fuera_horario" name="radio_all_hora" value="" type="radio">
				                    Sobrecupo
				                    </label>
				                </div>
				            </div>
				        </div>
	                    		<table class="table table-responsive table-horarios" id="table-horarios" style="">
					            <thead>
					                <tr>
					                    <th>Hora</th>
					                    <th>Disponibilidad</th>
					                    <th>Observación</th>
					                    <th class="text-center">Acción</th>
					                </tr>
					            </thead>
					            <tbody id="div_horarios">
					                <tr>
					                    <th>09:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente090" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente090" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 09:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario0900" name="comentario0900" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('09','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>09:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente0915" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente0915" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 09:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario0915" name="comentario0915" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('09','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>09:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente0930" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente0930" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 09:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario0930" name="comentario0930" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('09','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>09:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente0945" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente0945" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 09:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario0945" name="comentario0945" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('09','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>10:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente100" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente100" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 10:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1000" name="comentario1000" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('10','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>10:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1015" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1015" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 10:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1015" name="comentario1015" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('10','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>10:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1030" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1030" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 10:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1030" name="comentario1030" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('10','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>10:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1045" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1045" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 10:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1045" name="comentario1045" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('10','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>11:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente110" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente110" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 11:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1100" name="comentario1100" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('11','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>11:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1115" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1115" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 11:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1115" name="comentario1115" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('11','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>11:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1130" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1130" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 11:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1130" name="comentario1130" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('11','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>11:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1145" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1145" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 11:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1145" name="comentario1145" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('11','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>12:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente120" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente120" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 12:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1200" name="comentario1200" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('12','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>12:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1215" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1215" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 12:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1215" name="comentario1215" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('12','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>12:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1230" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1230" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 12:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1230" name="comentario1230" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('12','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>12:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1245" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1245" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 12:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1245" name="comentario1245" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('12','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>13:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente130" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente130" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 13:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1300" name="comentario1300" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('13','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>13:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1315" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1315" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 13:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1315" name="comentario1315" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('13','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>13:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1330" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1330" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 13:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1330" name="comentario1330" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('13','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>13:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1345" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1345" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 13:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1345" name="comentario1345" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('13','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>14:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente140" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente140" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 14:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1400" name="comentario1400" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('14','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>14:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1415" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1415" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 14:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1415" name="comentario1415" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('14','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>14:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1430" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1430" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 14:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1430" name="comentario1430" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('14','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>14:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1445" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1445" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 14:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1445" name="comentario1445" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('14','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>15:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente150" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente150" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 15:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1500" name="comentario1500" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('15','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>15:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1515" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1515" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 15:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1515" name="comentario1515" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('15','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>15:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1530" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1530" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 15:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1530" name="comentario1530" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('15','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>15:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1545" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1545" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 15:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1545" name="comentario1545" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('15','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>16:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente160" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente160" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 16:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1600" name="comentario1600" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('16','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>16:15</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1615" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1615" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 16:15</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1615" name="comentario1615" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('16','15');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>16:30</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1630" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1630" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 16:30</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1630" name="comentario1630" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('16','30');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>16:45</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1645" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1645" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 16:45</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1645" name="comentario1645" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('16','45');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <th>16:00</th>
					                    <td><span class="badge badge-success">DISPONIBLE</span></td>
					                    <td></td>
					                    <td class="text-center">
					                        <button type="button" class="btn btn-outline-secondary txtSeleccioneParaAgendar" disabled="" style="visibility: hidden;">Agendar</button>
					                        <button type="button" class="btn btn-outline-success botonAgendar" href="#" data-toggle="modal" data-target="#modalEditaPaciente1600" style="visibility: visible;">Agendar</button>
					                        <div class="modal fade" id="modalEditaPaciente1600" tabindex="10" role="dialog">
					                            <div class="modal-dialog" role="document">
					                                <div class="modal-content">
					                                    <div class="modal-header">
					                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las 16:00</h5>
					                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <span aria-hidden="true">×</span>
					                                        </button>
					                                    </div>
					                                    <div class="modal-body" style="color:black">
					                                        <div class="form-group col-md-8">
					                                            <label for="nombre" style="color:black">Comentario</label>
					                                            <input style="color:black" class="form-control" id="comentario1600" name="comentario1600" placeholder="Comentario " type="textarea">
					                                        </div>
					                                    </div>
					                                    <div class="modal-footer">
					                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					                                        <button type="button" class="btn btn-primary" onclick="agendar_cita('16','00');" data-dismiss="modal">Agendar</button>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </td>
					                </tr>
					            </tbody>
		        </table>
	                </div>
	            </div>
	            <!-- end panel -->
		</div>
		<!-- end row -->


		        
	</div>
	<!-- end #content -->






	<!---DATEPICKER-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
	<!---SELECTPICKER-->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-es_CL.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
	    		$('[data-toggle="alertas"]').popover(); 
	   
			$('#medicoSelect').selectpicker({
			    liveSearch: true
			});
			
			$('#prestacionSelect').selectpicker({
			    liveSearch: true
			});
			
			$('#pacienteSelect').selectpicker({
			    liveSearch: true
			});
		});
		
		    
		    
		    
        $.fn.datepicker.dates["es"] = {
		    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		    today: "Today",
		    clear: "Clear",
		    format: "mm/dd/yyyy",
		    titleFormat: "MM yyyy", /* Leverages same syntax as "format" */
		    weekStart: 0
		};
	    $(".calendar_horas").datepicker({
		    	forceParse: false,
		    	language: "es",
		        todayHighlight: true,
		        daysOfWeekDisabled: [4] 
		}).on("changeDate", function() {
				var temp = $(this).datepicker("getDate");
				var days = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
				var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
				var d = new Date(temp);
				var fechaSeleccionada = ("0" + d.getDate()).slice(-2) +"-"+ ("0" + (d.getMonth() + 1)).slice(-2)+"-"+ d.getFullYear()
				select_dia_horario(1,fechaSeleccionada);
				//alert(fechaSeleccionada);
		});
			
	</script>
				
<?php
    include('inc/footer.php');
?>
	