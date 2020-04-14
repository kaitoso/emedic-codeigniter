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
	                    <h4 class="panel-title">Agenda del d&iacute;a
		                    <ul class="nav nav-pills pull-right" style="margin-top:-10px;margin-bottom:0;">
				                <li><a href="#default-tab-2" data-toggle="tab">En espera por exámen</a></li>
				                <li class="active"><a href="#default-tab-3" data-toggle="tab">En consulta</a></li>
				                <li><a href="#default-tab-4" data-toggle="tab">Canceladas / Terminadas</a></li>
				            </ul>
	                    </h4>
	                </div>
	                <div class="panel-body bg-silver">
					    <div class="tab-content">
					        <div class="tab-pane fade" id="default-tab-2">
						        <h3 class="m-t-0">En espera por exámen</h3>
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
				                    <tbody id="div_citas_espera">
				                    		<tr>
											<td>01</td>
											<td><label class="label label-success">Normal</label>&nbsp;<label class="label label-danger">Pendiente por examen</label></td>
											<td>14:00</td>
											<td>Limpieza dental profunda</td>
											<td>000000</td>
											<td>Mario Alberto Carrillo</td>
											<td>
												<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_pendiente('82','0','8');">Regresar a pendiente</button>
												<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_consulta('82','2','8');">Enviar a consulta</button>
												<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancelar" onclick="abre_modal_cancela(82,'14:00',1)">X</button>
												<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalPago" onclick="abre_modal_pagar_consulta(82,'14:00','Mario Alberto Carrillo','','')" title="Pagar consulta">$</button>
											</td>
										</tr>
				                    </tbody>
				                </table>
					        </div>
					        <div class="tab-pane fade active in" id="default-tab-3">
					        	<div class="menu_sup">
					        		<div class="btn-group text-center pull-right m-t-0">
					        			<a href="#" class="btn btn-success">
											Consultas anteriores
										</a>
										<a href="#" class="btn btn-success">
											Datos del paciente
										</a>
										<a href="#" class="btn btn-success">
											Buscar paciente
										</a>
					        		</div>
					        	</div>
						        <h3 class="m-t-0">Paciente en consulta</h3>
						        <form class="form-inline">
						        	<div class="form-group m-r-15">
									    <label for="cPaciente">Paciente: </label>
									    <p class="form-control-static" id="cPaciente">Mario Alberto Carrillo</p>
									</div>
									<div class="form-group m-r-15">
									    <label for="cRut">Rut: </label>
									    <p class="form-control-static" id="cRut">000000</p>
									</div>
									<div class="form-group m-r-15">
									    <label for="cTipo">Tipo agenda: </label>
									    <p class="form-control-static" id="cTipo"><label class="label label-success">Normal</label></p>
									</div>
									<div class="form-group m-r-15">
									    <label for="cPrestacion">Prestación: </label>
									    <p class="form-control-static" id="cPrestacion">Consulta Dental</p>
									</div>
									<div class="form-group m-r-15">
									    <label for="cObservacion">Observaciones: </label>
									    <p class="form-control-static" id="cObservacion">Limpieza dental profunda</p>
									</div>
						        </form>
						        <p>&nbsp;</p>
						        <ul class="nav nav-tabs">
					                <li class="active"><a href="#consultas" data-toggle="tab">Consulta</a></li>
					                <li><a href="#recetas_certificados" data-toggle="tab">Impresión de recetas y certificados</a></li>
					                <li><a href="#documentos_adjuntos" data-toggle="tab">Documentos adjuntos</a></li>
					            </ul>
					            <div class="tab-content">
						            <div class="tab-pane fade active in" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
						                <div class="card-body">
							                <form class="form-horizontal">
												    <div class="form-group">
												        <label for="cAnamnesis" class="col-sm-2 control-label">Anamnesis: </label>
												        <div class="col-sm-10">
												            <textarea class="form-control" rows="3" id="cAnamnesis"></textarea>
												        </div>
												    </div>
												    <div class="form-group">
												        <label for="cExamenFisico" class="col-sm-2 control-label">Examen físico: </label>
												        <div class="col-sm-10">
												            <textarea class="form-control" rows="3" id="cExamenFisico"></textarea>
												        </div>
												    </div>
												    <div class="form-group">
												        <label for="cDiagnostico" class="col-sm-2 control-label">Diagnóstico: </label>
												        <div class="col-sm-10">
												            <textarea class="form-control" rows="3" id="cDiagnostico"></textarea>
												        </div>
												    </div>
												</form>
						                </div>
						            </div>
						            <div class="tab-pane fade" id="recetas_certificados" role="tabpanel" aria-labelledby="recetas_certificados-tab">
						                <form class="form-horizontal">
								                	<div class="row">
									                	<div class="col-sm-3 m-b-15">
															<label for="cMedicamento">Medicamento: </label>
															<select class="form-control" id="cMedicamento">
																<option>===Seleccionar medicamento===</option>
																<option selected="">Anagen cassara / Locion / Minoxidil</option>
																<option>Anbestrias MAAM / Crema / Antiestrias</option>
																<option>Benzac Ac 5% / Gel / ISDN</option>
																<option>Bersen / 20mg-5ml Suspención / Prednisona</option>
																<option>Fasarax / 10mg-5ml Jarabe/ Hidroxicina</option>
															</select>
														</div>
													    <div class="col-sm-3 m-b-15">
															<label for="cPresentacion">Presentación: </label>
															<input class="form-control" id="cPresentacion" type="text" value="Locion" placeholder="Presentación" disabled>
														</div>
														<div class="col-sm-3 m-b-15">
															<label for="cGenerico">Nombre genérico: </label>
															<input class="form-control" id="cGenerico" type="text" value="Minoxidil" placeholder="Nombre genérico" disabled>
														</div>
														<div class="col-sm-2 m-b-15">
															<label for="cCantidad">Cantidad: </label>
															<input class="form-control" id="cCantidad" type="number" value="0">
														</div>
														<div class="col-sm-1 m-b-15">
															<label>&nbsp;</label>
															<a href="#" class="btn btn-success" style="width: 100%;">
																<span class="glyphicon glyphicon-plus"></span>
															</a>
														</div>
														<hr>
														<div class="col-sm-12 m-b-15">
															<div class="row">
																<div id="cont_rec_izq" class="col-sm-5">
																	<div id="receta_2">
																	    <div class="receta_grupo">
																	    	Anbestrias MAAM / Crema / Antiestrias<br>
																	    	TOTAL 1 UNIDAD<br>
																	    	Aplicar cada 24 hrs
																	    </div>
																	    <div class="receta_grupo">
																	    	Fasarax / 10mg-5ml Jarabe/ Hidroxicina<br>
																	    	TOTAL 1 UNIDAD<br>
																	    	Tomar una cada 8 hrs
																	    </div>
																	</div>
																</div>
																<div id="rec_izq_der" class="col-sm-2">
																	<img id="pasar_der" src="../images/controles.jpg">
																</div>
																<div id="cont_rec_der" class="col-sm-5">
																	<div id="receta_1" class="active">
																	    <div class="receta_grupo">
																	    	Anbestrias MAAM / Crema / Antiestrias<br>
																	    	TOTAL 1 UNIDAD<br>
																	    	Aplicar cada 24 hrs
																	    </div>
																	</div>
																</div>
																<div class="col-sm-12">
																	<div class="btn-group pull-right">
																		<a href="#" class="btn btn-primary">
																			Configurar recetas
																		</a>
																		<a href="#" class="btn btn-success">
																			Imprimir recetas
																		</a>
																	</div>
																</div>
															</div>
														</div>
														<hr>
														<div class="col-sm-12 m-b-15">
															<label for="cIndicaciones">Indicaciones: </label>
															<textarea class="form-control" rows="3" id="cIndicaciones"></textarea>
															<a href="#" class="btn btn-success pull-right m-t-15">
																Imprimir indicaciones
															</a>
														</div>
														<hr>
														<div class="col-sm-12 m-b-15">
															<label for="cResultados">Informe de resultados: </label>
															<textarea class="form-control" rows="3" id="cResultados"></textarea>
															<a href="#" class="btn btn-success pull-right m-t-15">
																Imprimir resultados
															</a>
														</div>
													</div>
											</form>
						            </div>
						            <div class="tab-pane fade" id="documentos_adjuntos" role="tabpanel" aria-labelledby="documentos_adjuntos-tab">
						                <div class="card-body">
							                <table id="tabla-adjuntos" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
											    <thead>
											        <tr>
											            <th>Documento</th>
											            <th>Fecha/Hora</th>
											            <th>Descripción</th>
											            <th>OPCIONES</th>
											        </tr>
											    </thead>
											    <tbody id="div_adjuntos"></tbody>
											</table>
						                </div>
						            </div>
					            </div>
					        </div>
					        <div class="tab-pane fade" id="default-tab-4">
						        <h3 class="m-t-0">Lista de pacientes atendidos / cancelados</h3>
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
					        <div class="btn-group pull-right">
						        <button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_espera_examen('105','1','8');">Pendiente por Examen</button>&nbsp;&nbsp;
								<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_terminada('105','3','8');">Terminar Consulta</button>
					        </div>
					        <div class="clearfix m-b-10">&nbsp;</div>
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


<script>
	$('#pasar_der').on('click', function(){
	    $("#cont_rec_izq > div").detach().appendTo('#cont_rec_der');
	});
</script>