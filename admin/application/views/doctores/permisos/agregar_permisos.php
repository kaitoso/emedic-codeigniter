

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Agregar Grupo  Y Permisos  </h1>
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
                                <input type="text" class="form-control" name="grupo" id="pGrupos" placeholder="Enfermera" required="true">
                            </div>
                    <div class="tab-content">
                         
                          <table id="example"  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>

                                    <tr>

                                        <th><center>Modulo</center></th>
                                        <th><i class="material-icons">&#xE147;</i> Agregar</th>
                                        <th><i class="material-icons">&#xE254;</i> Editar</th>
                                        <th><i class="material-icons">&#xE417;</i> Visualizar</th>
                                         <th><i class="material-icons">&#xE872;</i> Eliminar</th>
                                        
                                       
                                        
        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr id="inicio" class="odd gradeX">
                                        
                                        <td>

                                            <center><?php echo "Inicio"; ?></center>

                                           
                                        </td>


                                        
                                        <td><input class="form-check-input " id="select_1" type="checkbox" value="" name="select1_in[]"></td>
                                        
                                        <td><input class="form-check-input" id="select_2" type="checkbox" value="" name="select2_in[]" ></td>

                                        <td><input class="form-check-input" id="select_3" type="checkbox" value="" name="select3_in[]" ></td>

                                        <td><input class="form-check-input" id="select_4" type="checkbox" value="" name="select4_in[]" ></td>

                                       
                                        
                                    </tr>


                                    <tr id="pacientes" class="odd gradeX">
                                        
                                        <td><center><?php echo "Pacientes"; ?></center></td>

                                      
                                        
                                        <td><input class="form-check-input " id="select_1" type="checkbox" value="" name="select1_pa[]"></td>
                                        
                                        <td><input class="form-check-input" id="select_2" type="checkbox" value="" name="select2_pa[]" ></td>

                                        <td><input class="form-check-input" id="select_3" type="checkbox" value="" name="select3_pa[]" ></td>

                                        <td><input class="form-check-input" id="select_4" type="checkbox" value="" name="select3_pa[]" ></td>

                                        
                                    </tr>



                                    <tr id="consultas" class="odd gradeX">
                                        
                                        <td><center><?php echo "Consultas"; ?></center></td>
                                        
                                         <td> <input class="form-check-input " id="select_1" type="checkbox" value="" name="select1_co[]"></td>
                                        
                                        <td><input class="form-check-input" id="select_2" type="checkbox" value="" name="select2_co[]" ></td>

                                        <td><input class="form-check-input" id="select_3" type="checkbox" value="" name="select3_co[]" ></td>

                                        <td><input class="form-check-input" id="select_4" type="checkbox" value="" name="select4_co[]" ></td>
                                       
                                        
                                    </tr>


                                    <tr id="citas" class="odd gradeX">
                                        
                                        <td><center><?php echo "Citas"; ?></center></td>
                                        <td> <input class="form-check-input " id="select_1" type="checkbox" value="" name="select1_cit[]"></td>
                                        
                                        <td><input class="form-check-input" id="select_2" type="checkbox" value="" name="select2_cit[]" ></td>

                                        <td><input class="form-check-input" id="select_3" type="checkbox" value="" name="select3_cit[]" ></td>

                                        <td><input class="form-check-input" id="select_4" type="checkbox" value="" name="select4_cit[]" ></td>
                                        
                                       
                                        
                                    </tr>



                                    <tr id="Medicamentos" class="odd gradeX">
                                        
                                         <td><center><?php echo "Medicamentos"; ?></center></td>
                                        
                                        <td><input class="form-check-input" id="select_1" type="checkbox" value="" name="select1_me[]" ></td>

                                        <td><input class="form-check-input" id="select_2" type="checkbox" value="" name="select2_me[]" ></td>

                                        <td><input class="form-check-input" id="select_3" type="checkbox" value="" name="select3_me[]" ></td>

                                        <td><input class="form-check-input" id="select_4" type="checkbox" value="" name="sselect4_me[]" ></td>
                                        
                                       
                                        
                                    </tr>



                                    <tr id="pacientes" class="odd gradeX">
                                        
                                        <td><center><?php echo "Reportes"; ?></center></td>


                                        <td> <input class="form-check-input " id="select_1" type="checkbox" value="" name="select1_rep[]"></td>
                                        
                                        <td><input class="form-check-input" id="select_2" type="checkbox" value="" name="select1_rep[]" ></td>

                                        <td><input class="form-check-input" id="select_3" type="checkbox" value="" name="select1_rep[]" ></td>

                                        <td><input class="form-check-input" id="select_4" type="checkbox" value="" name="select1_rep[]" ></td>
                                        
                                       
                                        
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
                    <h5 class="modal-title" id="modalEditaGrupoTitle">Agregar Permisos </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-row">

                            <?php 
                          
                          $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
                          
                          echo form_open('Usuario/agregar_perm');

                          
                        ?>
                            <div class="form-group col-md-12">
                                <label for="pGrupos"></label>
                                <input type="text" class="form-control" id="modulo" value="ok" name="modulos" >
                            </div>

                            <div class="form-group col-md-12" >
                                <label for="pGrupos"></label>
                              <input type="text" class="form-control" id="modulos"  style="display:none" value="ok" name="grupos" >
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
                                                    <input class="form-check-input " id="select_1" type="checkbox" value="" name="select1[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" id="select_2" type="checkbox" value="" name="select2[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" id="select_3" type="checkbox" value="" name="select3[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" id="select_4" type="checkbox" value="" name="select4[]" checked>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                       
                                     
                                         
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>


                   
                </div>

                 <?php echo form_close(); ?>
            </div>
        </div>
    </div>