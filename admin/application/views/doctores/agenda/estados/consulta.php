  <div class="tab-pane fade" id="consulta">
						        <h3 class="m-t-10">Paciente en consulta</h3>
						        <?php if (isset($consulta) and is_array($consulta)) {
								     		# code...
								     	 ?>
								<table id="tabla-citas-consulta" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
								    <thead>
								        <tr>
								            
								            <th>Tipo agenda</th>
								            <th>Hora agenda</th>
								            <th>Observaciones</th>
								            <th>Rut</th>
								            <th>Paciente</th>
								            <th>OPCIONES</th>
								        </tr>
								    </thead>
								   <tbody id="div_citas">

								   	


								    	<?php foreach ($consulta as $key ) {
								    		# code...
								    	 ?>
								    	 <tr lass="odd gradeX">
										 <td><center><?php echo $key->tipo; ?></center></td>
										 <td><center><?php echo $key->hora; ?></center></td>
										 <td><center><?php echo $key->comentario; ?></center></td>
										 <td><center><?php echo $key->rut_otro; ?></center></td>
										 <td><center><?php echo $key->nombre; ?></center></td>
										 <td>
											<center>

												<a href="<?php echo  base_url('Usuario/cancelar_consulta/').$key->id ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>Cancelar Consulta</a>

												<a href="<?php echo  base_url('Usuario/terminar_consulta/').$key->id ?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-check"></span>Finalizar Cosulta</a>

                                            </center>
											
										 </td>
                                        

										</tr>
										<?php } ?>

										<?php } else{ ?>
			                             <center><h4>Sin Consultas</h4></center>

										<?php } ?>

								    </tbody>
								</table>
					        </div>