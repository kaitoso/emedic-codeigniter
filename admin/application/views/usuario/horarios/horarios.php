	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/horarios_medicos.js"></script>
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
	                    <h4 class="panel-title">Configurar horario por m&eacute;dico</h4>
	                </div>
	                <div class="panel-body bg-silver">
		                
		                <select class="form-control" id="medicoSelect">
							<option value="0">-- Seleccione Médico --</option>
							<?php 
								foreach ($doctores as $key) {
									echo '<option value="'.$key->id.'">'.$key->nombre.' '.$key->apellido_paterno.'</option>';
								}
							?> 
						</select>
						<p>&nbsp;</p>
						<div class="col-md-12">
							<form class="row">
							
								<div class="col-md-4">
									<h5><strong>Días de descanso</strong></h5>
									<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Do" name="dia_semana[]"> Domingo
										</label>
									</div>
									<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Lu" name="dia_semana[]"> Lunes
										</label>
									</div>
									<div class="form-group form-check">
										<label>
										<input type="checkbox" class="form-check-input" value="Ma" name="dia_semana[]"> Martes
										</label>
									</div>
									<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Mi" name="dia_semana[]"> Mi&eacute;rcoles
										</label>
									</div>
									<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Ju" name="dia_semana[]"> Jueves
										</label>
									</div>
									<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Vi" name="dia_semana[]"> Viernes
										</label>
									</div>
									<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Sa" name="dia_semana[]"> Sábado
										</label>
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
									<button type="button" class="btn btn-success pull-right" onclick="dia_horario_medico()">Guardar</button>
								</div>
								<div class="col-md-12" style="margin-top:30px;">
							<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>

                                    <tr>
									<th><center>Medico</center></th>
                                        <th><center>Dias de descanso</center></th>
                                        
                                        <th><center>Hora de inicio</center></th>
                                        <th><center>Hora de fin</center></th>
                                        


                                        



        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
									 <?php 
									 
									 
									 foreach ($horarios as $key ) {
                                       
                                        //foreach ($key->users as $key2) {
                                            # code...
                                       
										  foreach ($doctores as $key2) {
											  # code...
										   # code...
									   
                                            if($key2->id == $key->id_medico){
                                     ?>
                                    <tr class="odd gradeX">

									<td>
									<?php echo $key2->nombre ." ". $key2->apellido_paterno;
                                        
                                            ?><td><center>
                                            <?php 
                                             echo $key->descanzo_semana;

                                            ?>


                                         </center></td>

                                         <td><center><?php echo $key->hora_inicio ?></center></td>

                                         <td><?php echo $key->hora_fin; ?></td>
                                        
                                       

                                        
                                        
                                    </tr>
                                    <?php 
											}
                                    }
								}
                                     ?>                                
                                 </tbody>
                            </table>

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
