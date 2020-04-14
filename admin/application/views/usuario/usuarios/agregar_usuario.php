	<?php    
			$attributes = array('class' => 'frmAgregar', 'id' => 'frmAgregar', 'target' => '_self');
			echo form_open('usuario/agregar_usuario',$attributes);
        ?>
        		<style>
	        		.form-group {margin: 0;}
        		</style>
	        <div class="form-group">
	            <label for="username" class="col-sm-2 control-label text-right m-t-10">Usuario <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="administrador" name="username" type="text" required="" autofocus>
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="nombre" class="col-sm-2 control-label text-right m-t-10">Nombre <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="Juan Manuel" name="nombre" type="text" required="">
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="apellidopat" class="col-sm-2 control-label text-right m-t-10">Apellido paterno <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="Sánchez" name="apellidopat" type="text" required="">
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="apellidoma" class="col-sm-2 control-label text-right m-t-10">Apellido materno <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="López" name="apellidoma" type="text" required="">
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>

	        <div class="form-group">
	            <label for="apellidoma" class="col-sm-2 control-label text-right m-t-10">Rut <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="12.573.235.C" name="rut" type="text" required="">
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>


	        <div class="form-group">
	            <label for="email" class="col-sm-2 control-label text-right m-t-10">Usuario <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="jlopez@gmail.com" name="email" type="email" required="">
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="password" class="col-sm-2 control-label text-right m-t-10">Contraseña <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <input class="form-control" placeholder="******" name="password" type="password" required="">
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>
			<div   class="form-group">
				<label for="user" class="col-sm-2 control-label text-right m-t-10">Tipo de usuario <span style="color:red;">*</span></label>
				<div class="col-sm-10">
			    <select class="form-control" name="user" required="">
				        <option value="">Seleccione Tipo de Usuario</option>
				        <?php foreach ($grupos as $key ) { ?>
				        		<option value="<?php echo $key->id ?>"><?php echo $key->nombre_grupo ?></option>
				        <?php } ?>
				    </select>
				</div>
			</div>
			<div class="form-group hidden">
			    <input id="submit_add_usuario" type="submit" class="btn btn-lg btn-info btn-medic btn-block" value="Registrar">
			</div>           
         <?php echo form_close(); ?>