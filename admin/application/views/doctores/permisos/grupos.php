	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Grupos de Usuarios</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                    <div class="panel-heading p-0">
	                    <div align="right">
	                        <button class="btn btn-success"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span></button>
	                    </div>  
                    </div>
                    <div class="tab-content">
                    		<table id="data-table" class="table table-striped table-bordered nowrap text-center" width="100%">
                           <thead>
                                <tr>
									<th class="hidden">ID</th>
                                    <th>Nivel del administrador</th>
                                    <th>Agregados</th>
                                    <th>Usuarios Registrados</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grupos as $key ) {
                                    $fecha = date_create($key->f_act);
                                ?>
                                <tr class="odd gradeX">
                                    <td class="hidden"><?php echo $key->id; ?></td>
                                    <td><?php echo $key->nombre_grupo; ?></td>
                                    <td><?php echo date_format($fecha, "d / m / Y"); ?></td>
                                    <td><?php echo $key->total->total; ?></td>
                                    <td>
                                        <center>
                                            <a href="<?php echo  base_url('Usuario/eliminar_permiso/').$key->id  ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> eliminar</a>
                                            <button class="btn btn-success" onclick="edita_grupo(<?php echo $key->id ?>, '<?php echo  $key->nombre_grupo ?>')" data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-pencil"></span> editar</button>
                                        </center>
									</td> 
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





<!-- Modal Agregar -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal">&times;</button>
	            <h4 class="modal-title" id="">Editar Grupo</h4>
	        </div>
	        <div class="modal-body">
	            <?php 
	                $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');  
	                echo form_open('Usuario/agregar_grupo/');
	            ?>
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="form-group">
	                        <label for="grupo" class="col-sm-2 control-label">Nuevo Nombre</label>
	                        <div class="col-sm-10">
	                            <?php echo form_error('grupo','<div class="alert alert-danger">','</div>'); 
	                                $campo = array(
	                                'name'  => 'grupo',
	                                'id'  => 'grupo',
	                                // 'value'=>set_value('ciudad',$informa->ciudad),
	                                'placeholder' => 'Indique nombre nuevo',
	                                'class' => 'form-control',
	                                
	                                'data-validation-required-message' => "Porfavor Indique nombre nuevo",
	                                'required' => '',
	                                'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique nombre nuevo"
	                                );
	                                
	                                echo form_input($campo); 
	                                ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-md-12 text-center">
	                    <div id="success"></div>
	                    <button type="submit" class="btn btn-xl btn-success">Guardar</button>
	                </div>
	            </div>
	            <?php echo form_close(); ?>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        </div>
	    </div>
	</div>
</div>






<!-- Modal EDITAR NO APARECE EL MODAL SE QUEDA OCULTO-->
<div id="modalEditar" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal">&times;</button>
	            <h4 class="modal-title" id="grupos">Editar Grupo</h4>
	        </div>
	        <div class="modal-body">
	            <?php  
                    $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
					echo form_open('Usuario/editar_grupo/');
                ?>
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="form-group">
	                        <label for="grupo" class="col-sm-2 control-label">Nombre Grupo</label>
                            <div class="col-sm-10">
                                <?php echo form_error('grupo','<div class="alert alert-danger">','</div>'); ?>
                                <input type="text" name="grupo" value="" id="nombre_grupo" placeholder="Indique Grupo nuevo" class="form-control" data-validation-required-message="Porfavor Indique Grupo nuevo" required="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Indique Grupo nuevo">
                                <input type="text" name="id_grupo" id="id_grupo" class="form-control hidden" value="">  <!-- este input tiene que estar oculto y tener el nombre del grupo a editar cuando le da click a editar toma el valor del td selecionado-->
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-md-12 text-center">
	                    <button type="submit" class="btn btn-xl btn-success">Actualizar</button>
	                </div>
	            </div>
	            <?php echo form_close(); ?>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        </div>
	    </div>
	</div>
</div>
<!-- Modal Agregar -->








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

	function edita_grupo( id_grupo, nombre_grupo ) {
		
	    console.log(nombre_grupo);
	    document.getElementById("nombre_grupo").value = nombre_grupo;
		document.getElementById("id_grupo").value = id_grupo;
	}
</script>
<!-- ================== END PAGE LEVEL JS ================== -->