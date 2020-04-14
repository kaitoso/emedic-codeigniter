<div id="content" class="content">
        <!-- begin page-header -->
        <h3 class="page-header">Mi Perfil</h3>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                    <div class="panel-heading p-0">
                        <div class="panel-heading-btn m-r-10 m-t-10">
                          
                        </div>
                      
                    </div>
                    <div class="tab-content">
                          <center>

                           <img src="<?php echo base_url().RUTA_USUARIOS.'/'.$perfil->foto ?>" alt="" />
                            
                          </center>
                          <br>
                            


                             <?php 
                          
                          $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
                          
                          echo form_open_multipart('Usuario/miperfil/'.$perfil->id);

                          
                        ?>
                        

                            
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="nombre" class="col-sm-2 control-label">Nombre </label>
                              <div class="col-sm-10">
                                <?php echo form_error('nombre','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'nombre',
                                  'id'  => 'nombre',
                                  'value'=>set_value('nombre',$perfil->nombre),
                                  'placeholder' => 'Indique Sus Nombres ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Sus Nombres",
                                  'required' => '',
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
                              <label for="apellido_paterno" class="col-sm-2 control-label">Apellido Paterno</label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellido_paterno','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'apellido_paterno',
                                  'id'  => 'apellido_paterno',
                                 'value'=>set_value('apellido_paterno',$perfil->apellido_paterno),
                                  'placeholder' => 'Indique Su Apellido Paterno',
                                  'class' => 'form-control',
                                  'rows' => 2,
                                  'data-validation-required-message' => "Porfavor Indique Su Apellido Paterno",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Apellido Paterno"
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
                              <label for="apellido_materno" class="col-sm-2 control-label">Apellido Materno</label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellido_materno','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'apellido_materno',
                                  'id'  => 'apellido_materno',
                                 'value'=>set_value('apellido_materno',$perfil->apellido_materno),
                                  'placeholder' => 'Indique Su Apellido Paterno',
                                  'class' => 'form-control',
                                  'rows' => 2,
                                  'data-validation-required-message' => "Porfavor Indique Su Apellido Paterno",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Apellido Paterno"
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
                              <label for="username" class="col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                <?php echo form_error('username','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'username',
                                  'id'  => 'username',
                                   'value'=>set_value('username',$perfil->usuario),
                                  'placeholder' => 'Indique Su Username',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Username",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Username"
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
                              <label for="email" class="col-sm-2 control-label">E-email</label>
                              <div class="col-sm-10">
                                <?php echo form_error('email','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'email',
                                  'id'  => 'email',
                                  'value'=>set_value('email',$perfil->email),
                                  'placeholder' => 'Indique Su Télefono',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Télefono",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Télefono"
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
                              <label for="pass" class="col-sm-2 control-label">Constraseña</label>
                              <div class="col-sm-10">
                                <?php echo form_error('pass','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'pass',
                                  'id'  => 'pass',
                                  'type'=>'password',
                                  
                                  'placeholder' => 'Indique Su Constraseña Nueva',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Constraseña Nueva",
                                  
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Constraseña Nueva"
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
                    <label for="tsup" class="col-sm-2 control-label">Imagen de Perfil</label>
                    <div class="col-sm-10">
                      <?php echo form_error('tarch','<div class="alert alert-danger">','</div>'); 
                        
                        $campo = array(
                        'name'  => 'tarch',
                        'id'  => 'tarch',
                        
                        'value' => set_value('tarch'),
                        'placeholder' => 'Seleccione un Archivo a Subir',
                        'class' => 'form-control',
                        
                        'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Seleccione un archivo"
                        
                        
                        );
                        
                        echo form_upload($campo); 
                      ?>
                      
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

                           
                    </div>
                </div>
                    
            </div>
        </div>
    </div>