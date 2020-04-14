	var base_url = "";

	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// ACCIONES DE FECHAS Y HORARIOS DE LOS MÉDICOS
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================




	///======================================================================
	// DÍA HORARIO POR MÉDICO
	//======================================================================
	function dia_horario_medico() {
	    var medico_selected = document.getElementById('medicoSelect').value;
	    var horaEntrada = document.getElementById('horaEntrada').value;
	    var horaSalida = document.getElementById('horaSalida').value;
	    var chk_arr = document.getElementsByName('dia_semana[]');
	    var chklength = chk_arr.length;
	    var dia_laboral = '';
	    for (i = 0; i < chklength; i++) {
	        var dia_seleccionado = chk_arr[i].checked;
	        var dia_semana_medico = chk_arr[i].value;
	        if (dia_seleccionado == true) {
	            dia_laboral += dia_semana_medico + ',';
	        }
	    }
	    console.log("fuera del if");

	    if (medico_selected != 0 && horaEntrada != '' && horaSalida != '' && dia_laboral != '') {
	        console.log("ya entró");

	        $.ajax({
	            type: 'post',
	            url: base_url + '../Usuario/horarios',
	            data: {
	                id_medico: medico_selected,
	                descanzo_semana: dia_laboral,
	                hora_inicio: horaEntrada,
	                hora_fin: horaSalida
	            },
	            beforeSend: function() {

	            },
	            success: function(response) {
	                swal({
	                    title: '¡Se guardaron los días de descanso del médico!',
	                    type: 'success',
	                });

	                document.location.reload();
	            }


	        });

	    } else {
	        swal({
	            title: '¡Campos obligatorios!',
	            text: 'No puede continuar por que hacen falta algunos campos...',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }
	    console.log("hola mundo");

	}

	function horario_medico(id_medico) {

	    console.log("horario");

	    var horaEntrada = document.getElementById('horaEntrada').value;
	    var horaSalida = document.getElementById('horaSalida').value;
	    var chk_arr = document.getElementsByName('dia_semana[]');

	    var chklength = chk_arr.length;
	    var dia_laboral = '';
	    for (i = 0; i < chklength; i++) {
	        var dia_seleccionado = chk_arr[i].checked;
	        var dia_semana_medico = chk_arr[i].value;
	        if (dia_seleccionado == true) {
	            dia_laboral += dia_semana_medico + ',';
	        }
	    }

	    if (horaEntrada != '' && horaSalida != '' && dia_laboral != '') {
	        console.log("ya entró");

	        $.ajax({
	            type: 'post',
	            url: base_url + '../Usuario/horarios',
	            data: {
	                id_medico: id_medico,
	                descanzo_semana: dia_laboral,
	                hora_inicio: horaEntrada,
	                hora_fin: horaSalida
	            },
	            beforeSend: function() {

	            },
	            success: function(response) {
	                swal({
	                    title: '¡Se guardaron los días de descanso del médico!',
	                    type: 'success',
	                });


	            }
	        });
	        location.reload();
	    } else {
	        swal({
	            title: '¡Campos obligatorios!',
	            text: 'No puede continuar por que hacen falta algunos campos...',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }

	}