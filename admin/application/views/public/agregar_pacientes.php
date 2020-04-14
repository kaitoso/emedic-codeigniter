	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?php echo base_url() ?>plantilla2/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<script src="<?php echo base_url() ?>plantilla2/assets/js/jquery.selectric.min.js"></script>
	<script src="<?php echo base_url() ?>plantilla2/assets/js/jquery.georegionalizacion-chile_0.7.min.js"></script>
	<script type="text/javascript">
		function cuantosAnios(dia,mes,anio){
			var hoy = new Date();
			var nacido = new Date(anio,mes-1,dia);
			var tiempo = hoy-nacido;
			var unanio = 1000*60*60*24*365;
			var tienes = parseInt(tiempo/unanio);
			return tienes;
		}
		$(function() {
			var date = new Date();
			date.setDate(date.getDate());
			$('#datepicker').datetimepicker({
				locale: 'es',
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            }).on('dp.change', function (e) {
				var year = e.date.format('YYYY');
				var month = e.date.format('MM');
				var day    = e.date.format('DD');
			    var edad_paciente = cuantosAnios(day,month,year)+' años de edad';
			    document.getElementById('edadPaciente').innerHTML = edad_paciente;
			});
		});
	</script>
  <!-- ================== END PAGE LEVEL STYLE ================== -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Paso 1.- Registrar Paciente</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-12">
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="index-2">
                    <div class="panel-heading p-0">
                        
                      
                    </div>
                    <div class="tab-content">
                    		<?php 
	                        $attributes = array(
		                        'id' => 'frmAgregar',
	                        		'class' => 'form was-validated',  
	                        		'data-parsley-validate' => 'true',
	                        		'action' => '',
	                        		'name' => 'frmAgregar', 
	                        		'target' => '_self'
	                        	);   
	                        echo form_open_multipart('Publico/paciente'.'/'.$id_clinica,$attributes);
                        ?>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="nombre" class="col-sm-2 control-label text-right m-t-10">Nombre(s) <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('nombre','<div class="alert alert-danger">','</div>'); 
	                                
                                  $campo = array(
	                                  'name'  => 'nombre',
	                                  'id'  => 'nombre',
	                                  'placeholder' => 'Indique nombre(s)',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique su nombre(s)',
	                                  'pattern' => "[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}",
	                                  'required' => ''
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
                              <label for="apellidopat" class="col-sm-2 control-label text-right m-t-10">Apellido paterno <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellidopat','<div class="alert alert-danger">','</div>'); 
	                                
                                  $campo = array(
	                                  'name'  => 'apellidopat',
	                                  'id'  => 'apellidopat',
	                                  'placeholder' => 'Indique apellido paterno',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique su apellido paterno',
	                                  'pattern' => "[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}",
	                                  'required' => ''
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
                              <label for="apellidos" class="col-sm-2 control-label text-right m-t-10">Apellido materno <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('apellidomat','<div class="alert alert-danger">','</div>'); 
	                                
                                  $campo = array(
	                                  'name'  => 'apellidomat',
	                                  'id'  => 'apellidomat',
	                                  'placeholder' => 'Indique apellido materno',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique su apellido materno',
	                                  'pattern' => "[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}",
	                                  'required' => ''
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
                              <label for="rut" class="col-sm-2 control-label text-right m-t-10">RUT/Otro <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('rut','<div class="alert alert-danger">','</div>'); 
	                                
                                   $campo = array(
	                                  'name'  => 'rut',
	                                  'id'  => 'rut',
	                                  'placeholder' => '14.569.484-1',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique RUT u otro documento',
	                                  'required' => ''
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
                              <label for="cel" class="col-sm-2 control-label text-right m-t-10">Celular <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('cel','<div class="alert alert-danger">','</div>'); 
                                 
                                  $campo = array(
	                                  'name'  => 'cel',
	                                  'id'  => 'cel',
	                                  'type' => 'tel',
	                                  'placeholder' => 'Indique número celular',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique su número celular',
	                                  'pattern' => '[0-9]+',
	                                  'required' => ''
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
                              <label for="tel" class="col-sm-2 control-label text-right m-t-10">Teléfono <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('tel','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
	                                  'name'  => 'tel',
	                                  'id'  => 'tel',
	                                  'type' => 'tel',
	                                  'placeholder' => 'Indique número teléfono',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique su número teléfono',
	                                  'pattern' => '[0-9]+',
	                                  'required' => ''
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
                              <label for="email" class="col-sm-2 control-label text-right m-t-10">Email <span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('email','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
	                                  'name'  => 'email',
	                                  'id'  => 'email',
	                                  'type' => 'email',
	                                  'placeholder' => 'Indique correo electrónico',
	                                  'class' => 'form-control',
	                                  'data-validation-required-message' => 'Por favor indique su  correo electrónico',
	                                  'pattern' => "^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$",
	                                  'required' => ''
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
                              <label for="isapre" class="col-sm-2 control-label text-right m-t-10">Isapre<span style="color:red;">*</span></label>
                              <div class="col-sm-10">
                                <?php echo form_error('isapre','<div class="alert alert-danger">','</div>'); 
                                  
                                  $campo = array(
                                    'name'  => 'isapre',
                                    'id'  => 'isapre',
                                    'type' => 'isapre',
                                    'placeholder' => 'Indique Isapre',
                                    'class' => 'form-control',
                                    'data-validation-required-message' => 'Por favor indique su Isapre',
                                   
                                    'required' => ''
                                  );
                                  
                                  echo form_input($campo); 
                                ?>
                                
                                <p class="help-block text-danger"></p>
                              </div>
                            </div>
                          </div>
                        </div>


                        



                     
                      




                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div id="success" align="rigth">
                              <br>

                              <BUTTON style="float: right;" href="<?php echo base_url("publico/cita") ?>" class="btn btn-xl btn-success"> <i class="fa fa-arrow-rigth">Siguiente</BUTTON>

                             <!-- Esto es un comentario <button style="float: right;"  type="submit" class="btn btn-xl btn-success"> <i class="fa fa-arrow-rigth">Siguiente </button> -->
                            </div>

                            
                            
                            
                            
                          </div>
                        </div>

                        
                  <?php echo form_close(); ?>


                  
              
                </div>
                    
            </div>
        </div>
    </div>
    
    
    <script>
	    $.getScript('<?php echo base_url() ?>plantilla2/assets/plugins/parsley/dist/parsley.js');
    </script>