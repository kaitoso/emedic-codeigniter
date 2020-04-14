
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Medicamentos</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">

                    <div class="panel-heading p-0">
                        <div class="panel-heading-btn m-r-10 m-t-10">
                           
                        </div>
                      <div align="right">

                        <a href="<?php echo  base_url('Usuario/agregar_medicamentos') ?>" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span></a>

                            </div>  
                  </div>
                    <div class="tab-content">
                         <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>

                                    <tr>

                                        <th><center>Codigo</center></th>
                                        
                                        <th><center>Nombre</center></th>
                                        <th>Nombre Fistició</th>
                                        <th><center>Concentración</center></th>
                                        <th><center>Farmautica</center></th>
                                        <th><center>Presentación</center></th>
                                        <th><center>Estado</center></th>
                                        <th><center>Acciones</center></th>


        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($medicinas as $key ) {
                                       
                                     ?>
                                    <tr class="odd gradeX">
                                        
                                        <td><center><?php echo $key->codigo; ?></center></td>
                                        
                                       
                                         <td><center><?php echo $key->nombre; ?></center></td>

                                         <td><center><?php echo $key->nombre_fisticio; ?></center></td>


                                          <td><center><?php echo $key->concentracion; ?></center></td>

                                            <td><center><?php echo $key->farmautica; ?></center></td>

                                             <td><center><?php echo $key->presentacion; ?></center></td>


                                         <td><center>
                                            <?php 
                                            if ($key->estado==1) {
                                                echo "<label class='btn btn-success'>Disponible</label>";
                                            }
                                            else{
                                                echo "<label class='btn btn-danger'>No Disponible</label>";
                                            } 

                                            ?>


                                         </center></td>

                                       

                                        
                                        
                                         <td>
                                            <center>
                                                 <a href="<?php echo  base_url('Usuario/eliminar_medicina/').$key->id ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>eliminar</a>

                                                <a href="<?php echo  base_url('Usuario/editar_medicamentos/').$key->id ?>" class="btn btn-success">
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