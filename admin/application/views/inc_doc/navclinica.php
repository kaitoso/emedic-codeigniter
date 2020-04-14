<?php
		$user_foto = "<?php echo base_url() ?>plantilla2/images/users/member_1.jpg";
	?>
		<!-- begin #header -->
			<div id="header" class="header navbar navbar-default navbar-fixed-top">
				<!-- begin container-fluid -->
				<div class="container-fluid">
					<!-- begin mobile sidebar expand / collapse button -->
					<div class="navbar-header">
						<a href="./" class="navbar-brand"><span class="navbar-logo"></span> eMedic</a>
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
							<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
								<i class="fa fa-bell-o"></i>
								<span class="label" id="cnt_alerts">3</span>
							</a>
							<div id="alertas_medico" class="dropdown-menu animated fadeInDown">
								<ul class="media-list pull-right">
		                            <li class="dropdown-header">Notificaciones (3)</li>
		                            <li class="media">
		                                <a href="javascript:;">
		                                    <div class="media-left"><img src="<?php echo base_url() ?>plantilla2/assets/img/user-1.jpg" class="media-object" alt="" /></div>
		                                    <div class="media-body">
		                                        <h6 class="media-heading">Dr. Demo</h6>
		                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
		                                        <div class="text-muted f-s-11">25 minutes ago</div>
		                                    </div>
		                                </a>
		                            </li>
		                            <li class="media">
		                                <a href="javascript:;">
		                                    <div class="media-left"><img src="<?php echo base_url() ?>plantilla2/assets/img/user-2.jpg" class="media-object" alt="" /></div>
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
								<img src="<?php echo base_url() ?>plantilla2/images/users/member_1.jpg" alt="" /> 
								<span class="hidden-xs"><?php echo $info['nombre']; ?></span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu animated fadeInLeft">
								<li class="arrow"></li>
								<li><a href="javascript:;">Editar perfil</a></li>
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