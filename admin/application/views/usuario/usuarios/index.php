
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
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
	    <h1 class="page-header">Usuarios v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <div class="tab">
	    	<button class="tablinks" onclick="openAjaxInfo(event, 'usuarios')" id="usuarios_">Usuarios</button>
		</div>
	    <!-- begin row -->
	    <div class="row tabcontent" id="usuarios"></div>
	</div><!-- end #content -->
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/js/usuarios.js"></script>
   
   <!-- =============== MODAL CREAR/EDITAR PACIENTE ================ -->
	<div class="modal fade" id="modal_usuarios" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_usuarios_name" style="float: left;">Modal usuarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="load_cont_usuarios"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="click_add()" id="actionAddEdit">Agregar/Actualizar/Visualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== MODAL CREAR/EDITAR PACIENTE ================ -->