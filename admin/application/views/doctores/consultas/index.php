	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link rel="stylesheet" href="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap-select/bootstrap-select.min.css">
	<style>
		a>label {
			color: inherit!important;
		}
		/* Style the tab */
		.tab {
		    overflow: hidden;
		    background-color: #FFFFFF;
		    margin-bottom: 25px;
		    -webkit-transform: translateZ(0);
		    -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		    -moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		    -webkit-border-radius: 3px;
		    -moz-border-radius: 3px;
		    border-radius: 3px;
		}
		
		/* Style the buttons that are used to open the tab content */
		.tab button {
		    background-color: inherit;
		    float: left;
		    border: none;
		    outline: none;
		    cursor: pointer;
		    padding: 14px 16px;
		    transition: 0.3s;
		    display: none;
		}
		
		/* Change background color of buttons on hover */
		.tab button:hover {
		    background-color: #ddd;
		}
		
		/* Create an active/current tablink class */
		.tab button.active {
		    background-color: #ccc;
		}
		
		/* Style the tab content */
		.tabcontent {
		    display: none;
		    border-top: none;
		} 
		
		.tabcontent {
		    animation: fadeEffect 1s; /* Fading effect takes 1 second */
		}
		
		
		/*/======================================================================
		SELECCIONAR PACIENTE
		======================================================================/*/
		#nav_lateral {
			position: -webkit-sticky;
		    position: sticky;
		    top: 7.3125rem;
		    height: calc(100vh - 7.3125rem);
		    overflow-y: auto;
		}
		
		
		
		
		/* Go from zero to full opacity */
		@keyframes fadeEffect {
		    from {opacity: 0;}
		    to {opacity: 1;}
		}
	</style>
	
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<!-- begin #content -->
	<div id="content" class="content">
	    <!-- begin page-header -->
	    <h1 class="page-header">Agenda médica ggv2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <div class="tab">
		    	<button class="tablinks" onclick="openAjaxInfo(event, 'inicio')" id="inicio_">Inicio</button>
		    	<button class="tablinks" onclick="openAjaxInfo(event, 'cita')" id="cita_">Consultorio</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'pacientes')" id="pacientes_">Pacientes</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'consultas_del_dia')" id="consultas_del_dia_">Consultas del día</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'perfil')" id="perfil_">Mi configuración</button>
		</div>
	    <!-- begin row -->
	    <div class="row tabcontent" id="inicio"></div>
	    <div class="row tabcontent" id="cita">
		    <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="index-1">
                    <div class="panel-heading">
                        <h4 class="panel-title">Agenda del d&iacute;a
	                        <div class="panel-heading-btn pull-right">
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand" data-original-title="" title="" data-init="true"><i class="fa fa-expand"></i></a>
			                </div>
                            <ul class="nav nav-pills pull-right" style="margin-top:-10px;margin-bottom:0;">
                            		<li><a href="#espera" data-toggle="tab" id="enEspera">En espera / Espera por exámen <label class="m-b-0" id="contador_espera">( 0 )</label></a></li>
                                <li class="active"><a href="#cita_consultorio" data-toggle="tab" id="enConsulta">En consulta <label class="m-b-0"  id="contador_consulta">( 0 )</label></a></li>
                                <li><a href="#pasar_terminada_cancelada" data-toggle="tab">Canceladas / Terminadas <label class="m-b-0"  id="contador_terminadas">( 0 )</label></a></li>
                            </ul>
                        </h4>
                    </div>
                    <div class="panel-body bg-silver">
                        <div class="tab-content m-b-0">
                        	<div class="tab-pane fade" id="espera">
                            <h3 class="m-t-0">En espera</h3>
                            <table id="tabla-citas" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID_Agenda</th>
                                        <th>Tipo agenda</th>
                                        <th>Hora agenda</th>
                                        <th>Observaciones</th>
                                        <th>Rut</th>
                                        <th>Paciente</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="div_citas"></tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade active in" id="cita_consultorio">
                            <center style="color:red;"><h5>No hay pacientes en su agenda</h5></center>
                        </div>
                        <div class="tab-pane fade" id="pasar_terminada_cancelada">
                            <h3 class="m-t-0">Lista de pacientes atendidos / cancelados</h3>
                            <table id="tabla-citas-terminadas" class="table table-striped table-bordered table-responsive table-sm" cellspacing="0" width="100%">
			                    <thead>
			                        <tr>
			                           <th>ID_Agenda</th>
			                           <th>Tipo agenda</th>
			                           <th>Hora agenda</th>
			                           <th>Observaciones</th>
			                           <th>Rut</th>
			                           <th>Paciente</th>
			                           <th>OPCIONES</th>
			                        </tr>
			                    </thead>
			                    <tbody id ="div_citas_terminadas"></tbody>
		                    </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- end panel -->
	    </div>
	    <div class="row tabcontent" id="pacientes"></div>
		<div class="row tabcontent" id="consultas_del_dia"></div>
		<div class="row tabcontent" id="perfil"></div>
	</div><!-- end #content -->
    
    <div id="receta_medica" class="hidden">
	    <style media="print">
		    #rec_doc_name, #rec_doc_pres {
			    text-transform: uppercase;
		    }
	       .col-xs-12,.row{width:100%}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}body{background:#FFF;font-size:12px;font-family:'Open Sans',"Helvetica Neue",Helvetica,Arial,sans-serif;color:#212529}@media print{@page{margin:0}body,html{height:100%;margin:15px!important;padding:0!important;overflow:hidden}}.receta{padding:15px}.small,small{font-size:85%}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{font-family:inherit;font-weight:500;line-height:1.1;color:inherit}.h4,.h5,.h6,h4,h5,h6{margin-top:10px;margin-bottom:10px}.h1,h1{font-size:36px}.h2,h2{font-size:30px}.h3,h3{font-size:24px}.h4,h4{font-size:18px}.h5,h5{font-size:16px}.h6,h6{font-size:12px}img{border:0}.text-center{text-align:center}.row{margin-right:-15px;margin-left:-15px;display:inline-block}.col-xs-8{width:66.66666667%}.col-xs-6{width:50%}.col-xs-4{width:33.33333333%}.col-xs-offset-2{margin-left:16.66666667%}.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9{position:relative;min-height:1px;padding-right:15px;padding-left:15px;float:left}.img-responsive{display:block;max-width:100%;height:auto}b,strong{font-weight:700}p{margin:0 0 10px}.text-muted{color:#777}#page-container{padding-top:0}.receta-company{display:inline-block;width:100%}#name_print{text-align:right}#page-loader,.pace{display:none!important}.m-b-0{margin-bottom:0!important}.m-t-0{margin-top:0!important}.m-t-10{margin-top:10px!important}.m-t-30{margin-top:30px!important}.table{border-color:#e2e7eb;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;background:0 0;width:100%;max-width:100%;margin-bottom:20px;border-spacing:0;border-collapse:collapse}.table-bordered{border:1px solid #ddd}.table-responsive{min-height:.01%;overflow-x:auto}.table>tbody>tr>td,.table>tbody>tr>th,.table>tfoot>tr>td,.table>tfoot>tr>th,.table>thead>tr>td,.table>thead>tr>th{border-color:#e2e7eb;background:#fff;padding:8px;line-height:1.42857143;vertical-align:top;border-top:1px solid #ddd}.table-bordered>tbody>tr>td,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>td,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>thead>tr>th{border:1px solid #ddd}
		</style>
	    
	    <div class="receta">
		    <div class="row receta-header">
		        <div class="col-xs-6" id="logo_print">
		            <img src="/emedic3/plantilla2/images/logos/modelaser.png" class="img-responsive"/>
		        </div>
		        <div class="col-xs-6" id="name_print">
		            <h4 class="m-b-0 m-t-0" id="rec_doc_name"><?php echo $perfil->nombre; ?></h4>
		            <h5 class="m-t-0" id="rec_doc_pres">Dermatólogo</h5>
		            <h6 class="m-b-0 m-t-0">
		                Rut: <?php echo $perfil->rut; ?><br/>
		                e-mail: <?php echo $perfil->email; ?>
		            </h6>
		        </div>
		        <div class="col-xs-offset-2 col-xs-8 m-t-30">
		            <div class="row">
		                <div class="col-xs-8">
		                    <p><strong>Nombre:</strong> <span id="rec_pac_name">Nombre Usuario</span></p>
		                    <p><strong>R.U.T.:</strong> <span id="rec_pac_rut">12.471.250.5</span></p>
		                </div>
		                <div class="col-xs-4">
		                    <p><strong>Edad:</strong> 45</p>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="row receta-content">
		        <div class="col-xs-12 m-t-10">
		            <p>
		                <strong>Rp:</strong><br>
		                &nbsp;<br>
		                &nbsp;<br>
		                &nbsp;<br>
		                &nbsp;
		            </p>
		            <p>
		                <strong>Pregalex 75 mg</strong><br>
		                PREGABALINA<br>
		                comprimidos<br>
		                1 comp en la noche por 5 días y luego 1 comp cada 12 horas por 1 mes<br>
		                &nbsp;
		            </p>
		            <p>
		                <strong>Valtrex 500 mg</strong><br>
		                VALACICLOVIR<br>
		                comprimidos<br>
		                2 comp cada 8 horas por 7 días<br>
		                &nbsp;
		            </p>
		        </div>
		    </div>
		    <div class="row receta-note">
		        <div class="col-xs-12">
		            <div class="row text-center">
		                <div class="col-xs-4">
		                    <br>
		                    &nbsp;<br>
		                    &nbsp;<br>
		                    &nbsp;<br>
		                    &nbsp;
		                    <hr class="m-b-5" style="border-color:#333333!important;">
		                    <strong>Firma</strong>
		                </div>
		                <div class="col-xs-4"></div>
		                <div class="col-xs-4">
		                    <br>
		                    &nbsp;<br>
		                    &nbsp;<br>
		                    &nbsp;
		                    <table class="table table-bordered table-responsive" id="fecha_cita">
		                        <tbody>
		                            <tr>
		                                <td>DÍA</td>
		                                <td>MES</td>
		                                <td>AÑO</td>
		                            </tr>
		                            <tr>
		                                <td>
			                                <?php
				                                print_r(date("d"));
			                                ?>
			                            </td>
		                                <td>
			                                <?php
				                                print_r(date("m"));
			                                ?>
		                                </td>
		                                <td>
			                                 <?php
				                                print_r(date("Y"));
			                                ?>
		                                </td>
		                            </tr>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="receta-footer text-muted">
		        <br>
		        &nbsp;<br>
		        <h4 class="m-b-0 m-t-0"><strong>Modelaser Rancagua</strong></h4>
		        <h4 class="m-b-0 m-t-0"><strong>SERVICIOS MÉDICOS</strong></h4>
		        <h5 class="m-b-0 m-t-0">RUT: 76.050.085-2</h5>
		        <h6 class="m-b-0 m-t-0">
		            Av. Bombero Villalobos 1049, Ofs. 206 - 208 - Rancagua<br>
		            Tel.: 72 2218905 - 71 2214695<br>
		            wwww.modelaser.cl
		        </h6>
		        <br>
		        <small>Imp. Antártida - Hugo Fuentes C. - Rut.: 4.721.334-7 - Zañartu 570 - Fono 722 231219 - Rgua.</small>
		    </div>
		</div>
	    <!----------- end receta --------->
    </div>

    <div id="modal_paciente"></div>
    <!--Modal Editar Paciente -->

	<!-- =============== MODAL SUBIR DOCUMENTOS DE CITA MEDICA ================ -->
	<div class="modal fade" id="modal_add_docs" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_pacientes_name" style="float: left;">Subir documento nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
	                 <?php
	            		$attributes = array('class'=>'form','id'=>'frmDocumentos','name'=>'frmDocumentos','target'=>'_self','autocomplete'=>'off');
	                    echo form_open_multipart('Docs/documentos/',$attributes);
	                ?>
					    <div class="fileupload-buttonbar">
							<input type="hidden" name="id_cita" id="id_cita" class="form-control" placeholder="Rayos X">
					    	<div class="col-md-4">
					    		<label for="title">Nombre:</label>
	    						<input type="text" name="nombre_doc" id="nombre_doc" value="" class="form-control" placeholder="Costilla fracturada">
					    	</div>
					    	<div class="col-md-4">
					    		<label for="title">Descripción:</label>
	    						<input type="text" name="descripcion" id="descripcion" value="" class="form-control" placeholder="Costilla fracturada">
					    	</div>
					        <div class="col-md-4">
					        	<label for="title">Documento:</label>
							    <?php echo form_error('tarch','<div class="alert alert-danger">','</div>'); 
		                        $campo = array('name'  => 'tarch','id'  => 'tarch','value' => set_value('tarch'),'placeholder' => 'Seleccione un Archivo a Subir','class' => 'form-control', 'title'=>"Seleccione un archivo");
		                        echo form_upload($campo); 
		                      ?>
					        </div>
					    </div>
						<!--button type="submit" class="btn btn-sm btn-success hidden">Subir</button-->
					<?php echo form_close(); ?>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-sm btn-success" id="up_file" onclick="subir_doc_cita()"><i class="fa fa-upload" aria-hidden="true"></i> Subir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== MODAL SUBIR DOCUMENTOS DE CITA MEDICA ================ -->
    
	<!-- =============== MODAL DATOS PACIENTES ================ -->
	<div class="modal fade" id="modal_pacientes" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_pacientes_name" style="float: left;">Modal paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="load_action_paciente"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="click_add()" id="actionAddEdit">Agregar/Actualizar/Visualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== MODAL DATOS PACIENTES ================ -->
    
    <!-- =============== MODAL HISTORIAL CONSULTAS PACIENTE ================ -->
	<div class="modal fade" id="modal_historial_citas" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_historial_paciente_name" style="float: left;">Historial de consultas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="load_historial_citas_paciente"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar historial</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== MODAL HISTORIAL CONSULTAS PACIENTE ================ -->
    
    <!-- =============== MODAL RECETAS ================ -->
	<div id="load_modal_recetas"></div>
	<!-- =============== MODAL RECETAS ================ -->
	
	<!-- =============== MODAL CONSULTA ================ -->
	<div id="load_modal_consulta"></div>
	<!-- =============== MODAL CONSULTA ================ -->


	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script>
		var medico_id =  <?php echo $_SESSION['user_id']; ?>;
	</script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/load_tabs.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/medico_citas.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/usuario_pacientes.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/notificaciones.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/horarios_medicos.js"></script>

	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
