<?php 
	$attributes = array('class' => 'form', 'id' => 'frmEditarMedicamentos', 'target' => '_self');
	echo form_open('Usuario/editar_medicamentos',$attributes);
?>         
	<?php
			$campo = array(
				'name'  => 'id_medicamento',
				'id'  => 'id_medicamento',
				'value' => set_value('id_medicamento',$medicamento->id),
				'class' => 'form-control hidden',
				'required' => ''
			);
			
			echo form_input($campo); 
        ?>                    
	<div class="row">
	    <div class="col-md-12">
	        <div class="form-group">
	            <label for="codigo" class="col-sm-2 control-label">Código</label>
	            <div class="col-sm-10">
	                <?php
	                    $campo = array(
		                    'name'  => 'codigo',
		                    'id'  => 'codigo',
		                    'value'=>set_value('codigo', $medicamento->codigo),
		                    'placeholder' => 'Indique código',
		                    'class' => 'form-control',
		                    'required' => '',
		                    'disabled' => 'disabled'
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
	            <label for="medicamento" class="col-sm-2 control-label">Medicamento <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <?php
	                    $campo = array(
		                    'name'  => 'nombre_medicamento',
		                    'id'  => 'nombre_medicamento',
		                    'value'=>set_value('nombre_medicamento',$medicamento->nombre),
		                    'placeholder' => 'Indique nombre del medicamento',
		                    'class' => 'form-control',
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
	            <label for="medicamento_fisticio" class="col-sm-2 control-label">Nombre genérico <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <?php
	                    $campo = array(
	                    'name'  => 'nombre_fisticio',
	                    'id'  => 'nombre_fisticio',
	                    'value'=>set_value('nombre_fisticio',$medicamento->nombre_fisticio),
	                    'placeholder' => 'Indique nombre genérico del medicamento',
	                    'class' => 'form-control',
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
	            <label for="pre" class="col-sm-2 control-label">Presentación del medicamento <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <?php
	                    $campo = array(
		                    'name'  => 'presentacion',
		                    'id'  => 'presentacion',
		                    'value'=>set_value('presentacion',$medicamento->presentacion),
		                    'placeholder' => 'Indique presentación',
		                    'class' => 'form-control',
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
            <label for="concentracion" class="col-sm-2 control-label">Vía de Admón <span style="color:red;">*</span></label>
            <div class="col-sm-10">
                <?php
                    $campo = array(
	                    'name'  => 'via_admon',
	                    'id'  => 'via_admon',
	                    'value'=>set_value('via_admon',$medicamento->via_admon),
	                    'placeholder' => 'Indique la vía de administración del medicamento',
	                    'class' => 'form-control',
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
	            <label for="con" class="col-sm-2 control-label">Concentración <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
	                <?php
	                    $campo = array(
		                    'name'  => 'concentracion',
		                    'id'  => 'concentracion',
		                    'value'=>set_value('concentracion',$medicamento->concentracion),
		                    'placeholder' => 'Indique concentración',
		                    'class' => 'form-control',
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
	            <label for="estado" class="col-sm-2 control-label">Estado</label>
	            <div class="col-sm-10">
	                <select class="form-control" id="estado" name="estado">
	                    <?php if ($medicamento->estado==1) { ?>
		                    <option value="<?php echo $medicamento->estado ?>">Disponible</option>
		                    <option value="<?php echo 0 ?>">No Disponible</option>
	                    <?php } ?>
	                    <?php if ($medicamento->estado==0) { ?>
		                    <option value="<?php echo $medicamento->estado ?>">No Disponible</option>
		                    <option value="<?php echo 1 ?>">Disponible</option>
	                    <?php } ?>
	                </select>
	                <p class="help-block text-danger"></p>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="row hidden">
	    <div class="col-md-12 text-center">
	        <div id="success"></div>
	        <button type="submit" class="btn btn-xl btn-success" id="submit_edit_medicamento">Actualizar</button>
	    </div>
	</div>
<?php echo form_close(); ?>