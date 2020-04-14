


		<div class="col-md-4">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Médico</h4>
                </div>
                <div class="panel-body bg-silver">
                		<select class="form-control" id="medicoSelect" onchange="select_medico(this.value,this.value);">
                        <option value="0" selected>-- Seleccione Médico --</option>
                        <?php foreach ($doctores as $key) { ?>
                        		<option value="<?php echo $key->id; ?>"  ><?php echo $key->nombre; ?></option>
                        <?php } ?>
	                </select>
	                
	                <select class="form-control m-t-15" id="prestacionSelect" style="display:none;">
	                		<option selected>-- Seleccione Consulta --</option>
		                	<?php foreach ($presentacion as $key2 ) { ?>
	                        <option value="<?php echo  $key2->id ?>" ><?php echo $key2->nombre; ?></option>
	                    <?php } ?>
                    </select>
                </div>
            </div>
            <!-- end panel -->
            <!-- begin panel -->
            <div class="panel panel-inverse" id="pacienteDIV" style="display: none;">
                <div class="panel-heading">
                    <h4 class="panel-title">Paciente</h4>
                </div>
                <div class="panel-body bg-silver">
                    	<select class="form-control" id="pacienteSelect" onchange="select_paciente(this.value);" data-live-search="true">
                        <option value="0" selected>-- Seleccione paciente --</option>
                        <?php foreach ($pacientes as $key3) { ?>
                        		<option value="<?php echo $key3->id  ?>" data-tokens="<?php echo $key3->rut_otro  ?> - <?php echo $key3->nombre ?>" ><?php echo $key3->nombre ?></option>
                        <?php } ?>
                    </select>
                    <label class="m-t-15" id="rut_paciente" style="display:none;"></label>
                    <div class="alert alert-danger m-t-15 m-b-0" id="cuadro-alertas" style="display:none;">
                        <a id="alertas_paciente" data-trigger="hover" data-html="true" data-toggle="alertas" data-placement="top" data-content="" data-original-title="Alertas del paciente">Este paciente tiene 3 alertas</a>
                    </div>
                    <div class="btn-group m-t-15" id="opc_pacientes" style="width:100%;display:none;">
                        <a href="#" id="link_editar_paciente" class="btn btn-primary" data-toggle="modal" data-target="#modalEditarPaciente" style="width:50%;">EDITAR<br> PACIENTE</a>
		                <a href="#" id="link_sobrecupo" class="pull-right btn btn-warning" data-toggle="modal" data-target="#modalSobreCupo" style="width:50%;">AGENDAR<br> SOBRECUPO</a>
                    </div>
                </div>
            </div>
            <!-- end panel -->

            
            
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Fechas disponibles</h4>
                </div>
                <div class="panel-body bg-silver">
	                		<div id="script_calendario"></div>
                    		<div class="calendar_horas">
	                    		<div class="bg-danger text-center medico_agenda">
								<label id="td_fecha_titulo"><strong>Seleccione un médico para ver sus días laborales</strong></label>
							</div>
							<div id="calendar-horas"></div>
                    		</div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-4 -->
        <!-- begin col-8 -->
		<div class="col-md-8">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Disponibilidad de horario <span id="texto_fecha_hora_disp"></span></h4>
                </div>
                <div class="panel-body bg-silver">
	                <div class="text-center"><strong id="disponibilidadFechasHorarios" style="color: red;">Seleccione un médico para ver disponibilidad de horario.</strong></div>
                		<table class="table table-responsive table-horarios" id="table-horarios" style="display:none;">
			            <thead>
			                <tr>
			                		<th class="hidden">Id</th>
			                    <th>Hora</th>
			                    <th>Disponibilidad</th>
			                    <th>Observación</th>
			                    <th class="text-center">Acción</th>
			                </tr>
			            </thead>
			            <tbody id="div_horarios"></tbody>
        				</table>
                </div>
            </div>
            <!-- end panel -->
	</div>
		
	
	
	
	
	
	
	
		
	
	
	
	
		
	
	

	<div id="modal_paciente"></div>

	<!-----------------Modal Editar Paciente--------------->
	
	
	