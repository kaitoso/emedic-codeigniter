<div class="col-12">
    <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
        <div class="panel-heading p-0">
        		<div class="panel-heading-btn m-r-10 m-t-10"></div>
			<div align="right">
            		<a href="#" data-toggle="modal" data-target="#modal_usuarios" class="btn btn-success" onclick="usuarios_formulario_agregar();"><span class="glyphicon glyphicon-plus"></span></a>
			</div>  
        </div>
        <div class="tab-content">
             <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Grupo de Usuario</th>
                            <th class="text-center">email</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Agregado</th>
                            <?php if ($info['id_grupo']==3) { ?>
                                <th class="text-center">Acciones</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $key ) {
                           
                              foreach ($key->users as $key2) { $fecha = date_create($key2->fecha_creacion); ?>
                                
                            <tr class="odd gradeX">
                            <td class="text-center"><?php echo $key2->nombre; ?></td>
                            <td class="text-center"><?php echo $key2->usuario; ?></td>
								<td class="text-center"><?php echo $key2->grupo->nombre_grupo; ?></td>
								<td class="text-center"><?php echo $key2->email; ?></td>
                                <td class="text-center">
	                                <?php 
	                                    if ($key2->activo==1) {
	                                        echo "<label class='btn btn-success btn-sm'>Activo</label>";
	                                    } else {
	                                        echo "<label class='btn btn-danger btn-sm'>No Activo</label>";
	                                    }
	                                ?>
                                </td>
                                <td class="text-center"><?php echo date_format($fecha, "d / m / Y"); ?></td>
                                <?php if ($info['id_grupo']==3) { ?>
                                    <td class="text-center">
                                        <a title="Editar" href="<?php echo  base_url('Usuario/editar_usuario/').$key->id_user ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
										<a title="Eliminar" href="#usuarios" onclick="elimina_usuario(<?php echo $key->id_user; ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php 
                            		}
                            }
                        ?>                                
                    </tbody>
                </table>
        </div>
    </div>
</div>



  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
    


    $.getScript('<?php echo base_url() ?>plantilla2/assets/plugins/DataTables/media/js/jquery.dataTables.js').done(function() {
        $.getScript('<?php echo base_url() ?>plantilla2/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js').done(function() {
            $.getScript('<?php echo base_url() ?>plantilla2/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js').done(function() {
                $.getScript('<?php echo base_url() ?>plantilla2/assets/js/table-manage-responsive.demo.min.js').done(function() {
                    TableManageResponsive.init();
                    
                });
            });
        });
    });
</script>
<script src="<?php echo base_url() ?>plantilla2/assets/js/sweetalert.min.js"></script>

<!-- ================== END PAGE LEVEL JS ================== -->