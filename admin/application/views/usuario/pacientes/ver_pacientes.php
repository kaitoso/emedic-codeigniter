    <?php 
        $attributes = array('id'=>'frmAgregar','class'=>'form was-validated','action'=>'','name'=>'frmAgregar','target'=>'_self','autocomplete'=>'off');   
        echo form_open_multipart('Usuario/editar_paciente/'.$paciente->id,$attributes);
    ?>
                       
		<div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="nombre" class="col-sm-2 control-label text-right m-t-10">Nombre(s) <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->nombre ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="apellidopat" class="col-sm-2 control-label text-right m-t-10">Apellido paterno <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->apellido_paterno ?></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="apellidos" class="col-sm-2 control-label text-right m-t-10">Apellido materno <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->apellido_materno ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="rut" class="col-sm-2 control-label text-right m-t-10">RUT/Otro <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->rut_otro ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="dir" class="col-sm-2 control-label text-right m-t-10">Dirección</label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->direccion ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="cel" class="col-sm-2 control-label text-right m-t-10">Celular <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->celular ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="tel" class="col-sm-2 control-label text-right m-t-10">Teléfono</label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->telefono ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	        
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="email" class="col-sm-2 control-label text-right m-t-10">Email</label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->email ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="tfecha" class="col-sm-2 control-label text-right">Fecha de nacimiento <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->fecha_nacimiento ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
		<div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="edad" class="col-sm-2 control-label text-right m-t-10">Edad</label>
	          <div class="col-sm-10">
	            <p class="form-control-static" id="edadPaciente">
	               <?php
					    $cumpleanos = new DateTime($paciente->fecha_nacimiento);
					    $hoy = new DateTime();
					    $annos = $hoy->diff($cumpleanos);
					    echo $annos->y.' años de edad'; 
				    ?>
	            </p>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="prof" class="col-sm-2 control-label  text-right m-t-10">Profesión</label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->profesion ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
    
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="email" class="col-sm-2 control-label text-right m-t-10">Sexo <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->sexo ?></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="email" class="col-sm-2 control-label text-right m-t-10">Previsión <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
		          <p class="form-control-static"><?php echo $paciente->prevision ?></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="region" class="col-sm-2 control-label text-right m-t-10">Región</label>
	          <div class="col-sm-10">
	            <p class="form-control-static"><?php echo $paciente->region ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	        
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="provincia" class="col-sm-2 control-label text-right m-t-10">Provincias</label>
	          <div class="col-sm-10">
	             <p class="form-control-static"><?php echo $paciente->provincia ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	    
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="comuna" class="col-sm-2 control-label text-right m-t-10">Comuna</label>
	          <div class="col-sm-10">
	             <p class="form-control-static"><?php echo $paciente->comuna ?></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="ciudad" class="col-sm-2 control-label text-right m-t-10">Ciudad</label>
	          <div class="col-sm-10">
	          	 <p class="form-control-static"><?php echo $paciente->ciudad ?></p>
	          </div>
	        </div>
	      </div>
	    </div>
	    
        <div class="row">
	        <div class="col-md-12">
	          <div class="form-group">
	            <label for="tsup" class="col-sm-2 control-label text-right m-t-10">Foto del paciente</label>
	            <div class="col-sm-2">
	                <center style="background-color: #1A2229">
	                    <?php if($paciente->foto!='') {?>
							<img src="<?php echo base_url().RUTA_PACIENTES.'/'.$paciente->foto ?>" alt="" height="34"/>
	                    <?php }if($paciente->foto=='') {?>
	                    		<img src="<?php echo base_url().RUTA_PACIENTES.'/'.'member_1.jpg' ?>" alt="" height="34"/>
						<?php } ?>
	                </center>
	            </div>
	          </div>
	        </div>
	    </div>

                        
<?php echo form_close(); ?>