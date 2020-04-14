<?php
	include('inc/header.php');
	include('inc/navbar.php');
	include('inc/lateral.php');
?>
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<!-- begin #content -->
	<div id="content" class="content">
	    <!-- begin page-header -->
	    <h1 class="page-header">Agenda médica v2 <small><strong>AVISO!</strong>  Esta aplicación se encuentra en desarrollo, por lo tanto estará en constantes modificaciones.</small></h1>
	    <!-- end page-header -->
	    <!-- begin row -->
		<div class="row">
	        <!-- begin col-8 -->
			<div class="col-md-12">
	            <!-- begin panel -->
	            <div class="panel panel-inverse" data-sortable-id="index-1">
	                <div class="panel-heading">
	                    <h4 class="panel-title">M&oacute;dulo de impresi&oacute;n</h4>
	                </div>
	                <div class="panel-body bg-silver">
		                <ul class="nav nav-tabs">
			                <li class="active"><a href="#citas-dia" data-toggle="tab">Citas</a></li>
			                <li class=""><a href="#default-tab-2" data-toggle="tab">Default Tab 2</a></li>
			                <li class=""><a href="#default-tab-3" data-toggle="tab">Default Tab 3</a></li>
			            </ul>
			            <div class="tab-content">
							<div class="tab-pane fade active in" id="citas-dia">
			                    <h3 class="m-t-10"><i class="fa fa-cog"></i> Lorem ipsum dolor sit amet</h3>
			                    <p>
			                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
			                        Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
			                        est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis 
			                        dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus. 
			                        Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
			                    </p>
			                    <p class="text-right m-b-0">
			                        <a href="javascript:;" class="btn btn-primary btn-sm m-r-5">Imprimir</a>
			                        <a href="javascript:;" class="btn btn-danger btn-sm">Limpiar datos</a>
			                    </p>
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
		                <form name="frmMec" action="imprimir.php" method="post">
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
			            </form>
	                </div>
	            </div>
			</div>
		</div>
	</div>


        

        <script type="text/javascript"> 
            $(document).ready(function(){                              
                $("#serie").change(function(){ 
                    $.post("cargaultimafac.php",{ id:$(this).val() },function(data){$("#fini").val(data);})                 
                });                 
            }) 
        </script> 
	        
   
				
<?php
    include('inc/footer.php');
?>