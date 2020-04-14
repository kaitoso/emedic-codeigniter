<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header"><?php echo $medicamento->nombre ?></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                    <div class="panel-heading p-0">
                        
                      
                    </div>
                    <div class="tab-content">
                          


                            <?php 
                          
                          $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
                          
                          echo form_open('Usuario/editar_medicamentos/'.$medicamento->id);

                          
                        ?>
                        

                            
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="codigo" class="col-sm-2 control-label">Codigo</label>
                              <div class="col-sm-10">
                                <?php echo form_error('codigo','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'codigo',
                                  'id'  => 'codigo',
                                  'value'=>set_value('codigo',$medicamento->codigo),
                                  'placeholder' => 'Indique Codigo',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique el Codigo",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique el Codigo"
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="medicamento" class="col-sm-2 control-label">Medicamento</label>
                              <div class="col-sm-10">
                                <?php echo form_error('medicamento','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'medicamento',
                                  'id'  => 'medicamento',
                                  'value'=>set_value('medicamento',$medicamento->nombre),
                                  'placeholder' => 'Indique Nombre del medicamento ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Nombre del medicamento",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Nombre del medicamento"
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>


                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="medicamento_fisticio" class="col-sm-2 control-label">Nombre Fistició</label>
                              <div class="col-sm-10">
                                <?php echo form_error('medicamento_fisticio','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'medicamento_fisticio',
                                  'id'  => 'medicamento_fisticio',
                                  'value'=>set_value('medicamento',$medicamento->nombre_fisticio),
                                  'placeholder' => 'Indique Nombre del medicamento fistició',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Nombre del medicamento Fistició",

                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Nombre del medicamento fistició"
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>


                              </div>
                            </div>
                          </div>
                        </div>


                            <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="con" class="col-sm-2 control-label">Consentración</label>
                              <div class="col-sm-10">
                                <?php echo form_error('con','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'con',
                                  'id'  => 'con',
                                  'value'=>set_value('con',$medicamento->concentracion),
                                  'placeholder' => 'Indique Consentración',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Consentración",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Consentración"
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="farm" class="col-sm-2 control-label">Farmautica</label>
                              <div class="col-sm-10">
                                <?php echo form_error('farm','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'farm',
                                  'id'  => 'farm',
                                  'value'=>set_value('farm',$medicamento->farmautica),
                                  'placeholder' => 'Indique Farmautica',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Farmautica",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Farmautica"
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>

                          <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="pre" class="col-sm-2 control-label">Presentación</label>
                              <div class="col-sm-10">
                                <?php echo form_error('pre','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'pre',
                                  'id'  => 'pre',
                                  'value'=>set_value('pre',$medicamento->presentacion),
                                  'placeholder' => 'Indique Presentación',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique  Presentación ",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique  Presentación "
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="estado" class="col-sm-2 control-label">Estado</label>
                              <div class="col-sm-10">
                                
                                <select class="form-control" name="estado">

                                  <?php if ($medicamento->estado==1) {
                                    # code...
                                  ?>
                                  
                                  <option value="<?php echo $medicamento->estado ?>">Disponible</option>

                                  <option value="<?php echo 0 ?>">No Disponible</option>


                                  <?php } ?>
                                  



                                  <?php if ($medicamento->estado==0) {
                                    # code...
                                  ?>
                                  
                                  <option value="<?php echo $medicamento->estado ?>">No Disponible</option>

                                  <option value="<?php echo 1 ?>">Disponible</option>


                                  <?php } ?>



    
                                </select>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>




                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div id="success"></div>

                            

                            <button type="submit" class="btn btn-xl btn-success">Actualizar</button>
                            
                          </div>
                        </div>

                        
                  <?php echo form_close(); ?>


                  
               <div class="box-footer with-border">
              <?php if(isset($volver) and !empty($volver)){ ?>
                <p><a href="<?php echo base_url('Usuario/medicamentos'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
                <?php }else{ ?>
                <p><a href="<?php echo base_url('Usuario/medicamentos'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
        
              
                
              <?php } ?>

                    </div>
                </div>
                    
            </div>
        </div>
    </div>