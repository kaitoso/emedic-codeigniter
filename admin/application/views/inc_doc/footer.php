			<!-- begin theme-panel -->
	        <div class="theme-panel">
	            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
	            <div class="theme-panel-content">
	                <h5 class="m-t-0">Personalizar eMedic</h5>
	                <ul class="theme-list clearfix">
	                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
	                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
	                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
	                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
	                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
	                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
	                </ul>
	                <div class="divider"></div>
	                <div class="m-t-10">
	                    <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i><br> Restablecer<br> almacenamiento local</a>
	                </div>
	            </div>
	        </div>
	        <!-- end theme-panel -->
			
			<!-- begin scroll to top btn -->
			<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
			<!-- end scroll to top btn -->
		</div>
		<!-- end page container -->
		<!-- ================== BEGIN BASE JS ================== -->
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<!--[if lt IE 9]>
			<script src="../assets/crossbrowserjs/html5shiv.js"></script>
			<script src="../assets/crossbrowserjs/respond.min.js"></script>
			<script src="../assets/crossbrowserjs/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/jquery-hashchange/jquery.hashchange.min.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/js/moment-with-locales.js"></script>
		<script src="<?php echo base_url() ?>plantilla2/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<!-- ================== END BASE JS ================== -->
		
		<!-- ================== BEGIN PAGE LEVEL JS ================== -->
		<script src="<?php echo base_url() ?>plantilla2/assets/js/apps.js"></script>
		<!-- ================== END PAGE LEVEL JS ================== -->
		
		<script type="text/javascript">
			$(document).ready(function() {
				App.init();
			});
			
		</script>
	</body>
</html>