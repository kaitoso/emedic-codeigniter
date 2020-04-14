<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Editar Permisos</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                     <br>

                     
                            <?php 
                          
                          $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
                          
                          echo form_open('Usuario/agregar_permiso');

                          
                        ?>
                     <div class="form-group col-md-12">
                                <label for="pGrupo">Nombre del grupo</label>
                                <input type="text" class="form-control" id="pGrupo" placeholder="Enfermera">
                            </div>
                    <div class="tab-content">
                         
                          <table id="example"  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>

                                    <tr>

                                        <th><center>Modulo</center></th>
                                        <th><center>Opciones</center></th>
                                       
                                        
        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr id="inicio" class="odd gradeX">
                                        
                                        <td><center><?php echo "Inicio"; ?></center></td>
                                        
                                        <td><center>
                                            
                                            <a data-toggle="modal" data-target="#modalEditaGrupo" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>Editar Permiso</a>


                                        </center></td>

                                       
                                        
                                    </tr>


                                    <tr id="pacientes" class="odd gradeX">
                                        
                                        <td><center><?php echo "Pacientes"; ?></center></td>
                                        
                                        <td><center>
                                            
                                            <a data-toggle="modal" data-target="#modalEditaGrupo" class="btn btn-success">
                                              <span class="glyphicon glyphicon-pencil"></span>Editar Permiso</a>



                                        </center></td>

                                        
                                    </tr>



                                    <tr id="consultas" class="odd gradeX">
                                        
                                        <td><center><?php echo "Consultas"; ?></center></td>
                                        
                                        <td><center>
                                            
                                            <a data-toggle="modal" data-target="#modalEditaGrupo" class="btn btn-success">
                                               <span class="glyphicon glyphicon-pencil"></span>Editar Permiso</a>


                                        </center></td>
                                       
                                        
                                    </tr>


                                    <tr id="pacientes" class="odd gradeX">
                                        
                                        <td><center><?php echo "Citas"; ?></center></td>
                                        <td><center>
                                            
                                            <a data-toggle="modal" data-target="#modalEditaGrupo"  class="btn btn-success">
                                                 <span class="glyphicon glyphicon-pencil"></span>Editar Permiso</a>



                                        </center></td>
                                        
                                       
                                        
                                    </tr>



                                    <tr id="pacientes" class="odd gradeX">
                                        
                                        <td><center><?php echo "Medicamentos"; ?></center></td>
                                        
                                       <td><center>
                                            
                                            <a data-toggle="modal" data-target="#modalEditaGrupo" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>Editar Permiso</a>


                                        </center></td>

                                        
                                       
                                        
                                    </tr>



                                    <tr id="pacientes" class="odd gradeX">
                                        
                                        <td><center><?php echo "Reportes"; ?></center></td>
                                        
                                       <td><center>
                                            
                                            <a data-toggle="modal" data-target="#modalEditaGrupo" class="btn btn-success">
                                                 <span class="glyphicon glyphicon-pencil"></span>Editar Permiso</a>


                                        </center></td>
                                        
                                       
                                        
                                    </tr>

                                     
                                


                                </tbody>
                            </table>

                            <div class="row">
                          <div class="col-md-12 text-center">
                            <div id="success"></div>

                            

                            <button type="submit" class="btn btn-xl btn-success">Guardar</button>
                            
                          </div>
                        </div>


                                     <?php echo form_close(); ?>
                        
                         <div class="box-footer with-border">
              <?php if(isset($volver) and !empty($volver)){ ?>
                <p><a href="<?php echo base_url('Usuario/permisos'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
                <?php }else{ ?>
                <p><a href="<?php echo base_url('Usuario/permisos'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
        
              
                
              <?php } ?>
            </div>
                    </div>
                </div>
                    
        </div>
    </div>



    <!-- Modal Edita -->
    <div class="modal fade" id="modalEditaGrupo" tabindex="-1" role="dialog" aria-labelledby="modalEditaGrupoTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditaGrupoTitle">Agregar grupo de usuarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="pGrupo">Nombre del grupo</label>
                                <input type="text" class="form-control" id="pGrupo" value="Usuario Root">
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th><i class="material-icons">&#xE147;</i> Agregar</th>
                                            <th><i class="material-icons">&#xE254;</i> Editar</th>
                                            <th><i class="material-icons">&#xE417;</i> Visualizar</th>
                                            <th><i class="material-icons">&#xE872;</i> Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input select_1" type="checkbox" value="" name="select1[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input  select_2" type="checkbox" value="" name="select1[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input select_3" type="checkbox" value="" name="select1[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input select_4" type="checkbox" value="" name="select1[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                       
                                     
                                        
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>