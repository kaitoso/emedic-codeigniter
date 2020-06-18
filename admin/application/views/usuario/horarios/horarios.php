	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/horarios_medicos.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/scheduler/codebase/dhtmlxscheduler.js"></script>
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
							
							<div class="col-md-12">

							<div class="card" >
  <ul class="list-group list-group-flush">
    <li class="list-group-item row">

<div class="col-md-4">
<h5><strong>Días laborales</strong></h5>
</div>
<div class="col-md-8">
<h5 style="margin-buttom: 20px !important;"><strong>Horarios</strong></h5>
</div>


	</li>
    <li class="list-group-item row ">

	<div class="col-md-4 " style="margin-top:20px;">
	<div class="form-group form-check ">
										<label>
											<input type="checkbox" class="form-check-input" value="Do" name="dia_semana[]"> Domingo
										</label>
									</div>

</div>
<div class="col-md-8 ">
					<div class="col-md-5">
									<div class="form-group entradaDomingo">
								    <label for="horaEntradaDom">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaDom"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaDomingo">
								    <label for="horaSalidaDom">Salida</label>
										<input type="time" class="form-control" id="horaSalidaDom"/>

								    </div>
									
								   </div>
								   	<div class="col-md-2 " id="botonesDom">

									<button id="agregaDom" type="button">agregar</button>
									</div>
									

</div>

	</li>
    <li class="list-group-item row">
			
								<div class="col-md-4 " style="margin-top:20px;">
								<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Lu" name="dia_semana[]"> Lunes
										</label>
									</div>
									

								</div>
								<div class="col-md-8">
								<div class="col-md-5">
									<div class="form-group entradaLunes">
								    <label for="horaEntradaLu">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaLu"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaLunes">
								    <label for="horaSalidaLu">Salida</label>
										<input type="time" class="form-control" id="horaSalidaLu"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2" id="botonesLu">
										 <button id="agregaLu" type="button">agregar</button>
									</div>

								</div>


	</li>

	<li class="list-group-item row">
			
								<div class="col-md-4" style="margin-top:20px;">
								<div class="form-group form-check">
										<label>
										<input type="checkbox" class="form-check-input" value="Ma" name="dia_semana[]"> Martes
										</label>
									</div>
									

								</div>
								<div class="col-md-8">
								<div class="col-md-5">
									<div class="form-group entradaMartes">
								    <label for="horaEntradaMa">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaMa"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaMartes">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaMa"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2" id="botonesMa">
										 <button id="agregaMa" type="button">agregar</button>
									</div>
								
								</div>


	</li>

	<li class="list-group-item row">
			
								<div class="col-md-4" style="margin-top:20px;">
								<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Mi" name="dia_semana[]"> Mi&eacute;rcoles
										</label>
									</div>
									

								</div>
								<div class="col-md-8">
								<div class="col-md-5">
									<div class="form-group entradaMiercoles">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaMie"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaMiercoles">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaMie"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2" id="botonesMie">
										 <button id="agregaMie" type="button">agregar</button>
									</div>
								
								</div>


	</li>

	<li class="list-group-item row">
			
								<div class="col-md-4" style="margin-top:20px;">
								<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Ju" name="dia_semana[]"> Jueves
										</label>
									</div>
									

								</div>
								<div class="col-md-8">
								<div class="col-md-5">
									<div class="form-group entradaJueves">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaJue"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaJueves">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaJue"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2" id="botonesJue">
										 <button id="agregaJue" type="button">agregar</button>
									</div>
								
								</div>


	</li>

	<li class="list-group-item row">
			
								<div class="col-md-4" style="margin-top:20px;">
								<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Vi" name="dia_semana[]"> Viernes
										</label>
									</div>
									

								</div>
								<div class="col-md-8">

								<div class="col-md-5">
									<div class="form-group entradaViernes">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaVier"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaViernes">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaVier"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2" id="botonesVier">
										 <button id="agregaVier" type="button">agregar</button>
									</div>

								</div>


	</li>

	<li class="list-group-item row">
			
								<div class="col-md-4" style="margin-top:20px;">

								<div class="form-group form-check">
										<label>
											<input type="checkbox" class="form-check-input" value="Sa" name="dia_semana[]"> Sábado
										</label>
									</div>
								</div>
								<div class="col-md-8">
								<div class="col-md-5">
									<div class="form-group entradaSabado">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaSab"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group salidaSabado">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaSab"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2" id="botonesSab">
										 <button id="agregaSab" type="button">agregar</button>
									</div>
								
								</div>


	</li>


  </ul>
