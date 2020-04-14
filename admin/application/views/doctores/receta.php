<?php
	include('inc/header.php');
?>


<style>
	body {
		background-color: #FFFFFF;
	}
	@media print{
		@page { margin: 0; }
		html, body {
			height:100%; 
			margin: 15px !important; 
			padding: 0 !important;
			overflow: hidden;
		}
	}
	#page-container {
		padding-top: 0;
	}
	.receta-company {
		display: inline-block;
		width: 100%;
	}
	#name_print {
		text-align: right;
	}
	.pace,
	#page-loader {
		display: none !important;
	}
</style>
<script type="text/javascript">
    function imprimir() {
        if (window.print) {
            window.print();
        } else {
            alert("La función de impresion no esta soportada por su navegador.");
        }
    }
    imprimir();
</script>

<!-- begin #content -->
<div id="content" class="m-l-0 content">
    <!-- begin receta -->
    <div class="receta">
        <!--div class="receta-company">
            <span class="pull-right hidden-print">
            		<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
            </span>
        </div-->
        <div class="row receta-header">
	        <div class="col-xs-6" id="logo_print">
	        		<img src="../images/logos/modelaser.png" class="img-responsive">
	        </div>
	        <div class="col-xs-6" id="name_print">
	            <h4 class="m-b-0 m-t-0"><?php echo htmlspecialchars($_POST["medico"]); ?></h4>
	            <h5 class="m-t-0"><?php echo htmlspecialchars($_POST["prestacion"]); ?></h5>
	            <h6 class="m-b-0 m-t-0">
		            Rut: <?php echo htmlspecialchars($_POST["rut_otro_medico"]); ?><br>
		            e-mail: <?php echo htmlspecialchars($_POST["email_medico"]); ?>
	            </h6>
	        </div>
	        <div class="col-xs-offset-2 col-xs-8 m-t-30">
		        <div class="row">
			        <div class="col-xs-8">
				        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_POST["paciente"]); ?></p>
				        <p><strong>R.U.T.:</strong> <?php echo htmlspecialchars($_POST["rut_otro_paciente"]); ?></p>
			        </div>
			        <div class="col-xs-4">
				        <p><strong>Edad:</strong> <?php echo htmlspecialchars($_POST["edad_paciente"]); ?></p>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="row receta-content">
            <div class="col-xs-12 m-t-10">
		        <p>
			        <strong>Rp:</strong><br>
			        &nbsp;<br>
			        &nbsp;<br>
			        &nbsp;<br>
			        &nbsp;
			    </p>
		        <p>
			        <strong>Pregalex 75 mg</strong><br>
			        PREGABALINA<br>
			        comprimidos<br>
			        1 comp en la noche por 5 días y luego 1 comp cada 12 horas por 1 mes<br>
			        &nbsp;
		        </p>
		        <p>
			        <strong>Valtrex 500 mg</strong><br>
			        VALACICLOVIR<br>
			        comprimidos<br>
			        2 comp cada 8 horas por 7 días<br>
			        &nbsp;
		        </p>
	        </div>
        </div>
        <div class="row receta-note">
            <div class="col-xs-12">
            	<div class="row text-center">
			        <div class="col-xs-4"><br>
				        &nbsp;<br>
				        &nbsp;<br>
				        &nbsp;<br>
				        &nbsp;
			        	<hr class="m-b-5" style="border-color:#333333!important;">
			        	<strong>Firma</strong>
			        </div>
			        <div class="col-xs-4"></div>
			        <div class="col-xs-4"><br>
				        &nbsp;<br>
				        &nbsp;<br>
				        &nbsp;
			        	<table class="table table-bordered table-responsive" id="fecha_cita">
			        		<tbody>
			        			<tr>
			        				<td>DÍA</td>
			        				<td>MES</td>
			        				<td>AÑO</td>
			        			</tr>
			        			<tr>
			        				<td><?php echo date("d"); ?></td>
			        				<td><?php echo date("m"); ?></td>
			        				<td><?php echo date("Y"); ?></td>
			        			</tr>
			        		</tbody>
			        	</table>
			        </div>
			    </div>
	        </div>
        </div>
        <div class="receta-footer text-muted"><br>
			&nbsp;<br>
            <h4 class="m-b-0 m-t-0"><strong><?php echo htmlspecialchars($_POST["nombre_clinica"]); ?></strong></h4>
            <h4 class="m-b-0 m-t-0"><strong>SERVICIOS MÉDICOS</strong></h4>
            <h5 class="m-b-0 m-t-0">RUT: <?php echo htmlspecialchars($_POST["rut_otro_clinica"]); ?></h5>
            <h6 class="m-b-0 m-t-0">
	            <?php echo htmlspecialchars($_POST["direccion_clinica"]); ?><br>
	            Tel.: <?php echo htmlspecialchars($_POST["tel_clinica"]); ?><br>
	            <?php echo htmlspecialchars($_POST["web_clinica"]); ?>
            </h6><br>
            <small>Imp. Antártida - Hugo Fuentes C. - Rut.: 4.721.334-7 - Zañartu 570 - Fono 722 231219 - Rgua.</small>
        </div>
    </div>
    <!-- end receta -->
</div>
<!-- end #content -->


<?php
    include('inc/footer.php');
?>