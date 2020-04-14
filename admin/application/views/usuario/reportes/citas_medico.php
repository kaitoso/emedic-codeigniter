	<div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Impresi&oacute;n de reportes</h4>
            </div>
            <div class="panel-body bg-silver">
                <ul class="nav nav-tabs">
	                <li class="active"><a href="#citas-dia" data-toggle="tab">Citas</a></li>
	                <!--li class=""><a href="#default-tab-2" data-toggle="tab">Default Tab 2</a></li>
	                <li class=""><a href="#default-tab-3" data-toggle="tab">Default Tab 3</a></li-->
	            </ul>
	            <div class="tab-content">
					<div class="tab-pane fade active in" id="citas-dia">
						<?php 
					        $attributes = array('class' => 'form', 'id' => 'frmAgregar', 'name' => 'frmAgregar', 'target' => '_self');
					        
					        echo form_open('Usuario/agenda/');
					        
					        
					    ?>
					    <select class="form-control" id="medicoSelect" name="docs" onchange="report_citas_medico(this.value);">
					        <option selected="true">-- Seleccione Médico --</option>
					        <?php foreach ($doctores as $key ) {
					            # code...
					            ?>
					        <option value="<?php echo $key->id ?>" label="<?php echo $key->nombre ?>"><?php echo $key->nombre ?></option>
					        <?php } ?>	        
					    </select>
					    <?php echo form_close(); ?>
					    <p>&nbsp;</p>
					    <div id="tabs_status_info_report"><div class="text-center"><strong id="disponibilidadFechasHorarios" style="color: red;">Seleccione un médico para ver su agenda</strong></div></div>
					    <div id="tabs_status_report" style="display:none">
						    <div class="row">
							    <div class="col-lg-1 col-sm-2">
								    <strong>Filtros</strong>
								    <div class="form-check">
									    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
										<label class="form-check-label" for="exampleRadios1">Hoy</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
									  <label class="form-check-label" for="exampleRadios2">Todo</label>
									</div>
							    </div>
							    <div class="col-lg-11 col-sm-10">
				                    <table id="tabla-citas-hoy" class="table table-striped table-bordered table-responsive table-sm" cellspacing="0" width="100%">
					                    <thead>
					                        <tr>
						                        <th>Paciente</th>
						                        <th>Hora agenda</th>
						                        <th>Observaciones</th>
					                            <th>RUT/Otro</th>
					                            <th>Tipo agenda</th>
					                        </tr>
					                    </thead>
										<tbody id ="reporte_citas"></tbody>
				                    </table>
							    </div>
							    <div class="col-lg-12">
								    	<a href="#" class="btn btn-success btn-sm pull-right"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
							    </div>
						    </div>
					    </div>
	                </div>
	                <div class="tab-pane fade" id="default-tab-2">
	                    <blockquote>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	                        <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
	                    </blockquote>
	                    <h4>Lorem ipsum dolor sit amet</h4>
	                    <p>
	                        Nullam ac sapien justo. Nam augue mauris, malesuada non magna sed, feugiat blandit ligula. 
	                        In tristique tincidunt purus id iaculis. Pellentesque volutpat tortor a mauris convallis, 
	                        sit amet scelerisque lectus adipiscing.
	                    </p>
	                </div>
	                <div class="tab-pane fade" id="default-tab-3">
	                    <p>
	                        <span class="fa-stack fa-4x pull-left m-r-10">
	                            <i class="fa fa-square-o fa-stack-2x"></i>
	                            <i class="fa fa-twitter fa-stack-1x"></i>
	                        </span>
	                        Praesent tincidunt nulla ut elit vestibulum viverra. Sed placerat magna eget eros accumsan elementum. 
	                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis lobortis neque. 
	                        Maecenas justo odio, bibendum fringilla quam nec, commodo rutrum quam. 
	                        Donec cursus erat in lacus congue sodales. Nunc bibendum id augue sit amet placerat. 
	                        Quisque et quam id felis tempus volutpat at at diam. Vivamus ac diam turpis.Sed at lacinia augue. 
	                        Nulla facilisi. Fusce at erat suscipit, dapibus elit quis, luctus nulla. 
	                        Quisque adipiscing dui nec orci fermentum blandit.
	                        Sed at lacinia augue. Nulla facilisi. Fusce at erat suscipit, dapibus elit quis, luctus nulla. 
	                        Quisque adipiscing dui nec orci fermentum blandit.
	                    </p>
	                </div>
	            </div>
                <!--form name="frmMec" action="imprimir.php" method="post">
	                <fieldset>
	                    <legend>Fecha</legend>
	                    <label for="mes">
	                        Mes: 
	                        <select name="mes">
	                            <option value="01">Enero</option>
	                            <option value="02">Febrero</option>
	                            <option value="03">Marzo</option>
	                            <option value="04">Abril</option>
	                            <option value="05">Mayo</option>
	                            <option value="06">Junio</option>
	                            <option value="07">Julio</option>
	                            <option value="08">Agosto</option>
	                            <option value="09">Setiembre</option>
	                            <option value="10">Octubre</option>
	                            <option value="11">Noviembre</option>
	                            <option value="12">Diciembre</option>
	                        </select>
	                    </label>
	                    <br/> 
	                    <label for="ano">Año: <input name="ano" size="4" maxlength="4" value="<?= date("Y")?>"></label> 
	                </fieldset>
	                <fieldset>
	                    <legend>Datos de Impresión</legend>
	                    <label for="serie">
	                        Serie: 
	                        <select name="serie" id="serie">
	                            <option value= 0 >Seleccione</option>
	                            
	                        </select>
	                    </label>
	                    <br/> 
	                    <label for="facini">Factura Inicial: <input name="fini" id="fini" ></label><br/> 
	                    <label for="cantidad">Cantidad: <input name="cantidad" id="cantidad" size="4"></label><br/> 
	                </fieldset>
	                <input type="submit" name="enviar"> 
	                <input type="button" name="reiniciar" id="reiniciar" value="Reinicializar Serie"> 
	            </form-->
            </div>
        </div>
	</div>


	<!--script type="text/javascript"> 
	    $(document).ready(function(){                              
	        $("#serie").change(function(){ 
	            $.post("cargaultimafac.php",{ id:$(this).val() },function(data){$("#fini").val(data);})                 
	        });                 
	    }) 
	</script--> 
	        