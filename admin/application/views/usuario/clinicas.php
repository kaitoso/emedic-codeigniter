 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">A continuación se muestra un listado de las clinicas que esta inscrito  en caso de no tener ninguna clinica asignada porfavor registrar una</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                    <div class="panel-heading p-0">
                        <div class="panel-heading-btn m-r-10 m-t-10">
                           <a href="<?php echo  base_url('Usuario/insert_clinicas') ?>" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                      
                    </div>
                    <div class="tab-content">
                          
                            <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>

                                    <tr>

                                        <th><center>Clinica</center></th>
                                        <th><center>Domicilio</center></th>
                                        <th><center>Telefono</center></th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clinicas as $key ) {
                                        # code...
                                     ?>
                                    <tr class="odd gradeX">
                                        <td><center><?php echo $key->nombre; ?></center></td>
                                        <td><center><?php echo $key->direccion; ?></center></td>
                                         <td><center><?php echo $key->telefono; ?></center></td>
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <p><a href="<?php echo  base_url('Usuario') ?>" class="btn btn-info"></span>Ir a Panel de Administración</a></p>
                    <br>

                    </div>
                </div>
                    
            </div>
        </div>
    </div>