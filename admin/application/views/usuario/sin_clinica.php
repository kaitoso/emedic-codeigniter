<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Seleccióne una clinica a registrar</h1>
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
                          
                            	<?php 
                  
                  $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');

                 
                  
                  echo form_open('Usuario/insert_clinicas',$user_id,$attributes);

                  
                ?>
<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="tact" class="col-sm-2 control-label">Actividades</label>
									<div class="col-sm-12">


										<select class="form-control" name="colores" > 

										<?php foreach ($clinicas as $key ) {
											# code...
										?>
										<option value="<?php echo $key->id ?>"><?php echo  $key->nombre ?></option>

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

                    

                    <button type="submit" class="btn btn-xl btn-success">Registrar Clinicas</button>
                    
                  </div>
                </div>


                <?php echo form_close(); ?>

                    </div>
                </div>
                    
            </div>
        </div>
    </div>