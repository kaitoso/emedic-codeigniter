	var base_url = "";
	
	///======================================================================
	// ALERTAS POR MEDICO
	//======================================================================
	function alertas_por_medico(id_medico) {
		$.ajax({
			url: base_url + '../Agenda/alertas_por_medico',
			data: {
	            id_medico: id_medico
	        },
	        cache: false,
	        type: 'get',
			beforeSend: function() {

			},
	        success: function(data) {
		        var alertsLi = 0;
		        document.getElementById('alertas_medico').innerHTML = data;
			    jQuery("#alertas_medico li.media.cont_not").each(function(index) {
			        alertsLi = alertsLi+1;
			    });
		        document.getElementById('cnt_alerts').innerHTML = alertsLi;
	        }
	    });
	}
	alertas_por_medico(medico_id);