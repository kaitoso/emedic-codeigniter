<div class="col-12">
	<div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
        <div class="panel-heading">
        	<h4 class="panel-title">Pacientes
	        	<div class="panel-heading-btn pull-right">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand" data-original-title="" title="" data-init="true"><i class="fa fa-expand"></i></a>
            </div>
	        	<a href="javascript:#;" data-toggle="modal" data-target="#modal_pacientes" class="btn btn-success btn-sm pull-right" onclick="paciente_formulario_agregar();" style="margin-top: -6px;"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
        	</h4>  
        </div>
      <div class="tab-content">
            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido paterno</th>
                        <th class="text-center">Rut</th>
                     
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Agregado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $key ) { $fecha = date_create($key->fecha_creacion); ?>
                        <tr class="odd gradeX">
                            <td class="text-center"><?php echo $key->nombre; ?></td>
                            <td class="text-center"><?php echo $key->rut_otro; ?></td>
                            <td class="text-center"><?php echo $key->apellido_paterno; ?></td>
                            <td class="text-center"><?php echo $key->telefono; ?></td>
                            <td class="text-center"><?php echo $key->direccion; ?></td>
							<td class="text-center">
								<?php 
                                    if ($key->activo==0) {
                                        echo '<label class="btn btn-success btn-sm" title="Desactivar usuario" onclick="status_paciente(\''.$key->nombre.'\','.$key->id.', 1)"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</label>';
                                    }
                                    else{
                                        echo '<label class="btn btn-danger btn-sm" title="Activar usuario" onclick="status_paciente(\''.$key->nombre.'\','.$key->id.', 0)"><i class="fa fa-square" aria-hidden="true"></i> No Activo</label>';
                                    } 
								?>
							</td>
							<td class="text-center"><?php echo date_format($fecha, "d / m / Y"); ?></td>
                            <td class="text-center">
                                <button title="Ver" type="button" data-toggle="modal" data-target="#modal_pacientes" onclick="ver_paciente(<?php echo $key->id; ?>)" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                	<button title="Editar" type="button" data-toggle="modal" data-target="#modal_pacientes" onclick="paciente_formulario_editar(<?php echo $key->id; ?>)" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> </button>
								<button title="Eliminar" type="button" onclick="eliminar_paciente(<?php echo $key->id; ?>,'<?php echo $key->nombre; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

        </div>
    </div>
        
</div>