
					        <div class="tab-pane fade" id="cancelada">
						        <h3 class="m-t-10">Lista de pacientes cancelados</h3>


								     	<?php if (isset($cancelada) and is_array($cancelada)) {
								     		# code...
								     	 ?>
					            <table id="tabla-citas-terminadas" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
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


								    	<?php foreach ($cancelada as $key ) {
								    		# code...
								    	 ?>
								    	 <tr lass="odd gradeX">
										 <td><center><?php echo $key->tipo; ?></center></td>
										 <td><center><?php echo $key->hora; ?></center></td>
										 <td><center><?php echo $key->comentario; ?></center></td>
										 <td><center><?php echo $key->rut_otro; ?></center></td>
										 <td><center><?php echo $key->nombre; ?></center></td>
										 <td>
										 	
											<center><a href="<?php echo  base_url('Usuario/pasar_pendiente/').$key->id ?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>Pasar a pediente</a></center>

										 </td>
                                        

										</tr>
										<?php } ?>

										<?php } else{ ?>
			                             <center><h4>Sin Consultas</h4></center>

										<?php } ?>

								    </tbody>
								</table>
					        </div>
