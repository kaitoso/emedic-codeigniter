	<div class="col-12">
	    <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
			<div class="panel-heading">
		        	<h4 class="panel-title">Catálogo de medicamentos
			        	<div class="panel-heading-btn pull-right">
		                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand" data-original-title="" title="" data-init="true"><i class="fa fa-expand"></i></a>
		            </div>
			        	<a href="javascript:#;" data-toggle="modal" data-target="#modal_medicamentos" class="btn btn-success btn-sm pull-right" onclick="medicamentos_formulario_agregar();" style="margin-top: -6px;"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
		        	</h4>  
		    </div>
	        <!--div class="panel-heading p-0">
	            <div class="panel-heading-btn m-r-10 m-t-10"></div>
		          <div align="right">
		            <a href="<?php echo  base_url('Usuario/agregar_medicamentos') ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
				</div>  
		      </div-->
	        <div class="tab-content">
	             <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
	                    <thead>
	                        <tr>
		                        <th class="text-center">Código</th>
	                            <th class="text-center">Nombre</th>
	                            <th class="text-center">Nombre genérico</th>
	                            <th class="text-center">Presentación</th>
	                            <th class="text-center">Concentración</th>
	                            <th class="text-center">Vía de administración</th>
	                            <th class="text-center">Estado</th>
	                            <th class="text-center">Acciones</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php 
		                       if(empty($medicinas)) {
								    echo '<tr><td class="text-center" colspan="7">No hay medicamentos agregados a su lista.</td></tr>';
								} else {
									foreach ($medicinas as $key ) { ?>
									<tr>
										<td class="text-center"><?php echo $key->codigo; ?></td>
										<td class="text-center"><?php echo $key->nombre; ?></td>
										<td class="text-center"><?php echo $key->nombre_fisticio; ?></td>
										<td class="text-center"><?php echo $key->presentacion; ?></td>
										<td class="text-center"><?php echo $key->concentracion; ?></td>
										<td class="text-center"><?php echo $key->via_admon; ?></td>
										 <td class="text-center">
			                                <?php 
				                                if ($key->estado==1) {
				                                    echo "<label class='label label-success'>Disponible</label>";
				                                }
				                                else{
				                                    echo "<label class='label label-danger'>No disponible</label>";
				                                } 
			                                ?>
			                            </td>
										<td class="text-center">
			                                <!--a href="<?php echo  base_url('Usuario/eliminar_medicina/').$key->id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a-->
											<!--a href="<?php echo  base_url('Usuario/editar_medicamentos/').$key->id ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a-->
											<button type="button" data-toggle="modal" data-target="#modal_medicamentos" onclick="medicamentos_formulario_editar(<?php echo $key->id; ?>)" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
											<button type="button" onclick="eliminar_medicina(<?php echo $key->id; ?>);" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
										</td>
			                        </tr>
									<?php  }		 
								}  
		                    ?>
	                        
	                    </tbody>
	                </table>
	        </div>
	    </div>
	</div>
	