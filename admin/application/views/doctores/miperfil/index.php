<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<style>
		a>label {
			color: inherit!important;
		}
	</style>
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
    <!-- begin col-9 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2">
            <div class="panel-heading p-0">
                <div class="panel-heading-btn m-r-10 m-t-10">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <!-- begin nav-tabs -->
                <div class="tab-overflow">
                    <ul class="nav nav-tabs">
                        <li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a></li>
                        <li class="active"><a href="#nav-tab2-1" data-toggle="tab">Horarios y descansos</a></li>
                        <li><a href="#nav-tab2-2" data-toggle="tab">Prestaciones</a></li>
                        <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="nav-tab2-1">
                    <h3 class="m-t-10">Mis horarios</h3>
                    <form class="row">
					<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>

                                    <tr>

                                        <th><center>Nombre</center></th>
                                        
                                        <th><center>E-email</center></th>
                                        <th><center>Estado</center></th>
                                        <th><center>Agregado</center></th>
                                         <th><center>Grupo de Usuario</center></th>


                                         <?php if ($info['id_grupo']==3) {
                                             # code...
                                         ?>

                                        <th><center>Acciones</center></th>
                                       <?php } ?>



        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($usuarios as $key ) {

                                        foreach ($key->users as $key2) {
                                            # code...
                                       
                                        $fecha = date_create($key2->fecha_creacion);
                                     ?>
                                    <tr class="odd gradeX">
                                        
                                        <td><center><?php echo $key2->nombre; ?></center></td>
                                        
                                       
                                         <td><center><?php echo $key2->email; ?></center></td>


                                         <td><center>
                                            <?php 
                                            if ($key2->activo==1) {
                                                echo "<label class='btn btn-success'>Activo</label>";
                                            }
                                            else{
                                                echo "<label class='btn btn-danger'>No Activo</label>";
                                            } 

                                            ?>


                                         </center></td>

                                         <td><center><?php echo date_format($fecha, "d / m / Y"); ?></center></td>

                                         <td><?php echo $key2->grupo->nombre_grupo; ?></td>
                                        
                                         <?php if ($info['id_grupo']==3) {
                                             # code...
                                         ?>
                                       
                                         <td>
                                            <center>
                                                 <a href="<?php echo  base_url('Usuario/elimina_usuario/').$key->id_user ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>eliminar</a>

                                                <a href="<?php echo  base_url('Usuario/editar_usuario/').$key->id_user ?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>editar</a>

                                            </center>

                                           

                                        </td>

                                        <?php } ?>

                                        
                                        
                                    </tr>
                                    <?php 

                                    }
                                        }

                                     ?>                                
                                 </tbody>
                            </table>

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
							<button type="button" onclick="horario_medico(<?php echo $_SESSION['user_id']; ?>)" class="btn btn-success pull-right">Guardar</button>
						</div>
					</form>
                </div>
                <div class="tab-pane fade" id="nav-tab2-2">
                    <h4 class="m-t-10">Prestaciones disponibles</h4>
                    <div class="row">
                        <div class="col-md-6 flex-content">
	                        <select class="form-control" id="prestacionSelect">
								<option value="0">-- Seleccione prestación --</option>
								<?php foreach ($prestaciones as $key) {
									# code...
								 ?>
								 <option value="<?php echo $key->id ?>"><?php echo $key->nombre; ?></option>
								<?php } ?>
							</select>
							<a href="javascript:;" class="btn btn-success btn-sm pull-right" onclick="select_prestacion();">Agregar existente</a>
                        </div>
                        <div class="col-md-6">
	                        <a href="#modal-prestacion" class="btn btn-success btn-sm pull-right" data-toggle="modal">Agregar nueva</a>
                        </div>
                    </div>
                    <hr>
                    <h4>Mis prestaciones</h4>
                    <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
	                    <thead>
	                        <tr>
	                            <th>Nombre</th>
	                            <th>Costo</th>
	                            <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                        		</tr>
							</thead>
							<tbody id="load_prestaciones_medicas"></tbody>
	                </table>
                </div>
            </div>
        </div><!-- end panel -->
    </div><!-- end col-12 -->
	
	<div class="modal" id="modal-prestacion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar prestación</h4>
                </div>
                <div class="modal-body">
                    <form id="add_prestacion">
			        		<style>
				        		.form-group {margin: 0;}
			        		</style>
				        <div class="form-group row">
				            <label for="nombre" class="col-sm-2 control-label text-right m-t-10">Prestación <span style="color:red;">*</span></label>
				            <div class="col-sm-10">
				                <input class="form-control" placeholder="Consulta dental" name="nombre" type="text" required="" autofocus>
				                <p class="help-block text-danger"></p>
				            </div>
				        </div>
				        <div class="form-group row">
				            <label for="costo" class="col-sm-2 control-label text-right m-t-10">Costo <span style="color:red;">*</span></label>
				            <div class="col-sm-10">
				                <input class="form-control" placeholder="15000" name="costo" type="text" required="">
				                <p class="help-block text-danger"></p>
				            </div>
				        </div>
						<div class="form-group hidden">
						    <input id="submit_add_prestacion" type="submit" class="btn btn-lg btn-info btn-medic btn-block" value="Registrar">
						</div>           
					</form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-default btn-sm" data-dismiss="modal">Cerrar</a>
                    <a href="javascript:;" class="btn btn-sm btn-success btn-sm" onclick="insert_prestacion()">Agregar</a>
                </div>
            </div>
        </div>
    </div>
	