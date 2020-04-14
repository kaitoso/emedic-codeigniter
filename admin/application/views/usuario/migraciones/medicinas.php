<div id="content" class="content">
        <!-- begin page-header -->
        <h3 class="page-header">Migrar Medicamentos</h3>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">

                <?php if (isset($error)) {
              # code...
             ?>

              <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <h4><i class="icon fa fa-ban"></i>
                <strong><?php echo $error; ?></strong></p></h4></div>

              <?php } ?>


              <?php if (isset($exito)) {
              # code...
             ?>

              <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <h4><i class="icon fa fa-check"></i>
                <strong><?php echo $exito; ?> </strong></p></h4></div>

              <?php } ?>


                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                    <div class="panel-heading p-0">
                        <div class="panel-heading-btn m-r-10 m-t-10">
                          
                        </div>
                      
                    </div>
                    <div class="tab-content">
                          
                             <?php 
                          
                          $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
                          
                          echo form_open_multipart('Usuario/migra_medicinas/');

                          
                        ?>

                        <select class="form-control" id="clinica" name="nombre">
                          
                          <option>Selecione Clinica</option>

                          <?php if (isset($clinicas) and is_array($clinicas) and count($clinicas)>0) {
                            # code...
                                foreach ($clinicas as $key) {
                                  # code...
                                
                           ?>

                           <option value="<?php echo $key->id ?>" id="<?php  echo $key->id?>"><?php echo $key->nombre ?></option>

                         <?php }} ?>
                        </select>
                        <br>

                      
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="tsup" class="col-sm-2 control-label">Archivo a importar</label>
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
                      <span class="help-block">
                <strong>El archivo tiene que ser en formato Csv o puede descargar el archivo llenarlo y subirlo directamente</strong>

              </span>
                    </div>
                  </div>
                </div>
              </div>
              


                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div id="success"></div>


                            <button type="submit" class="btn btn-xl btn-success">Importar Archivo</button>

                            <a data-toggle="tooltip" title="" href="<?php echo base_url().'img'.'/migraciones'.'/medicinas/'.'medicinas.csv' ?>" class="btn btn-danger" data-original-title="Descarga el archivo para el reporte"><i class="fa fa-download"></i> Descargar reporte para llenado</a>
                            
                          </div>
                        </div>
        
                          <?php echo form_close(); ?>

                           
                    </div>
                </div>
                    
            </div>


        </div>

            

              

              

    </div>



