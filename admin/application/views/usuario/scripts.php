
<script language="JavaScript" type="text/javascript">

	$(function () {
		$("#tfecha, #tfecha2, #tfdona").datetimepicker({
											
			format: 'YYYY-MM-DD'
		});
	});
				
</script>


<script language="JavaScript" type="text/javascript">
	$(function()
	{
		$('#tedo').chainSelect('#tmun','<?php echo site_url('reosc/combobox') ?>',
					{ 
						before:function (target) //before request hide the target combobox and display the loading message
						{ 
							$("#loading").css("display","block");
							$(target).css("display","none");
							
						},
						after:function (target) //after request show the target combobox and hide the loading message
						{ 
							$("#loading").css("display","none");
							$(target).css("display","block");
							
							
						}
		});
		$('#tmun').chainSelect('#tloc','<?php echo site_url('reosc/combobox') ?>',
					{ 
						before:function (target) 
						{ 
							$("#loading").css("display","block");
							$(target).css("display","none");
							
						},
						after:function (target) 
						{ 
							$("#loading").css("display","none");
							$(target).css("display","block");
							
						}
		});
					
					
	});
				
</script>



	<script language="JavaScript" type="text/javascript">
				
	// --------------------------------------------------------------- Escrituras
	// Bind click to OK button within popup
		$('#confirm-deletemodif').on('click', '.btn-ok', function(e) {

		  var $modalDiv = $(e.delegateTarget);
		  var id = $(this).data('recordId');
		 
		 

		  $modalDiv.addClass('loading');
		  $.ajax({
				url : '<?php echo base_url('reosc/escritura_mod_quitar'); ?>',
				type: 'POST',
				data: 'idf='+id+'&accion=2',
				datatype: 'TEXT',
				success: function(salida){
					window.location = salida;
				}
			});
		 
		});

		// Bind to modal opening to set necessary data properties to be used to make request
		$('#confirm-deletemodif').on('show.bs.modal', function(e) {
		  var data = $(e.relatedTarget).data();
		  $('.title', this).text(data.recordTitle);
		  $('.btn-ok', this).data('recordId', data.recordId);
		});
		
	// --------------------------------------------------------------- Representantes
	// Bind click to OK button within popup
		$('#confirm-deleterep').on('click', '.btn-ok', function(e) {

		  var $modalDiv = $(e.delegateTarget);
		  var id = $(this).data('recordId');
		 
		 

		  $modalDiv.addClass('loading');
		  $.ajax({
				url : '<?php echo base_url('reosc/rep_quitar'); ?>',
				type: 'POST',
				data: 'idf='+id+'&accion=2',
				datatype: 'TEXT',
				success: function(salida){
					window.location = salida;
				}
			});
		 
		});

		// Bind to modal opening to set necessary data properties to be used to make request
		$('#confirm-deleterep').on('show.bs.modal', function(e) {
		  var data = $(e.relatedTarget).data();
		  $('.title', this).text(data.recordTitle);
		  $('.btn-ok', this).data('recordId', data.recordId);
		});
		
		
		// --------------------------------------------------------------- Representantes
	// Bind click to OK button within popup
		$('#confirm-deleteorgano').on('click', '.btn-ok', function(e) {

		  var $modalDiv = $(e.delegateTarget);
		  var id = $(this).data('recordId');
		 
		 

		  $modalDiv.addClass('loading');
		  $.ajax({
				url : '<?php echo base_url('reosc/int_quitar'); ?>',
				type: 'POST',
				data: 'idf='+id+'&accion=2',
				datatype: 'TEXT',
				success: function(salida){
					window.location = salida;
				}
			});
		 
		});

		// Bind to modal opening to set necessary data properties to be used to make request
		$('#confirm-deleteorgano').on('show.bs.modal', function(e) {
		  var data = $(e.relatedTarget).data();
		  $('.title', this).text(data.recordTitle);
		  $('.btn-ok', this).data('recordId', data.recordId);
		});
				
			
		// --------------------------------------------------------------- Redes
	// Bind click to OK button within popup
		$('#confirm-deletered').on('click', '.btn-ok', function(e) {

		  var $modalDiv = $(e.delegateTarget);
		  var id = $(this).data('recordId');
		 
		 

		  $modalDiv.addClass('loading');
		  $.ajax({
				url : '<?php echo base_url('reosc/red_quitar'); ?>',
				type: 'POST',
				data: 'idf='+id+'&accion=2',
				datatype: 'TEXT',
				success: function(salida){
					window.location = salida;
				}
			});
		 
		});

		// Bind to modal opening to set necessary data properties to be used to make request
		$('#confirm-deletered').on('show.bs.modal', function(e) {
		  var data = $(e.relatedTarget).data();
		  $('.title', this).text(data.recordTitle);
		  $('.btn-ok', this).data('recordId', data.recordId);
		});
				
</script>