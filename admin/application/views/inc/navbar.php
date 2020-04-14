	<?php
		$datos_clinica = $this->session->userdata();
		$clinica = array_column($datos_clinica, 'clinicas');
		$nombre_clinica = array_column($clinica[0], 'nombre');
		$user_foto = "<?php echo base_url() ?>plantilla2/images/users/member_1.jpg";
	?>
		<!-- begin #header -->
			<div id="header" class="header navbar navbar-default navbar-fixed-top">
				<!-- begin container-fluid -->
				<div class="container-fluid">
					<!-- begin mobile sidebar expand / collapse button -->
					<div class="navbar-header">
						
							

							

							 <a href="<?php base_url('Usuario/home') ?>" class="navbar-brand" id="clinica_nombre" name="#"><span class="navbar-logo"></span>Emedic</a>

							
						
						<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- end mobile sidebar expand / collapse button -->
					
					<!-- begin header navigation right -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="<?php echo base_url('Usuario/miperfil/').$info['user_id'] ?>" data-toggle="dropdown" class="dropdown-toggle f-s-14">
								<i class="fa fa-bell-o"></i>
								<span class="label" id="cnt_alerts">3</span>
							</a>
							<div id="alertas_medico" class="dropdown-menu animated fadeInDown">
								<ul class="media-list pull-right">
		                            <li class="dropdown-header">Notificaciones (3)</li>
		                            <li class="media">
		                                <a href="javascript:;">
		                                    <div class="media-left"><img src="<?php echo base_url().RUTA_USUARIOS.$perfil->foto ?>" class="media-object" alt="" /></div>
		                                    <div class="media-body">
		                                        <h6 class="media-heading">Dr. Demo</h6>
		                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
		                                        <div class="text-muted f-s-11">25 minutes ago</div>
		                                    </div>
		                                </a>
		                            </li>
		                            <li class="media">
		                                <a href="javascript:;">
		                                    <div class="media-left"><img src="<?php echo base_url().RUTA_USUARIOS.$perfil->foto ?>" class="media-object" alt="" /></div>
		                                    <div class="media-body">
		                                        <h6 class="media-heading">Sra. Olivia</h6>
		                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
		                                        <div class="text-muted f-s-11">35 minutes ago</div>
		                                    </div>
		                                </a>
		                            </li>
		                            <li class="media">
		                                <a href="javascript:;">
		                                    <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
		                                    <div class="media-body">
		                                        <h6 class="media-heading"> Nueva cita asignada el día 25 de dic.</h6>
		                                        <div class="text-muted f-s-11">1 hour ago</div>
		                                    </div>
		                                </a>
		                            </li>
		                            <li class="dropdown-footer text-center">
		                                <a href="javascript:;">Ver más</a>
		                            </li>
								</ul>
							</div>
						</li>
						<li class="dropdown navbar-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url().RUTA_USUARIOS.$perfil->foto ?>" alt="" /> 
								<span class="hidden-xs"><?php echo $perfil->nombre ?></span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu animated fadeInLeft">
								<li class="arrow"></li>
								<li><a href="<?php echo base_url('Usuario/miperfil/').$info['user_id'] ?>">Editar perfil</a></li>
								<!--li><a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn">Configuración de color</a></li-->
								<li class="divider"></li>
								<li><a href="<?php echo base_url('Login/log_out') ?>">Salir</a></li>
							</ul>
						</li>
					</ul>
					<!-- end header navigation right -->
				</div>
				<!-- end container-fluid -->
			</div>
			<!-- end #header -->