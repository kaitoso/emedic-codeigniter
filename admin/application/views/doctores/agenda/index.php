

	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<!-- begin #content -->
	<div id="content" class="content">
	    <!-- begin page-header -->
	    <h1 class="page-header">Agenda médica v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <div class="tab">
			<button class="tablinks" onclick="openAjaxInfo(event, 'citas')" id="citas_">Agenda</button>
			<button class="tablinks" onclick="openAjaxInfo(event, 'citas_del_dia')" id="citas_del_dia_">Citas del día</button>
		</div>
	    <!-- begin row -->
		<div class="row tabcontent" id="citas"></div>
		<div class="row tabcontent" id="citas_del_dia"></div>
	</div><!-- end #content -->

	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/assets/js/agenda_citas.js"></script>
	<style>
		 /* Style the tab */
		.tab {
		    overflow: hidden;
		    border: 1px solid #ccc;
		    background-color: #f1f1f1;
		    margin-bottom: 25px;
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
		
		/* Go from zero to full opacity */
		@keyframes fadeEffect {
		    from {opacity: 0;}
		    to {opacity: 1;}
		}
	</style>
	
	
	
	<!-----------------MODAL AGENDAR CITA-------------------->
	<div class="modal fade" id="modal_agendar_cita" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_agendar_cita" style="float: left;">Agendar cita a las: <span id="hora_agendado"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="nombre">Comentario</label>
                        <input type="textarea" class="form-control" id="comentario" name="comentario" placeholder="Comentario ">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn_agendado" onclick="agendar_cita();" data-dismiss="modal">Agendar</button>
                </div>
            </div>
        </div>
    </div>
    <!-----------------MODAL AGENDAR CITA-------------------->
	
	
	
	<!-----------------MODAL AGENDAR SOBRECUPO-------------------->
	<div class="modal fade" id="modalSobreCupo" tabindex="10" role="dialog">
	    <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalSobreCupo" style="float: left;">Agendar Sobrecupo</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">	
				<div class="form-group col-md-12">
					<label for="nombre">Hora:</label>
					<select type="text" class="form-control" id="hora_sobrecupo_lista" name="hora_sobrecupo_lista" placeholder="Hora ">
						<option>HORA!</option>
					</select>
				</div>
				<div class="form-group col-md-12">
					<label for="nombre">Comentario</label>
					<input type="textarea" class="form-control" id="comentario_sobrecupo" name="comentario_sobrecupo" placeholder="Comentario ">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-primary" onclick="agendar_sobrecupo();" data-dismiss="modal">Agendar Sobrecupo</button>
		      </div>
		    </div>
		 </div>
	</div>
	<!-----------------MODAL SOBRECUPO-------------------->
	


	
	
	<!-----------------MODAL CANCELAR-------------------->
	<div class="modal fade" id="modalCancelar" tabindex="10" role="dialog">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalCancelar" style="float: left;">Cancelar cita de las: <span id="hora_cancelacion"></span></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
				<div class="form-group col-md-12">
					<label for="nombre">Motivo de cancelación</label>
					
					<select class="form-control" id="motivo_cancelacion" name="motivo_cancelacion">
						<option value="0">-- Seleccione motivo --</option>
							<?php  
								if (isset($motivos) and is_array($motivos) ) { 
									foreach ($motivos as $key ) {  
										echo '<option value="'.$key->id.'">'.$key->nombre.'</option>';
									}
								} 
							?>
					</select>
				</div>
				<div class="form-group col-md-12">
					<label for="observacion">Observación</label>
					<input type="textarea" class="form-control" id="observacion" name="observacion" placeholder="Observación">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary btn_cancel" onclick="cancelar_cita()" data-dismiss="modal">Cancelar cita</button>
		      </div>
		    </div>
		 </div>
	</div>
	<!-----------------MODAL CANCELAR-------------------->


