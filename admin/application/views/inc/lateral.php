			<!-- ================== BEGIN PAGE CSS STYLE ================== -->
			<link href="<?php echo base_url() ?>plantilla2/assets/plugins/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" />
			<link href="<?php echo base_url() ?>plantilla2/assets/css/icons_medic.css" rel="stylesheet">
			<!--[if lte IE 7]><script src="../assets/plugins/simple-line-icons/icons-lte-ie7.js"></script><![endif]-->
			<!-- ================== BEGIN PAGE CSS STYLE ================== -->
					        
		    <!-- begin #sidebar -->
			<div id="sidebar" class="sidebar">
				<!-- begin sidebar scrollbar -->
				<div data-scrollbar="true" data-height="100%">
					<!-- begin sidebar user -->
					<ul class="nav">
						<li class="nav-profile" style="overflow:hidden">
							<div class="image">
								<a href="javascript:;"><img src="<?php echo base_url().RUTA_USUARIOS.$perfil->foto ?>" alt="" /></a>
							</div>
							<div class="info truncate-text" title="<?php echo $perfil->nombre.' '.$perfil->apellido_paterno.' '.$perfil->apellido_materno; ?>">
								<small>Bienvenido</small>
								<?php echo $perfil->nombre.' '.$perfil->apellido_paterno.' '.$perfil->apellido_materno; ?>
							</div>
						</li>
					</ul>
					<!-- end sidebar user -->
					<!-- begin sidebar nav -->
					<ul class="nav">
						<li class="nav-header">Menú principal</li>
						<li><a href="<?php echo base_url('agenda/#inicio') ?>" data-toggle="ajax" onclick="obtener_hash('inicio')"><i class="icon-home"></i> <span>Inicio</span></a></li>
						<li><a href="<?php echo base_url('agenda/#pacientes') ?>" data-toggle="ajax" onclick="obtener_hash('pacientes')"><i class="medicon-paciente"></i> <span>Pacientes</span></a></li>
						<li><a href="<?php echo base_url('agenda/#citas') ?>" onclick="obtener_hash('citas')"><i class="icon-calendar"></i> <span>Agenda</span></a></li>
						<li><a href="<?php echo base_url('agenda/#citas_del_dia') ?>" onclick="obtener_hash('citas_del_dia')"><i class="medicon-agenda-hora"></i> <span>Citas del día</span></a></li>
						<!--li><a href="<?php echo base_url('agenda/#consultas_del_dia') ?>" onclick="obtener_hash('consultas_del_dia')" data-toggle="ajax"><i class="medicon-medical-2"></i> <span>Consultas médicas</span></a></li-->
						<li><a href="<?php echo base_url('agenda/#medicinas') ?>" onclick="obtener_hash('medicinas')" data-toggle="ajax"><i class="medicon-pill"></i> <span>Medicamentos</span></a></li>
						<li class="has-sub">
						    <a href="javascript:;">
						        <b class="caret pull-right"></b>
						        <i class="medicon-pulse"></i>
						        <span>Reportes</span>
						    </a>
							<ul class="sub-menu">
								<li><a href="#" data-toggle="ajax">Historial del paciente</a></li>
								<li><a href="#" data-toggle="ajax">Pagos del paciente</a></li>
								<li><a href="<?php echo base_url('agenda/#citas_medico') ?>" onclick="obtener_hash('citas_medico')" data-toggle="ajax">Citas del d&iacute;a</a></li>
							</ul>
						</li>

							<?php if ($info['id_grupo']>=3) {
							
								 ?>
						<li class="has-sub">
						    <a href="javascript:;">
						        <b class="caret pull-right"></b>
						        <i class="medicon-pulse"></i>
						        <span>Migración</span>
						    </a>
							<ul class="sub-menu">
								<li><a href="<?php echo base_url('Usuario/migra_pacientes') ?>" data-toggle="ajax">Pacientes</a></li>
								<li><a href="<?php echo base_url('Usuario/migra_medicinas') ?>" data-toggle="ajax">Medicamentos </a></li>
								<li><a href="<?php echo base_url('Usuario/migra_medicos') ?>" data-togle="ajax">Personal</a></li>
								<li><a href="<?php echo base_url('Usuario/migra_citas') ?>" data-togle="ajax">Citas Historicas</a></li>
							</ul>
						</li>
					<?php } ?>


						<?php if ($info['id_grupo']==3 || $info['id_grupo']==4 || $info['id_grupo']==2) {
							# code...
						 ?>
						<li class="has-sub">
						    <a href="javascript:;">
						        <b class="caret pull-right"></b>
						        <i class="icon-settings"></i>
						        <span>Configuración</span>
						    </a>
							<ul class="sub-menu">
								<?php if ($info['id_grupo']==4) {
								 ?>
									<li><a href="<?php echo base_url('Usuario/adm_clinicas') ?>" data-toggle="ajax">Administrar Clinicas</a></li>
								 <?php } ?>
								 <?php if ($info['id_grupo']==4 || $info['id_grupo']==3 || $info['id_grupo']==2) { ?>
									<li><a href="<?php echo base_url('Usuario/horarios') ?>" data-toggle="ajax">Roles de medicos</a></li>
								 <?php } ?>
								 <?php if ($info['id_grupo']==4 || $info['id_grupo']==3 ) { ?>
								<li><a href="<?php echo base_url('Usuario/informa_clinica') ?>" data-toggle="ajax">Clínica</a></li>
								<li><a href="<?php echo base_url('Usuario/permisos') ?>" data-toggle="ajax">Grupos de usuarios</a></li>
								<li><a href="<?php echo base_url('usuarios/#usuarios') ?>" onclick="obtener_hash('usuarios')" data-toggle="ajax"><span>Usuarios</span></a></li>
								<?php } ?>
							</ul>
						</li>
						<?php } ?>

					
				        <!-- begin sidebar minify button -->
						<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				        <!-- end sidebar minify button -->
					</ul>
					<!-- end sidebar nav -->
				</div>
				<!-- end sidebar scrollbar -->
			</div>
			<div class="sidebar-bg"></div>
			<!-- end #sidebar -->
			
			<!-- begin #ajax-content -->
			<div id="ajax-content"></div>
			<!-- end #ajax-content -->
			
		