</div>


							</div>
							
								<!-- <div class="col-md-4">
									
									<h5><strong>Días laborales</strong></h5>
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
									<div class="row">
									<div class="col-md-12" >
									<h5 style="margin-buttom: 20px !important;"><strong>Horarios</strong></h5>
									</div>
									
									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaDom"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaDom"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Dom</strong></h3>
									</div>

									</div>

									<div class="row">

									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaLu"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaLu"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Lu</strong></h3>
									</div>

									</div>


									<div class="row">
									
									
									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaMa"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaMa"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Ma</strong></h3>
									</div>

									</div>

									<div class="row">
									
									
									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaMie"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaMie"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Mie</strong></h3>
									</div>

									</div>

									<div class="row">
									
									
									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaJue"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaJue"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Jue</strong></h3>
									</div>

									</div>

									<div class="row">
									
									
									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaVier"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaVier"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Vier</strong></h3>
									</div>

									</div>
									<div class="row">
									
									
									<div class="col-md-5">
									<div class="form-group">
								    <label for="horaEntrada">Entrada</label>
										<input type="time" class="form-control" id="horaEntradaSab"/>
								    </div>
									</div>
								   <div class="col-md-5">
								   <div class="form-group">
								    <label for="horaSalida">Salida</label>
										<input type="time" class="form-control" id="horaSalidaSab"/>
								    </div>
									
								   </div>
								   	<div class="col-md-2">
									<h3><strong>Sab</strong></h3>
									</div>

									</div>

									
									
									
									


								</div> -->
								<div class="col-md-12">
									<button type="button" class="btn btn-success pull-right" onclick="dia_horario_medico()">Guardar</button>
								</div>
								<div class="col-md-12" style="margin-top:30px;">
							<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>

                                    <tr>
									<th><center>Medico</center></th>
                                        <th><center>Días laborales</center></th>
                                        
                                        <th><center>Horarios</center></th>
                                        
                                        


                                        



        
                                        
                                       
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

																				 <td><center><?php $hora_inicio = json_decode($key->hora_inicio); $hora_fin = json_decode($key->hora_fin); 
																				 if($hora_inicio->Do->horaEntradaDom != "" ||$hora_inicio->Do->horaEntradaDom != false ){
																					 echo "Domingo: <br>". $hora_inicio->Do->horaEntradaDom." a ".$hora_fin->Do->horaSalidaDom
																					 ;
																					    if ($hora_inicio->Do->horaEntradaDom2 != "" ||$hora_inicio->Do->horaEntradaDom2 != false ) {
																							 echo "<br>".$hora_inicio->Do->horaEntradaDom2." a ".$hora_fin->Do->horaSalidaDom2;


																							 if ($hora_inicio->Do->horaEntradaDom3 != "" ||$hora_inicio->Do->horaEntradaDom3 != false ) {
																								echo "<br>".$hora_inicio->Do->horaEntradaDom3." a ".$hora_fin->Do->horaSalidaDom3;
																							 }
																							}
																					
																					}
																					if($hora_inicio->Lu->horaEntradaLu != "" ||$hora_inicio->Lu->horaEntradaLu != false ){
																						echo "<br>Lunes: <br>".$hora_inicio->Lu->horaEntradaLu." a ".$hora_fin->Lu->horaSalidaLu
																						;
																							 if ($hora_inicio->Lu->horaEntradaLu2 != "" ||$hora_inicio->Lu->horaEntradaLu2 != false ) {
																								echo "<br>".$hora_inicio->Lu->horaEntradaLu2." a ".$hora_fin->Lu->horaSalidaLu2;
 
 
																								if ($hora_inicio->Lu->horaEntradaLu3 != "" ||$hora_inicio->Lu->horaEntradaLu3 != false ) {
																								 echo "<br>".$hora_inicio->Lu->horaEntradaLu3." a ".$hora_fin->Lu->horaSalidaLu3;
																								}
																							 }
																					 
																					 }
																					 if($hora_inicio->Ma->horaEntradaMa != "" ||$hora_inicio->Ma->horaEntradaMa != false ){
																						echo "<br>Martes: <br>".$hora_inicio->Ma->horaEntradaMa." a ".$hora_fin->Ma->horaSalidaMa
																						;
																							 if ($hora_inicio->Ma->horaEntradaMa2 != "" ||$hora_inicio->Ma->horaEntradaMa2 != false ) {
																								echo "<br>".$hora_inicio->Ma->horaEntradaMa2." a ".$hora_fin->Ma->horaSalidaMa2;
 
 
																								if ($hora_inicio->Ma->horaEntradaMa3 != "" ||$hora_inicio->Ma->horaEntradaMa3 != false ) {
																								 echo "<br>".$hora_inicio->Ma->horaEntradaMa3." a ".$hora_fin->Ma->horaSalidaMa3;
																								}
																							 }
																					 
																					 }
																					 if($hora_inicio->Mi->horaEntradaMie != "" ||$hora_inicio->Mi->horaEntradaMie != false ){
																						echo "<br>Miercoles: <br>".$hora_inicio->Mi->horaEntradaMie." a ".$hora_fin->Mi->horaSalidaMie
																						;
																							 if ($hora_inicio->Mi->horaEntradaMie2 != "" ||$hora_inicio->Mi->horaEntradaMie2 != false ) {
																								echo "<br>".$hora_inicio->Mi->horaEntradaMie2." a ".$hora_fin->Mi->horaSalidaMie2;
 
 
																								if ($hora_inicio->Mi->horaEntradaMie3 != "" ||$hora_inicio->Mi->horaEntradaMie3 != false ) {
																								 echo "<br>".$hora_inicio->Mi->horaEntradaMie3." a ".$hora_fin->Mi->horaSalidaMie3;
																								}
																							 }
																					 
																					 }
																					 if($hora_inicio->Ju->horaEntradaJue != "" ||$hora_inicio->Ju->horaEntradaJue != false ){
																						echo "<br>Jueves: <br>".$hora_inicio->Ju->horaEntradaJue." a ".$hora_fin->Ju->horaSalidaJue
																						;
																							 if ($hora_inicio->Ju->horaEntradaJue2 != "" ||$hora_inicio->Ju->horaEntradaJue2 != false ) {
																								echo "<br>".$hora_inicio->Ju->horaEntradaJue2." a ".$hora_fin->Ju->horaSalidaJue2;
 
 
																								if ($hora_inicio->Ju->horaEntradaJue3 != "" ||$hora_inicio->Ju->horaEntradaJue3 != false ) {
																								 echo "<br>".$hora_inicio->Ju->horaEntradaJue3." a ".$hora_fin->Ju->horaSalidaJue3;
																								}
																							 }
																					 
																					 }
																					 if($hora_inicio->Vi->horaEntradaVier != "" ||$hora_inicio->Vi->horaEntradaVier != false ){
																						echo "<br>Viernes: <br>".$hora_inicio->Vi->horaEntradaVier." a ".$hora_fin->Vi->horaSalidaVier
																						;
																							 if ($hora_inicio->Vi->horaEntradaVier2 != "" ||$hora_inicio->Vi->horaEntradaVier2 != false ) {
																								echo "<br>".$hora_inicio->Vi->horaEntradaVier2." a ".$hora_fin->Vi->horaSalidaVier2;
 
 
																								if ($hora_inicio->Vi->horaEntradaVier3 != "" ||$hora_inicio->Vi->horaEntradaVier3 != false ) {
																								 echo "<br>".$hora_inicio->Vi->horaEntradaVier3." a ".$hora_fin->Vi->horaSalidaVier3;
																								}
																							 }
																					 
																					 }
																					 if($hora_inicio->Sa->horaEntradaSab != "" ||$hora_inicio->Sa->horaEntradaSab != false ){
																						echo "<br>Sabado: <br>".$hora_inicio->Sa->horaEntradaSab." a ".$hora_fin->Sa->horaSalidaSab
																						;
																							 if ($hora_inicio->Sa->horaEntradaSab2 != "" ||$hora_inicio->Sa->horaEntradaSab2 != false ) {
																								echo "<br>".$hora_inicio->Sa->horaEntradaSab2." a ".$hora_fin->Sa->horaSalidaSab2;
 
 
																								if ($hora_inicio->Sa->horaEntradaSab3 != "" ||$hora_inicio->Sa->horaEntradaSab3 != false ) {
																								 echo "<br>".$hora_inicio->Sa->horaEntradaSab3." a ".$hora_fin->Sa->horaSalidaSab3;
																								}
																							 }
																					 
																					 }
																				 ?></center></td>

                                        
                                        
                                       

                                        
                                        
                                    </tr>
                                    <?php 
											}
                                    }
								}
                                     ?>                                
                                 </tbody>
                            </table>

							</div>
						
							</div>
							</form>
						</div>
	                </div>
	            
	            <!-- end panel -->
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->

