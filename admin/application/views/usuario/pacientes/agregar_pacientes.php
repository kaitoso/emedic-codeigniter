		<?php 
	        $attributes = array('id'=>'frmAgregar','class'=>'form was-validated','action'=>'','name'=>'frmAgregar','target'=>'_self','autocomplete'=>'off');   
	        echo form_open_multipart('Usuario/agregar_pacientes',$attributes);
	    ?>
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="nombre" class="col-sm-2 control-label text-right m-t-10">Nombre(s) <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'nombre',
	                  'id'  => 'nombre',
	                  'placeholder' => 'Indique nombre(s)',
	                  'class' => 'form-control',
	                  'pattern' => "[a-zA-Zà'áâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}",
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
	          <label for="apellidopat" class="col-sm-2 control-label text-right m-t-10">Apellido paterno <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'apellidopat',
	                  'id'  => 'apellidopat',
	                  'placeholder' => 'Indique apellido paterno',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su apellido paterno',
	                  'pattern' => "[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}",
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
	          <label for="apellidos" class="col-sm-2 control-label text-right m-t-10">Apellido materno <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'apellidomat',
	                  'id'  => 'apellidomat',
	                  'placeholder' => 'Indique apellido materno',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su apellido materno',
	                  'pattern' => "[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}",
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
	          <label for="rut" class="col-sm-2 control-label text-right m-t-10">RUT/Otro <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
	            <?php
	               $campo = array(
	                  'name'  => 'rut',
	                  'id'  => 'rut',
	                  'placeholder' => '14.569.484-1',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique RUT u otro documento',
	                  'required' => ''
	              );
	              
	              echo form_input($campo); 
	            ?>
	            <label id="rut-error" class="error" for="rut" style="display:none;">Rut inv&aacute;lido</label>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>
	
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="dir" class="col-sm-2 control-label text-right m-t-10">Dirección</label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'dir',
	                  'id'  => 'dir',
	                  'placeholder' => 'Indique dirección',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su dirección'
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
	          <label for="cel" class="col-sm-2 control-label text-right m-t-10">Celular <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'cel',
	                  'id'  => 'cel',
	                  'type' => 'tel',
	                  'placeholder' => 'Indique número celular',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su número celular',
	                  'pattern' => '[0-9]+',
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
	          <label for="tel" class="col-sm-2 control-label text-right m-t-10">Teléfono</label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'tel',
	                  'id'  => 'tel',
	                  'type' => 'tel',
	                  'placeholder' => 'Indique número teléfono',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su número teléfono',
	                  'pattern' => '[0-9]+'
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
	          <label for="email" class="col-sm-2 control-label text-right m-t-10">Email</label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'email',
	                  'id'  => 'email',
	                  'type' => 'email',
	                  'placeholder' => 'Indique correo electrónico',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su  correo electrónico',
	                  'pattern' => "^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
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
	            <label for="tfecha" class="col-sm-2 control-label text-right">Fecha de nacimiento <span style="color:red;">*</span></label>
	            <div class="col-sm-10">
		            <div class="row">
			            <div class="col-sm-4">
				            <select id="dia_fechaNacimiento" class="form-control" onchange="load_fechaNacimiento()">
							    <option value="0">Día</option>
							    <option value="01">01</option>
							    <option value="02">02</option>
							    <option value="03">03</option>
							    <option value="04">04</option>
							    <option value="05">05</option>
							    <option value="06">06</option>
							    <option value="07">07</option>
							    <option value="08">08</option>
							    <option value="09">09</option>
							    <option value="10">10</option>
							    <option value="11">11</option>
							    <option value="12">12</option>
							    <option value="13">13</option>
							    <option value="14">14</option>
							    <option value="15">15</option>
							    <option value="16">16</option>
							    <option value="17">17</option>
							    <option value="18">18</option>
							    <option value="19">19</option>
							    <option value="20">20</option>
							    <option value="21">21</option>
							    <option value="22">22</option>
							    <option value="23">23</option>
							    <option value="24">24</option>
							    <option value="25">25</option>
							    <option value="26">26</option>
							    <option value="27">27</option>
							    <option value="28">28</option>
							    <option value="29">29</option>
							    <option value="30">30</option>
							    <option value="31">31</option>
							</select>
			            </div>
						<div class="col-sm-4">
							<select id="mes_fechaNacimiento" class="form-control" onchange="load_fechaNacimiento()">
							    <option value="0">Mes</option>
							    <option value="01">Enero</option>
							    <option value="02">Febrero</option>
							    <option value="03">Marzo</option>
							    <option value="04">Abril</option>
							    <option value="05">Mayo</option>
							    <option value="06">Junio</option>
							    <option value="07">Julio</option>
							    <option value="08">Agosto</option>
							    <option value="09">Septiembre</option>
							    <option value="10">Octubre</option>
							    <option value="11">Noviembre</option>
							    <option value="12">Diciembre</option>
							</select>
						</div>
						<div class="col-sm-4">
							<select id="ano_fechaNacimiento" class="form-control" onchange="load_fechaNacimiento()">
							    <option value="0">Año</option>
							    <option value="2018">2018</option>
							    <option value="2017">2017</option>
							    <option value="2016">2016</option>
							    <option value="2015">2015</option>
							    <option value="2014">2014</option>
							    <option value="2013">2013</option>
							    <option value="2012">2012</option>
							    <option value="2011">2011</option>
							    <option value="2010">2010</option>
							    <option value="2009">2009</option>
							    <option value="2008">2008</option>
							    <option value="2007">2007</option>
							    <option value="2006">2006</option>
							    <option value="2005">2005</option>
							    <option value="2004">2004</option>
							    <option value="2003">2003</option>
							    <option value="2002">2002</option>
							    <option value="2001">2001</option>
							    <option value="2000">2000</option>
							    <option value="1999">1999</option>
							    <option value="1998">1998</option>
							    <option value="1997">1997</option>
							    <option value="1996">1996</option>
							    <option value="1995">1995</option>
							    <option value="1994">1994</option>
							    <option value="1993">1993</option>
							    <option value="1992">1992</option>
							    <option value="1991">1991</option>
							    <option value="1990">1990</option>
							    <option value="1989">1989</option>
							    <option value="1988">1988</option>
							    <option value="1987">1987</option>
							    <option value="1986">1986</option>
							    <option value="1985">1985</option>
							    <option value="1984">1984</option>
							    <option value="1983">1983</option>
							    <option value="1982">1982</option>
							    <option value="1981">1981</option>
							    <option value="1980">1980</option>
							    <option value="1979">1979</option>
							    <option value="1978">1978</option>
							    <option value="1977">1977</option>
							    <option value="1976">1976</option>
							    <option value="1975">1975</option>
							    <option value="1974">1974</option>
							    <option value="1973">1973</option>
							    <option value="1972">1972</option>
							    <option value="1971">1971</option>
							    <option value="1970">1970</option>
							    <option value="1969">1969</option>
							    <option value="1968">1968</option>
							    <option value="1967">1967</option>
							    <option value="1966">1966</option>
							    <option value="1965">1965</option>
							    <option value="1964">1964</option>
							    <option value="1963">1963</option>
							    <option value="1962">1962</option>
							    <option value="1961">1961</option>
							    <option value="1960">1960</option>
							    <option value="1959">1959</option>
							    <option value="1958">1958</option>
							    <option value="1957">1957</option>
							    <option value="1956">1956</option>
							    <option value="1955">1955</option>
							    <option value="1954">1954</option>
							    <option value="1953">1953</option>
							    <option value="1952">1952</option>
							    <option value="1951">1951</option>
							    <option value="1950">1950</option>
							    <option value="1949">1949</option>
							    <option value="1948">1948</option>
							    <option value="1947">1947</option>
							    <option value="1946">1946</option>
							    <option value="1945">1945</option>
							    <option value="1944">1944</option>
							    <option value="1943">1943</option>
							    <option value="1942">1942</option>
							    <option value="1941">1941</option>
							    <option value="1940">1940</option>
							    <option value="1939">1939</option>
							    <option value="1938">1938</option>
							    <option value="1937">1937</option>
							    <option value="1936">1936</option>
							    <option value="1935">1935</option>
							    <option value="1934">1934</option>
							    <option value="1933">1933</option>
							    <option value="1932">1932</option>
							    <option value="1931">1931</option>
							    <option value="1930">1930</option>
							    <option value="1929">1929</option>
							    <option value="1928">1928</option>
							    <option value="1927">1927</option>
							    <option value="1926">1926</option>
							    <option value="1925">1925</option>
							    <option value="1924">1924</option>
							    <option value="1923">1923</option>
							    <option value="1922">1922</option>
							    <option value="1921">1921</option>
							    <option value="1920">1920</option>
							    <option value="1919">1919</option>
							    <option value="1918">1918</option>
							    <option value="1917">1917</option>
							    <option value="1916">1916</option>
							    <option value="1915">1915</option>
							    <option value="1914">1914</option>
							    <option value="1913">1913</option>
							    <option value="1912">1912</option>
							    <option value="1911">1911</option>
							    <option value="1910">1910</option>
							    <option value="1909">1909</option>
							    <option value="1908">1908</option>
							    <option value="1907">1907</option>
							    <option value="1906">1906</option>
							    <option value="1905">1905</option>
							</select>
						</div>
		            </div>
	            </div>
				<input type="hidden" name="tfecha" id="tfecha" name="tfecha">
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>
	    
	    <!--div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="tfecha" class="col-sm-2 control-label text-right">Fecha de nacimiento <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
	              <div class='input-group date' id='datepicker'>
	                <input type='text' class="form-control" id="tfecha" name="tfecha" style="pointer-events: none;cursor: default;text-decoration:none;background: #e5e9ed;opacity: 0.6;" required>
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
	           
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div-->
	
		<div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="edad" class="col-sm-2 control-label text-right m-t-10">Edad</label>
	          <div class="col-sm-10">
	            <p class="form-control-static" id="edadPaciente">
	               Seleccione fecha de nacimiento
	            </p>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="prof" class="col-sm-2 control-label  text-right m-t-10">Profesión</label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'prof',
	                  'id'  => 'prof',
	                  'placeholder' => 'Indique profesión',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su profesión',
	                  'pattern' => '[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+'
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
	          <label for="email" class="col-sm-2 control-label text-right m-t-10">Sexo <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
				<select class="form-control" name="sexo" id="sexo" required>
					<option value="0">Indique sexo</option>
					<option value="Masculino">Masculino</option>
					<option value="Femenino">Femenino</option>
				</select>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="email" class="col-sm-2 control-label text-right m-t-10">Previsión <span style="color:red;">*</span></label>
	          <div class="col-sm-10">
           		<select class="form-control" name="prevision" id="prevision" required>
	                <option value="0">Indique previsión</option>
	                <?php 
		                foreach ($previsiones as $key ) { 
		            ?>
                    <option value="<?php echo $key->id?>"><?php echo $key->nombre; ?></option>
					<?php } ?>
                </select>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="region" class="col-sm-2 control-label text-right m-t-10">Región</label>
	          <div class="col-sm-10">
	            <select id="region" class="form-control" name="region" onchange="filtrarSelects(this.value,this.name,this.options[this.selectedIndex].getAttribute('id'));">
					<option value="0" style="display:block!important;" selected>Seleccione región</option>
					<?php 
						if (isset($regiones)and is_array($regiones) and count($regiones)>0) { 
							foreach ($regiones as $key) {
								echo "<option value='". $key->region_nombre."' id='".$key->region_id."'>".$key->region_nombre."</option>";
							} 
					    } 
					?>
				</select>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>
	        
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="provincia" class="col-sm-2 control-label text-right m-t-10">Provincias</label>
	          <div class="col-sm-10">
	             <select id="prov" class="form-control" name="prov" onchange="filtrarSelects(this.value,this.name,this.options[this.selectedIndex].getAttribute('id'));">
				    <option value="0" style="display:block!important;" selected>Seleccione provincia</option>
				    <?php 
					    if (isset($provincia)and is_array($provincia) and count($provincia)>0) {
							foreach ($provincia as $key) {
								echo "<option class='hidden' value='".$key->provincia_nombre."' id='".$key->provincia_id."' idRegion='".$key->region_id."'>".$key->provincia_nombre ."</option>";
							}
				    		} 
				    	?>
				  </select>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>
	    
	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="comuna" class="col-sm-2 control-label text-right m-t-10">Comuna</label>
	          <div class="col-sm-10">
	             <select id="comuna" class="form-control" name="comuna">
				    <option value="0" style="display:block!important;" selected>Seleccione comuna</option>
				    <?php 
					    if (isset($comunas)and is_array($comunas) and count($comunas)>0) {
				    			foreach ($comunas as $key) {
								echo "<option class='hidden' value='".$key->comuna_nombre."' id='".$key->comuna_id."' idProvincia='".$key->provincia_id."'>".$key->comuna_nombre."</option>";
							}
				    		}
				    	?>
				  </select>
	            <p class="help-block text-danger"></p>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-md-12">
	        <div class="form-group">
	          <label for="ciudad" class="col-sm-2 control-label text-right m-t-10">Ciudad</label>
	          <div class="col-sm-10">
	            <?php
	              $campo = array(
	                  'name'  => 'ciudad',
	                  'id'  => 'ciudad',
	                  'placeholder' => 'Indique ciudad',
	                  'class' => 'form-control',
	                  'data-validation-required-message' => 'Por favor indique su ciudad',
	                  'pattern' => '[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+'
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
            <label for="tsup" class="col-sm-2 control-label text-right m-t-10">Foto del paciente</label>
            <div class="col-sm-10">
              <?php
                $campo = array(
                    'name'  => 'tarch',
                    'id'  => 'tarch',
                    'value' => set_value('tarch'),
                    'placeholder' => 'Seleccione la foto a subir',
                    'class' => 'form-control'
                );
                
                echo form_upload($campo); 
              ?>
              
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
      </div>
                  
	    <div class="row hidden">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-xl btn-success" id="submit_add_paciente">Registrar</button>
          </div>
        </div>

        
  <?php echo form_close(); ?>		