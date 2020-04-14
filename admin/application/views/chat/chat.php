	<!--/* CSS CHAT */-->
	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>/plantilla2/assets/css/chat.css" />


	<a href="javascript:void(0)" id="openChat" class="chat_ini"><i class="material-icons">&#xE0B7;</i></a>

	<div class="popup-box chat-popup" id="qnimate">
	    <div class="popup-head">
	        <div class="popup-head-left float-left"><img class="rounded-circle" src="<?php echo base_url('img/users/'.$info['foto']) ?>" alt="<?php echo  $info['nombre'] ?>"> <span id="chat_medic"><?php echo $info['nombre']; ?></span></div>  
	        <div class="popup-head-right float-right">
	            <button data-widget="remove" id="closeChat" class="chat-header-button float-right" type="button">
	            		<i class="material-icons">&#xE8AC;</i>
	            </button>
	        </div>
	    </div>
	    <div class="popup-messages" style="height: 356px;">
		     <ul class="lista_usuarios_medic">
		    		<?php
					if(isset($listOfUsers) and is_array($listOfUsers) and count($listOfUsers)>0){
						foreach($listOfUsers as $res){
				?>
					<?php if($info['username']===$res->usuario && $info['user_id']===$res->id) { ?>
						<li class="usr_medic" style="display: none;">
							<div class="username" id="n_medic">
									<?php } else { ?>  
									<li class="usr_medic">
										<div class="username">
											<a href="javascript:void(0)" onclick="chatWith('<?php echo  $res->id ?>','<?php echo  $res->usuario ?>','img/users/<?php echo $res->foto ?>','<?php echo $perfil->usuario ?>','<?php echo $info['user_id'] ?>','img/users/<?php echo $info['foto']?>');">
												<img class="rounded-circle" src="<?php echo base_url('img/users/'.$res->foto);?>">
									<?php } ?>      
									<?php echo "<span>$res->nombre $res->apellido_paterno $res->apellido_materno</span>";  ?>
								</a>
							</div>
						</li>
				<?php 
						} // end foreach loop
					}else{
						echo "Usuarios no disponibles";
					} // end if condition
				?>  
			</ul>
		    
	    </div>
	</div>
	
	
	<!--/* JS CHAT */-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>plantilla2/assets/js/chat.js"></script>
	<script type="text/javascript">
		jQuery('#openChat').on('click', function() {
			jQuery('#qnimate').css('display','block');
		});
		jQuery('#closeChat').on('click', function() {
			jQuery('#qnimate').css('display','none');
		});
	</script>
