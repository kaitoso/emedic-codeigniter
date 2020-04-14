<?php 
    $attributes = array('class' => 'form', 'id' => 'frmAgregarMedicamentos', 'target' => '_self');
    echo form_open('Usuario/agregar_medicamentos', $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre_medicamento" class="col-sm-2 control-label">Medicamento <span style="color:red;">*</span></label>
            <div class="col-sm-10">
                <?php
                    $campo = array(
	                    'name'  => 'nombre_medicamento',
	                    'id'  => 'nombre_medicamento',
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
            <label for="nombre_fisticio" class="col-sm-2 control-label">Nombre genérico <span style="color:red;">*</span></label>
            <div class="col-sm-10">
                <?php
                    $campo = array(
	                    'name'  => 'nombre_fisticio',
	                    'id'  => 'nombre_fisticio',
	                    'placeholder' => 'Indique nombre genérico del medicamento',
	                    'class' => 'form-control','required' => ''
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
            <label for="presentacion" class="col-sm-2 control-label">Presentación del medicamento <span style="color:red;">*</span></label>
            <div class="col-sm-10 m-t-5">
                <?php
                    $campo = array(
	                    'name'  => 'presentacion',
	                    'id'  => 'presentacion',
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
            <label for="concentracion" class="col-sm-2 control-label">Concentración <span style="color:red;">*</span></label>
            <div class="col-sm-10">
                <?php
                    $campo = array(
	                    'name'  => 'concentracion',
	                    'id'  => 'concentracion',
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
            <label for="concentracion" class="col-sm-2 control-label">Vía de Admón <span style="color:red;">*</span></label>
            <div class="col-sm-10">
                <?php
                    $campo = array(
	                    'name'  => 'via_admon',
	                    'id'  => 'via_admon',
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
<div class="row hidden">
    <div class="col-md-12 text-center">
        <div id="success"></div>
        <button type="submit" class="btn btn-xl btn-success" id="submit_add_medicamento">Registrar</button>
    </div>
</div>
<?php echo form_close(); ?>