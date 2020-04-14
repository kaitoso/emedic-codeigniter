<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Nuevo Paciente</h1>
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
                          
                          echo form_open_multipart('Docs/agregar_pacientes');

                          
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
                              <label for="apellidopat" class="col-sm-2 control-label">Apellidos</label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellidopat','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'apellidopat',
                                  'id'  => 'apellidopat',
                                  
                                  'placeholder' => 'Indique Sus Apellidos ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Sus Apellidos",
                                  'required' => '',
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
                                  
                                  'placeholder' => 'Indique Sus Apellidos ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Sus Apellidos",
                                  'required' => '',
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
                              <label for="edad" class="col-sm-2 control-label">Edad</label>
                              <div class="col-sm-10">
                                <?php echo form_error('edad','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'edad',
                                  'id'  => 'edad',
                                  
                                  'placeholder' => 'Indique Su Edad',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Edad",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Edad"
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
                              <label for="rut" class="col-sm-2 control-label">RUT/Otro</label>
                              <div class="col-sm-10">
                                <?php echo form_error('rut','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'rut',
                                  'id'  => 'rut',
                                  
                                  'placeholder' => 'Indique Su Rut ',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique  Su Rut ",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique  Su Rut "
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
                              <label for="dir" class="col-sm-2 control-label">Dirección</label>
                              <div class="col-sm-10">
                                <?php echo form_error('dir','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'dir',
                                  'id'  => 'dir',
                                  
                                  'placeholder' => 'Indique Su Dirección',
                                  'class' => 'form-control',
                                  'rows' => 2,
                                  'data-validation-required-message' => "Porfavor Indique Su Dirección",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Dirección"
                                  );
                                  
                                  echo form_textarea($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>



                        


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="cel" class="col-sm-2 control-label">Celular </label>
                              <div class="col-sm-10">
                                <?php echo form_error('cel','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'cel',
                                  'id'  => 'cel',
                                  
                                  'placeholder' => 'Indique Su Celular',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Celular",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Celular"
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
                              <label for="tel" class="col-sm-2 control-label">Telefono </label>
                              <div class="col-sm-10">
                                <?php echo form_error('tel','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'tel',
                                  'id'  => 'tel',
                                  
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
                              <label for="tfecha" class="col-sm-2 control-label">Fecha de Nacimiento</label>
                              <div class="col-sm-10">
                              

                              <div class='input-group date' id='datetimepicker1' >
                                  <input placeholder="MM/DD/YYYY" name="tfecha" type='text' class="form-control" />
                                  

                                  <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                              

                              </div>
                                   <script type="text/javascript">
                                  $(function () {
                                      $('#datetimepicker1').datetimepicker();
                                  });
                              </script>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>



                          <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="prof" class="col-sm-2 control-label">Profesión</label>
                              <div class="col-sm-10">
                                <?php echo form_error('prof','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'prof',
                                  'id'  => 'prof',
                                  
                                  'placeholder' => 'Indique Su Profesión',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Profesión",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Profesión"
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
                              <label for="email" class="col-sm-2 control-label">Sexo</label>
                              <div class="col-sm-10">
                               
                               <select class="form-control" name="sexo">
                                 <option value="Sexo">Indique Sexo</option>
                                 <option value="Masculino">Masculino</option>
                                 <option value="Feminino">Femenino</option>

                               </select>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">Previsión</label>
                              <div class="col-sm-10">
                               
                               <select class="form-control" name="prevision">
                                 <option value="0">Indique Previsión</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="1">4</option>
                                

                               </select>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">Región</label>
                              <div class="col-sm-10">
                               
                               <select class="form-control" name="region">
                                 <option value="0">Región</option>
                                 <option value="Arica y Paranoca">Arica y Paranoca</option>
                                 <option value="Tarapaca">Tarapaca</option>
                                 <option value="Antofagasta">Antofagasta</option>
                                 <option value="Atacama">Atacama</option>
                                 <option value="coquimbo">Coquimbo</option>
                                 <option value="Valparaiso">Valparaiso</option>
                                 <option value="Región del Libertador Gral. Bernando O'Higgins">Región del Libertador Gral. Bernando O'Higgins</option>
                                 <option value="Región de Maule">Región de Maule</option>
                                 <option value="Región de Bibio">Región de Bibio</option>
                                 <option value="Región de Auricania">Región de Auricania</option>
                                 <option value="Región de Auricania">Región de los Ríos</option>
                                 <option value="Región de los lagos">Región de los Lagos</option>
                                 <option value="Región de Aisén del Gral. Ibañés del Campo">Región de Aisén del Gral. Ibañés del Campo</option>
                                 <option value="Región de Magallanes y de la Antár">Región de Magallanes y de la AntárVCA Chilena</option>
                                 <option value="Región Metropolitana de Santiago">Región Metropolitana de Santiago</option>
                                

                               </select>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>


                         <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">Comuna</label>
                              <div class="col-sm-10">
                               
                               <select class="form-control" name="comuna">
                                 <option value="0">Seleccione Comuna</option>
                                 <option value="La Serena">La Serena</option>
                                 <option value="Coquimbo">Coquimbo</option>
                                 <option value="Anda Collo">Anda Collo</option>
                                 <option value="La Higuera">La Higuera</option>
                                 <option value="Paiguano">Paiguano</option>
                                 <option value="Vicuña">Vicuña</option>
                                 <option value="Illapel">Illapel</option>
                                 <option value="Canela">Canela</option>
                                 <option value="Los Vilos">Los Vilos</option>
                                 <option value="Salamanca">Salamanca</option>
                                 <option value="Ovalle">Ovalle</option>
                                 <option value="Combarbala"> Combarbala</option>
                                 <option value="Monte Patria">Monte Patria</option>
                                 <option value="Punitaqui">Punitaqui</option>
                                 <option value="Rio Hurtado">Rio Hurtado</option>
      

                                

                               </select>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>






                         <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
                              <div class="col-sm-10">
                                <?php echo form_error('ciudad','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'ciudad',
                                  'id'  => 'ciudad',
                                  
                                  'placeholder' => 'Indique Su Ciudad',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Ciudad",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Ciudad"
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
                              <label for="prov" class="col-sm-2 control-label">Provincia</label>
                              <div class="col-sm-10">
                                <?php echo form_error('prov','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                  'name'  => 'prov',
                                  'id'  => 'prov',
                                  
                                  'placeholder' => 'Indique Su Provincia',
                                  'class' => 'form-control',
                                  
                                  'data-validation-required-message' => "Porfavor Indique Su Provincia",
                                  'required' => '',
                                  'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Indique Su Provincia"
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
                    <label for="tsup" class="col-sm-2 control-label">Foto del Paciente</label>
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

                            

                            <button type="submit" class="btn btn-xl btn-success">Registrarse</button>
                            
                          </div>
                        </div>

                        
                  <?php echo form_close(); ?>


                  
               <div class="box-footer with-border">
              <?php if(isset($volver) and !empty($volver)){ ?>
                <p><a href="<?php echo base_url('Docs/pacientes'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
                <?php }else{ ?>
                <p><a href="<?php echo base_url('Docs/pacientes'); ?>" class="btn btn-xl btn-success"><i class="fa fa-arrow-left"></i> Cancelar</a></p>
        
              
                
              <?php } ?>

                    </div>
                </div>
                    
            </div>
        </div>
    </div>