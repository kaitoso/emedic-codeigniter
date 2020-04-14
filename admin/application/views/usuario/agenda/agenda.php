<div class="col-md-12">
	<div class="panel panel-inverse">
		<div class="panel-heading">
		    <h4 class="panel-title">Agenda del d&iacute;a</h4>
		</div>
		<div class="panel-body bg-silver">
		    <?php 
		        $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
		        
		        echo form_open('Usuario/agenda/');
		        
		        
		        ?>
		    <select class="form-control" id="medicoSelect" name="docs" onchange="select_citas_medico(this.value);">
		        <option selected="true">-- Seleccione Médico --</option>
		        <?php foreach ($doctores as $key ) {
		            # code...
		            ?>
		        <option value="<?php echo $key->id ?>" label="<?php echo $key->nombre ?>"><?php echo $key->nombre ?></option>
		        <?php } ?>	        
		    </select>
		    <?php echo form_close(); ?>
		    <p>&nbsp;</p>
		    <div id="tabs_status_info"><div class="text-center"><strong id="disponibilidadFechasHorarios" style="color: red;">Seleccione un médico para ver su agenda del día</strong></div></div>
		    <div id="tabs_status" style="display:none">
			    <ul class="nav nav-tabs">
			        <li class="active"><a id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes <label id="contador_pendientes">( 0 )</label></a></li>
			        <li><a id="enEspera-tab" data-toggle="tab" href="#enEspera" role="tab" aria-controls="enEspera" aria-selected="false">En espera <label id="contador_espera">( 0 )</label></a></li>
			        <li><a id="enConsulta-tab" data-toggle="tab" href="#enConsulta" role="tab" aria-controls="enConsulta" aria-selected="false">En consulta <label id="contador_consulta">( 0 )</label></a></li>
			        <li><a id="Canceladas-tab" data-toggle="tab" href="#Canceladas" role="tab" aria-controls="Canceladas" aria-selected="false">Canceladas / Terminadas <label id="contador_terminadas">( 0 )</label></a></li>
			    </ul>
			    <div class="tab-content">
		            <div class="tab-pane active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
		               <div class="card-body">
		                  <table id="tabla-citas-hoy" class="table table-striped table-bordered table-responsive table-sm" cellspacing="0" width="100%">
		                     <thead>
		                        <tr>
		                           <th>ID_Agenda</th>
		                           <th>Tipo agenda</th>
		                           <th>Hora agenda</th>
		                           <th>Observaciones</th>
		                           <th>RUT/Otro</th>
		                           <th>Paciente</th>
		                           <th>OPCIONES</th>
		                        </tr>
		                     </thead>
		                     <tbody id ="div_citas"></tbody>
		                  </table>
		               </div>
		            </div>
		            <div class="tab-pane" id="enEspera" role="tabpanel" aria-labelledby="enEspera-tab">
		               <div class="card-body">
		                  <table id="tabla-citas-espera" class="table table-striped table-bordered table-responsive table-sm" cellspacing="0" width="100%">
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
		                     <tbody id ="div_citas_espera"></tbody>
		                  </table>
		               </div>
		            </div>
		            <div class="tab-pane" id="enConsulta" role="tabpanel" aria-labelledby="enConsulta-tab">
		               <div class="card-body">
		                  <table id="tabla-citas-consulta" class="table table-striped table-bordered table-responsive table-sm" cellspacing="0" width="100%">
		                     <thead>
		                        <tr>
		                           <th>ID_Agenda</th>
		                           <th>Tipo agenda</th>
		                           <th>Hora agenda</th>
		                           <th>Observaciones</th>
		                           <th>Rut</th>
		                           <th>Paciente</th>
		                           <?php
			                           if( $info['id_grupo'] != 2 ) {
				                           echo '<th>OPCIONES</th>';
			                           }
		                           ?>
		                        </tr>
		                     </thead>
		                     <tbody id ="div_citas_consulta"></tbody>
		                  </table>
		               </div>
		            </div>
		            <div class="tab-pane" id="Canceladas" role="tabpanel" aria-labelledby="Canceladas-tab">
		               <div class="card-body">
		                  <table id="tabla-citas-terminadas" class="table table-striped table-bordered table-responsive table-sm" cellspacing="0" width="100%">
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
		                     <tbody id ="div_citas_terminadas"></tbody>
		                  </table>
		               </div>  
		            </div>
		         </div>
		    </div>
		</div>
	</div>
</div>

