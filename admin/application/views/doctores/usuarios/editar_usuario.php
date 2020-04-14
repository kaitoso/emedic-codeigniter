<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Usuario <?php echo $usuario->nombre ?> </h1>
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
                          
                          echo form_open('Usuario/editar_usuario/'.$usuario->id);

                          
                        ?>
                        

                            
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="nombre" class="col-sm-2 control-label">Nombres</label>
                              <div class="col-sm-10">
                                <?php echo form_error('nombre','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'nombre',
                                  'id'  => 'nombre',
                                  'value'=>set_value('nombre',$usuario->nombre),
                                  'placeholder' => 'Indique Sus Nombres ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Sus Nombres",
                                  
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Nombres"
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
                              <label for="apellidopat" class="col-sm-2 control-label">Apellido Paterno</label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellidopat','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'apellidopat',
                                  'id'  => 'apellidopat',
                                  'value'=>set_value('apellidopat',$usuario->apellido_paterno),
                                  'placeholder' => 'Indique Sus Apellidos ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Sus Apellidos",
                                  
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Apellidos"
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
                              <label for="apellidos" class="col-sm-2 control-label">Apellido Materno</label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellidomat','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'apellidomat',
                                  'id'  => 'apellidomat',
                                  'value'=>set_value('apellidomat',$usuario->apellido_paterno),
                                  'placeholder' => 'Indique Sus Apellidos ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Sus Apellidos",
                                 
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Apellidos"
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
                              <label for="apellidos" class="col-sm-2 control-label">E-email</label>
                              <div class="col-sm-10">
                                <?php echo form_error('email','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'email',
                                  'id'  => 'email',
                                  'value'=>set_value('email',$usuario->email),
                                  'placeholder' => 'Indique Su E-email ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su E-email",
                                 
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su E-email"
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
                              <label for="apellidos" class="col-sm-2 control-label">Contraseña</label>
                              <div class="col-sm-10">
                                <?php echo form_error('pass','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'pass',
                                  'id'  => 'pass',
                                  'value'=>set_value('pass'),
                                  'placeholder' => 'Nueva Contraseña',
                                  'class' => 'form-control',
                                  'type'=>'password',
                                  'data-validation-required-message' => "Porfavor Indique nueva  Contraseña",
                                 
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique nueva  Contraseña"
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

                                  <?php if ($usuario->activo==1) {
                                    # code...
                                  ?>
                                  
                                  <option value="<?php echo $usuario->activo ?>">Disponible</option>

                                  <option value="<?php echo 0 ?>">No Disponible</option>


                                  <?php } ?>
                                  



                                  <?php if ($usuario->activo==0) {
                                    # code...
                                  ?>
                                  
                                  <option value="<?php echo $usuario->activo ?>">No Disponible</option>

                                  <option value="<?php echo 1 ?>">Disponible</option>


                                  <?php } ?>



    
                                </select>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>



                         <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="grupo" class="col-sm-2 control-label">Grupo de Usuario</label>
                      <div class="col-sm-10">
                      
                       <select class="form-control" name="grupo" required="true">

                        <?php 
                        foreach ($usuarios as $key ) {
                          # code...
                       

                        if ($key->grupo->id!=null) {
                          # code...


                        ?>

                        <option value="<?php echo $key->grupo->id ?>"><?php echo $key->grupo->nombre_grupo; ?></option>


                        <?php foreach ($grupos as $key) {
                          # code...
                         ?>
                        <option value="<?php echo $key->id?>"><?php echo $key->nombre_grupo; ?></option>
           

                           <?php } ?>

                        <?php }  else{?>

                        <?php foreach ($grupos as $key) {
                          # code...
                         ?>
                        <option value="<?php echo $key->id?>"><?php echo $key->nombre_grupo; ?></option>
           

                           <?php } ?>

                        <?php } 


                      }?>


                        
                      

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
          <p><a href="<?php echo base_url('Usuario/Usuarios'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
          <?php }else{ ?>
          <p><a href="<?php echo base_url('Usuario/Usuarios'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
  
        
          
        <?php } ?>
      </div><!-- /.box-footer -->

                    </div>
                </div>
                    
            </div>
        </div>
    </div>