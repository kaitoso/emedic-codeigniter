
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Pacientes </h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">

                    <div class="panel-heading p-0">
                        <div class="panel-heading-btn m-r-10 m-t-10">
                           
                        </div>
                      <div align="right">

                        <a href="<?php echo  base_url('Docs/agregar_pacientes') ?>" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span></a>

                            </div>  
                  </div>
                    <div class="tab-content">
                         <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>

                                    <tr>

                                        <th><center>Nombre</center></th>
                                        <th><center>Telefono</center></th>
                                        <th><center>Dirección</center></th>
                                        <th><center>Estado</center></th>
                                        <th><center>Agregado</center></th>
                                        <th><center>Acciones</center></th>


        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pacientes as $key ) {
                                        $fecha = date_create($key->fecha_creacion);
                                     ?>
                                    <tr class="odd gradeX">
                                        
                                        <td><center><?php echo $key->nombre; ?></center></td>
                                        
                                        <td><center><?php echo $key->telefono; ?></center></td>
                                         <td><center><?php echo $key->direccion; ?></center></td>


                                         <td><center>
                                            <?php 
                                            if ($key->activo==1) {
                                                echo "<label class='btn btn-success'>Activo</label>";
                                            }
                                            else{
                                                echo "<label class='btn btn-danger'>No Activo</label>";
                                            } 

                                            ?>


                                         </center></td>

                                         <td><center><?php echo date_format($fecha, "d / m / Y"); ?></center></td>
                                        
                                         <td>
                                            <center>
                                                 <a href="<?php echo  base_url('Docs/eliminar_paciente/').$key->id ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>eliminar</a>

                                                <a href="<?php echo  base_url('Docs/editar_paciente/').$key->id ?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>editar</a>

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
<!-- ================== END PAGE LEVEL JS ================== -->