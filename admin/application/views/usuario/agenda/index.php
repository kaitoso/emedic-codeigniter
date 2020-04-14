
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<style>
		 /* Style the tab */
		.tab {
		    overflow: hidden;
		    background-color: #FFFFFF;
		    margin-bottom: 25px;
		    -webkit-transform: translateZ(0);
		    -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		    -moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		    -webkit-border-radius: 3px;
		    -moz-border-radius: 3px;
		    border-radius: 3px;
		}
		
		/* Style the buttons that are used to open the tab content */
		.tab button {
		    background-color: inherit;
		    float: left;
		    border: none;
		    outline: none;
		    cursor: pointer;
		    padding: 14px 16px;
		    transition: 0.3s;
		    display: none;
		}
		
		/* Change background color of buttons on hover */
		.tab button:hover {
		    background-color: #ddd;
		}
		
		/* Create an active/current tablink class */
		.tab button.active {
		    background-color: #ccc;
		}
		
		/* Style the tab content */
		.tabcontent {
		    display: none;
		    border-top: none;
		} 
		
		.tabcontent {
		    animation: fadeEffect 1s; /* Fading effect takes 1 second */
		}
		
		
		/*/======================================================================
		SELECCIONAR PACIENTE
		======================================================================/*/
		#nav_lateral {
			position: -webkit-sticky;
		    position: sticky;
		    top: 7.3125rem;
		    height: calc(100vh - 7.3125rem);
		    overflow-y: auto;
		}
		
		
		
		
		/* Go from zero to full opacity */
		@keyframes fadeEffect {
		    from {opacity: 0;}
		    to {opacity: 1;}
		}
	</style>


	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<!-- begin #content -->
	<div id="content" class="content">
	    <!-- begin page-header -->
	    <h1 class="page-header">Agenda médica v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <div class="tab">
	    	<button class="tablinks" onclick="openAjaxInfo(event, 'inicio')" id="inicio_">Inicio</button>
	    	<button class="tablinks" onclick="openAjaxInfo(event, 'pacientes')" id="pacientes_">Pacientes</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'citas')" id="citas_">Agenda</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'citas_del_dia')" id="citas_del_dia_">Citas del día</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'consultas_del_dia')" id="consultas_del_dia_">Consultas del día</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'medicinas')" id="medicinas_">Medicamentos</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'citas_medico')" id="citas_medico_">Reportes</button>
		</div>
	    <!-- begin row -->
	    <div class="row tabcontent" id="inicio"></div>
	    <div class="row tabcontent" id="pacientes"></div>
		<div class="row tabcontent" id="citas"></div>
		<div class="row tabcontent" id="citas_del_dia"></div>
		<div class="row tabcontent" id="consultas_del_dia"></div>
		<div class="row tabcontent" id="medicinas"></div>
		<div class="row tabcontent" id="citas_medico"></div>
	</div><!-- end #content -->

	<script>
		var medico_id =  <?php echo $_SESSION['user_id']; ?>;
	</script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/agenda_citas.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/usuario_pacientes.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/notificaciones.js"></script>
	<script>
		
	</script>
	
	<!-- ================== MODAL AGENDAR CITA ================== -->
	<div class="modal fade" id="modal_agendar_cita" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_agendar_cita" style="float: left;">Agendar cita a las: <span id="hora_agendado" style="color: red;"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario" placeholder="Comentario "></textarea>
                    </div>
                    <div class="form-group form-check">
					    <input type="checkbox" class="form-check-input" id="checkMail" value="0" onclick="enviaMail(this.value)">
					    <label class="form-check-label" for="checkMail">Enviar por correo</label>
				    </div>
                    <div class="form-group" id="checked_mail" style="display:none;">
                        <input type="email" class="form-control" id="email_" name="email_" placeholder="Correo electrónico">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-success btn_agendado btn-sm" onclick="agendar_cita();">Agendar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ================== MODAL AGENDAR CITA ================== -->
	
	
	<!-- ================== MODAL AGENDAR SOBRECUPO ================== -->
	<div class="modal fade" id="modalSobreCupo" tabindex="10" role="dialog">
	    <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalSobreCupo" style="float: left;">Agendar sobrecupo</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body">	
				<div class="form-group">
					<label for="nombre">Hora:</label>
					<select type="text" class="form-control" id="hora_sobrecupo_lista" name="hora_sobrecupo_lista" placeholder="Hora ">
						<option>HORA!</option>
					</select>
				</div>
				<div class="form-group">
					<label for="nombre">Comentario</label>
					<input type="textarea" class="form-control" id="comentario_sobrecupo" name="comentario_sobrecupo" placeholder="Comentario">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cerrar</button>
		        <button type="button" class="btn btn-success btn-sm" onclick="agendar_sobrecupo();" data-dismiss="modal">Agendar sobrecupo</button>
		      </div>
		    </div>
		 </div>
	</div>
	<!-- ================== MODAL AGENDAR SOBRECUPO ================== -->
	
	
	<!-- ================== MODAL CANCELAR CITA ================== -->
	<div class="modal fade" id="modalCancelar" tabindex="10" role="dialog">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalCancelar" style="float: left;">Cancelar cita de las: <span id="hora_cancelacion" style="color: red;"></span></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body">
				<div class="form-group">
					<label for="nombre">Motivo de cancelación</label>
					
					<select class="form-control" id="motivo_cancelacion" name="motivo_cancelacion">
						<option value="0">-- Seleccione motivo --</option>
							<?php  
								if (isset($motivos) and is_array($motivos) ) { 
									foreach ($motivos as $key ) {  
										echo '<option value="'.$key->id.'">'.$key->nombre.'</option>';
									}
								} 
							?>
					</select>
				</div>
				<div class="form-group">
					<label for="observacion">Observación</label>
					<input type="textarea" class="form-control" id="observacion" name="observacion" placeholder="Observación">
				</div>
		      </div>
		      <div class="modal-footer">
			      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cerrar</button>
		        <button type="button" class="btn btn-danger btn_cancel btn-sm" onclick="cancelar_cita()">Cancelar cita</button>
		      </div>
		    </div>
		 </div>
	</div>
	<!-- ================== MODAL CANCELAR CITA ================== -->
	
	
	<!-- ================== MODAL PAGO DE CONSULTA ================== -->
    <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="modalPago" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagarConsultaTitle" style="float: left;"><i class="material-icons">&#xE227;</i> Pago de consulta de <span id="nombre_paciente_pago" style="color: black;text-decoration: underline;"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="alert alert-info" role="alert">
                                <strong>Ojo!</strong> Valor de <span id="nombre_prestacion_pago"></span>. 
                                <input type="text" id="valorConsulta" class="form-control" placeholder="$2000" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="pTotal"><strong>Total:</strong> $<span id="costo_prestacion_pago"></span></label><br>
                            <label for="pRestante"><strong>Restante:</strong> <span style="color:red;">$<span id="pRestante"></span></span></label><br>
                            <label for="tPagado"><strong>Pagado:</strong> $<span id="tPagado"></span></label>
                        </div>
                    </div>
                    <div class="row">
                    		<form class="col-md-12" id="form_pagos">
	                        <div class="row group_pago">
	                            <div class="form-group col-md-8" id="opcion_pago_cita">
	                                <label for="oPago" class="tit_pago">Opción de pago</label>
	                                <select class="form-control" id="oPago" onchange="select_tipo_pago(this)">
	                                    <option value="">-- Forma de pago --</option>
	                                    <option value="Efectivo" selected>Efectivo</option>
	                                    <option value="Cheque">Cheque</option>
	                                    <option value="Bono">Bono</option>
	                                    <option value="Otro">Otro</option>
	                                </select>
	                            </div>
	                            <div class="form-group col-md-8" id="tipo_pago_cita" style="display:none;">
	                                <label for="oTipoPago" class="tit_pago">Tipo de pago</label>
	                                <select class="form-control" id="oTipoPago" onchange="select_tipo_pago(this)">
		                                <option value="">-- Tipo de pago --</option>
	                                    <option value="xx - Hijo de médico" selected>xx - Hijo de médico</option>
	                                    <option value="xyz - Esposa de médico">xyz - Esposa de médico</option>
	                                    <option value="yy - Hermano de médico">yy - Hermano de médico</option>
	                                </select>
	                            </div>
	                            <div class="form-group col-md-2" id="opc_pago_total" style="text-align: center;">
		                            <label for="oCheck" class="tit_pago">Pagar ahora</label><br>
	                                <input type="checkbox" class="form-check-input" id="oCheck" onchange="toggleCheckboxTotal(this)" style="margin-top: 12px;">
	                            </div>
	                            <div class="form-group col-md-2" id="pagoXcnt" style="text-align: center;">
		                            <label for="xcPago" class="tit_pago">Excento pago</label><br>
	                                <input type="checkbox" class="form-check-input" id="xcPago" onchange="toggleCheckboxExcento(this)" style="margin-top: 12px;">
	                            </div>
	                        </div>
	                        <div class="row group_pago" id="grupo_2">
		                        <hr>
	                            <div class="form-group col-md-6" id="monto_abonado">
		                            <label for="mAbonado">Cantidad recibida</label>
		                            <div class="input-group">
				                        <span class="input-group-addon">$</span>
				                        <input type="text" class="form-control mAbonado" id="mAbonado" placeholder="0">
				                        <span class="input-group-addon">.00</span>
				                    </div>
	                            </div>
	                            <div class="form-group col-md-6" id="numero_documento">
		                            <label for="nDocumento">Número de documento</label>
	                                <input type="text" class="form-control" id="nDocumento" placeholder="No. Documento">
	                            </div>
	                            <div class="form-group col-md-9" id="pago_descripcion">
		                            <label for="oPago">Observaciones</label>
	                                <input type="text" class="form-control" id="oPago_desc" placeholder="Describir observación...">
	                            </div>
	                            <div class="form-group col-md-3">
		                            <label>&nbsp;</label><br>
		                        		<button type="button" class="btn btn-info agrega_pago_abono" style="width:100%;" onclick="agregar_pago_abono_cita()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar pago</button>
	                            </div>
	                        </div>
	                        <div id="form-messages"></div>
	                    </form>
	                    <div class="group_pago">
	                        <hr>
	                        <table class="table table-responsive table-striped table-pagos" id="tabla-pagos">
					            <thead>
					                <tr>
					                    <th>Tipo pago</th>
					                    <th>Monto</th>
					                    <th>Número de documento</th>
					                    <th>Observaciones</th>
					                    <th class="text-center">Acción</th>
					                </tr>
					            </thead>
					            <tbody id="lista_depositos"></tbody>
		        			</table>
	                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="javascript:print()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir pago</button>
                </div>
            </div>
        </div>
    </div>
	<!-- ================== MODAL PAGO DE CONSULTA ================== -->
	
	<!-- =============== MODAL CREAR/EDITAR PACIENTE ================ -->
	<div class="modal fade" id="modal_pacientes" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_pacientes_name" style="float: left;">Modal paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="load_action_paciente"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="click_add()" id="actionAddEdit">Agregar/Actualizar/Visualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== MODAL CREAR/EDITAR PACIENTE ================ -->
    
    <!-- =============== MODAL CREAR/EDITAR PACIENTE ================ -->
	<div class="modal fade" id="modal_medicamentos" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_medicamento_name" style="float: left;">Modal medicamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="load_action_medicamento"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="click_add_medicamento()" id="actionAddEditMedicamento"><i class="fa fa-floppy-o" aria-hidden="true"></i> Agregar/Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== MODAL CREAR/EDITAR PACIENTE ================ -->
    
   