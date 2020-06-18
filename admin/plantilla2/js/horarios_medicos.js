	var base_url = "";
	var D = 1;
	var L = 1;
	var M = 1;
	var I = 1;
	var J = 1;
	var V = 1;
    var S = 1;
	const max_fields_limit = 3;
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

	$(document).ready(function() {
		 //set limit for maximum input fields
		 //initialize counter for text box
		$('#agregaDom').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(D < max_fields_limit){ //check conditions
				D++; //counter increment
				$('.entradaDomingo').append('<input type="time" class="form-control" id="horaEntradaDom'+D+'"/>'); //add input field
				$('.salidaDomingo').append('<input type="time" class="form-control" id="horaSalidaDom'+D+'"/>');
			    $('#botonesDom').append('<button type="button" id="botonDom'+D+'" onclick="eliminaDom('+D+')" >Borrar</button>'); 
					console.log("prueba",D);
					
		
			}
		});  
		$('#agregaLu').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(L < max_fields_limit){ //check conditions
				L++; //counter increment
				$('.entradaLunes').append('<input type="time" class="form-control" id="horaEntradaLu'+L+'"/>'); //add input field
				$('.salidaLunes').append('<input type="time" class="form-control" id="horaSalidaLu'+L+'"/>');
			    $('#botonesLu').append('<button type="button" id="botonLu'+L+'" onclick="eliminaLu('+L+')" >Borrar</button>'); 
					console.log("prueba",L);
					
		
			}
		});  
		$('#agregaMa').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(M < max_fields_limit){ //check conditions
				M++; //counter increment
				$('.entradaMartes').append('<input type="time" class="form-control" id="horaEntradaMa'+M+'"/>'); //add input field
				$('.salidaMartes').append('<input type="time" class="form-control" id="horaSalidaMa'+M+'"/>');
			    $('#botonesMa').append('<button type="button" id="botonMa'+M+'" onclick="eliminaMa('+M+')" >Borrar</button>'); 
					console.log("prueba",M);
					
		
			}
		}); 
		$('#agregaMie').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(I< max_fields_limit){ //check conditions
				I++; //counter increment
				$('.entradaMiercoles').append('<input type="time" class="form-control" id="horaEntradaMie'+I+'"/>'); //add input field
				$('.salidaMiercoles').append('<input type="time" class="form-control" id="horaSalidaMie'+I+'"/>');
			    $('#botonesMie').append('<button type="button" id="botonMie'+I+'" onclick="eliminaMie('+I+')" >Borrar</button>'); 
					console.log("prueba",I);
					
		
			}
		}); 
		$('#agregaJue').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(J< max_fields_limit){ //check conditions
				J++; //counter increment
				$('.entradaJueves').append('<input type="time" class="form-control" id="horaEntradaJue'+J+'"/>'); //add input field
				$('.salidaJueves').append('<input type="time" class="form-control" id="horaSalidaJue'+J+'"/>');
			    $('#botonesJue').append('<button type="button" id="botonJue'+J+'" onclick="eliminaJue('+J+')" >Borrar</button>'); 
					console.log("prueba",J);
					
		
			}
		}); 
		$('#agregaVier').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(V< max_fields_limit){ //check conditions
				V++; //counter increment
				$('.entradaViernes').append('<input type="time" class="form-control" id="horaEntradaVier'+V+'"/>'); //add input field
				$('.salidaViernes').append('<input type="time" class="form-control" id="horaSalidaVier'+V+'"/>');
			    $('#botonesVier').append('<button type="button" id="botonVier'+V+'" onclick="eliminaVier('+V+')" >Borrar</button>'); 
					console.log("prueba",V);
					
		
			}
		}); 
		$('#agregaSab').click(function(e){ //click event on add more fields button having class add_more_button
			e.preventDefault();
			if(S< max_fields_limit){ //check conditions
				S++; //counter increment
				$('.entradaSabado').append('<input type="time" class="form-control" id="horaEntradaSab'+S+'"/>'); //add input field
				$('.salidaSabado').append('<input type="time" class="form-control" id="horaSalidaSab'+S+'"/>');
			    $('#botonesSab').append('<button type="button" id="botonSab'+S+'" onclick="eliminaSab('+S+')" >Borrar</button>'); 
					console.log("prueba",S);
					
		
			}
		}); 
		// $('#botonDom2').click(function(e){ 
		// 	//user click on remove text links
		// 				e.preventDefault(); 

		// 				console.log(e);
		// 				console.log("prueba");

		// 	// $('#horaEntradaDom'+x+'').remove(); x--;
		// });

		
	});
	function eliminaDom(numId){
		console.log(numId);
		$('#horaEntradaDom'+numId+'').remove();
		$('#horaSalidaDom'+numId+'').remove();
		$('#botonDom'+numId+'').remove();
		D--;
		
	}
	function eliminaLu(numId){
		console.log(numId);
		$('#horaEntradaLu'+numId+'').remove();
		$('#horaSalidaLu'+numId+'').remove();
		$('#botonLu'+numId+'').remove();
		L--;
		
	}
	function eliminaMa(numId){
		console.log(numId);
		$('#horaEntradaMa'+numId+'').remove();
		$('#horaSalidaMa'+numId+'').remove();
		$('#botonMa'+numId+'').remove();
		M--;
		
	}
	function eliminaMie(numId){
		console.log(numId);
		$('#horaEntradaMie'+numId+'').remove();
		$('#horaSalidaMie'+numId+'').remove();
		$('#botonMie'+numId+'').remove();
		I--;
		
	}
	function eliminaJue(numId){
		console.log(numId);
		$('#horaEntradaJue'+numId+'').remove();
		$('#horaSalidaJue'+numId+'').remove();
		$('#botonJue'+numId+'').remove();
		J--;
		
	}
	function eliminaVier(numId){
		console.log(numId);
		$('#horaEntradaVier'+numId+'').remove();
		$('#horaSalidaVier'+numId+'').remove();
		$('#botonVier'+numId+'').remove();
		V--;
		
	}
	function eliminaSab(numId){
		console.log(numId);
		$('#horaEntradaSab'+numId+'').remove();
		$('#horaSalidaSab'+numId+'').remove();
		$('#botonSab'+numId+'').remove();
		S--;
		
	}
	function dia_horario_medico() {

		var medico_selected = document.getElementById('medicoSelect').value;

		//horas entrada y salida Domingo
		var horaEntradaDom = document.getElementById('horaEntradaDom').value;
		var horaEntradaDom2 =(document.getElementById('horaEntradaDom2'))? document.getElementById('horaEntradaDom2').value : false;
		var horaEntradaDom3 =(document.getElementById('horaEntradaDom3'))? document.getElementById('horaEntradaDom3').value : false;  
		var horaSalidaDom = document.getElementById('horaSalidaDom').value;
		var horaSalidaDom2 =(document.getElementById('horaSalidaDom2'))? document.getElementById('horaSalidaDom2').value : false; 
		var horaSalidaDom3 = (document.getElementById('horaSalidaDom3'))? document.getElementById('horaSalidaDom3').value : false; 
		
		//horas entrada y salida Lunes
		var horaEntradaLu = document.getElementById('horaEntradaLu').value;
		var horaEntradaLu2 =(document.getElementById('horaEntradaLu2'))? document.getElementById('horaEntradaLu2').value: false;
		var horaEntradaLu3 =(document.getElementById('horaEntradaLu3'))? document.getElementById('horaEntradaLu3').value : false; 

		var horaSalidaLu =  document.getElementById('horaSalidaLu').value;
		var horaSalidaLu2 = (document.getElementById('horaSalidaLu2'))? document.getElementById('horaSalidaLu2').value: false;
		var horaSalidaLu3 = (document.getElementById('horaSalidaLu2'))? document.getElementById('horaSalidaLu3').value: false;
				//horas entrada y salida Martes

		var horaEntradaMa = document.getElementById('horaEntradaMa').value;
		var horaEntradaMa2 = (document.getElementById('horaEntradaMa2'))? document.getElementById('horaEntradaMa2').value: false;
		var horaEntradaMa3 = (document.getElementById('horaEntradaMa3'))? document.getElementById('horaEntradaMa3').value: false;
		var horaSalidaMa = document.getElementById('horaSalidaMa').value;
		var horaSalidaMa2 = (document.getElementById('horaSalidaMa2'))?  document.getElementById('horaSalidaMa2').value: false;
		var horaSalidaMa3 = (document.getElementById('horaSalidaMa3'))?  document.getElementById('horaSalidaMa3').value: false;
				//horas entrada y salida Miercoles

		var horaEntradaMie = document.getElementById('horaEntradaMie').value;
		var horaEntradaMie2 = (document.getElementById('horaEntradaMie2'))? document.getElementById('horaEntradaMie2').value: false;
		var horaEntradaMie3 = (document.getElementById('horaEntradaMie3'))? document.getElementById('horaEntradaMie3').value: false;







		var horaSalidaMie = document.getElementById('horaSalidaMie').value;
		var horaSalidaMie2 = (document.getElementById('horaSalidaMie2'))?  document.getElementById('horaSalidaMie2').value: false;
		var horaSalidaMie3 = (document.getElementById('horaSalidaMie3'))?  document.getElementById('horaSalidaMie3').value: false;

				//horas entrada y salida Jueves

		var horaEntradaJue = document.getElementById('horaEntradaJue').value;
		var horaEntradaJue2 = (document.getElementById('horaEntradaJue2'))? document.getElementById('horaEntradaJue2').value: false;
		var horaEntradaJue3 = (document.getElementById('horaEntradaJue3'))? document.getElementById('horaEntradaJue3').value: false;
		var horaSalidaJue = document.getElementById('horaSalidaJue').value;
		var horaSalidaJue2 = (document.getElementById('horaSalidaJue2'))?  document.getElementById('horaSalidaJue2').value: false;
		var horaSalidaJue3 = (document.getElementById('horaSalidaJue3'))?  document.getElementById('horaSalidaJue3').value: false;

				//horas entrada y salida viernes

		var horaEntradaVier = document.getElementById('horaEntradaVier').value;
		var horaEntradaVier2 = (document.getElementById('horaEntradaVier2'))? document.getElementById('horaEntradaVier2').value: false;
		var horaEntradaVier3 = (document.getElementById('horaEntradaVier3'))? document.getElementById('horaEntradaVier3').value: false;
		var horaSalidaVier = document.getElementById('horaSalidaVier').value;
		var horaSalidaVier2 = (document.getElementById('horaSalidaVier2'))?  document.getElementById('horaSalidaVier2').value: false;
		var horaSalidaVier3 = (document.getElementById('horaSalidaVier3'))?  document.getElementById('horaSalidaVier3').value: false;


				//horas entrada y salida sabado

		var horaEntradaSab = document.getElementById('horaEntradaSab').value;
		var horaEntradaSab2 = (document.getElementById('horaEntradaSab2'))? document.getElementById('horaEntradaSab2').value: false;
		var horaEntradaSab3 = (document.getElementById('horaEntradaSab3'))? document.getElementById('horaEntradaSab3').value: false;
		
		var horaSalidaSab = document.getElementById('horaSalidaSab').value;
		var horaSalidaSab2 = (document.getElementById('horaSalidaSab2'))?  document.getElementById('horaSalidaSab2').value: false;
		var horaSalidaSab3 = (document.getElementById('horaSalidaSab3'))?  document.getElementById('horaSalidaSab3').value: false;

		
		
	    var chk_arr = document.getElementsByName('dia_semana[]');
	    var chklength = chk_arr.length;
		var dia_laboral = '';
		var horaEntrada= { "Do":{"horaEntradaDom":"","horaEntradaDom2":"","horaEntradaDom3":"" }
		,"Lu":{"horaEntradaLu":"","horaEntradaLu2":"","horaEntradaLu3":"" }
		,"Ma":{"horaEntradaMa":"","horaEntradaMa2":"","horaEntradaMa3":"" }
		,"Mi":{"horaEntradaMie":"","horaEntradaMie2":"","horaEntradaMie3":"" }
		,"Ju":{"horaEntradaJue":"","horaEntradaJue2":"","horaEntradaJue3":"" }
		,"Vi":{"horaEntradaVier":"","horaEntradaVier2":"","horaEntradaVier3":"" }
		,"Sa":{"horaEntradaSab":"","horaEntradaSab2":"","horaEntradaSab3":"" }};
		var horaSalida = { "Do":{"horaSalidaDom":"","horaSalidaDom2":"","horaSalidaDom3":"" }
		,"Lu":{"horaSalidaLu":"","horaSalidaLu2":"","horaSalidaLu3":"" }
		,"Ma":{"horaSalidaMa":"","horaSalidaMa2":"","horaSalidaMa3":"" }
		,"Mi":{"horaSalidaMie":"","horaSalidaMie2":"","horaSalidaMie3":"" }
		,"Ju":{"horaSalidaJue":"","horaSalidaJue2":"","horaSalidaJue3":"" }
		,"Vi":{"horaSalidaVier":"","horaSalidaVier2":"","horaSalidaVier3":"" }
		,"Sa":{"horaSalidaSab":"","horaSalidaSab2":"","horaSalidaSab3":"" } };

	    for (i = 0; i < chklength; i++) {
	        var dia_seleccionado = chk_arr[i].checked;
	        var dia_semana_medico = chk_arr[i].value;
	        if (dia_seleccionado == true ) {
				dia_laboral += dia_semana_medico + ',';
				
				switch (dia_semana_medico) {
					case 'Do':
					// horaEntrada += horaEntradaDom +',';
					horaEntrada.Do.horaEntradaDom = horaEntradaDom;

					// if (horaEntradaDom2) {
						
						// horaEntrada += horaEntradaDom2 +',';
						horaEntrada.Do.horaEntradaDom2 = horaEntradaDom2;
						horaEntrada.Do.horaEntradaDom3 = horaEntradaDom3;
					// }


					// horaSalida += horaSalidaDom +',';
					horaSalida.Do.horaSalidaDom = horaSalidaDom;	
					// if (horaSalidaDom2) {
						
						// horaSalida += horaSalidaDom2 +',';	
						horaSalida.Do.horaSalidaDom2 = horaSalidaDom2;
					// }
					// if (horaSalidaDom3) {
						
						// horaSalida += horaSalidaDom2 +',';	
						horaSalida.Do.horaSalidaDom3 = horaSalidaDom3;
					// }
					//horaSalida += horaSalidaDom3+'-';
						break;
				
					case 'Lu':
					horaEntrada.Lu.horaEntradaLu =horaEntradaLu;
					horaEntrada.Lu.horaEntradaLu2 =horaEntradaLu2;
					horaEntrada.Lu.horaEntradaLu3 =horaEntradaLu3;
					horaSalida.Lu.horaSalidaLu = horaSalidaLu;	
					horaSalida.Lu.horaSalidaLu2 = horaSalidaLu2;	
					horaSalida.Lu.horaSalidaLu3 = horaSalidaLu3;	
						break;
				
					case 'Ma':
					horaEntrada.Ma.horaEntradaMa =horaEntradaMa;
					horaEntrada.Ma.horaEntradaMa2 =horaEntradaMa2;
					horaEntrada.Ma.horaEntradaMa3 =horaEntradaMa3;
					horaSalida.Ma.horaSalidaMa = horaSalidaMa;	
					horaSalida.Ma.horaSalidaMa2 = horaSalidaMa2;	
					horaSalida.Ma.horaSalidaMa3 = horaSalidaMa3;
						break;
					
					
					case 'Mi':
					horaEntrada.Mi.horaEntradaMie =horaEntradaMie;
					horaEntrada.Mi.horaEntradaMie2 =horaEntradaMie2;
					horaEntrada.Mi.horaEntradaMie3 =horaEntradaMie3;
					horaSalida.Mi.horaSalidaMie = horaSalidaMie;	
					horaSalida.Mi.horaSalidaMie2 = horaSalidaMie2;	
					horaSalida.Mi.horaSalidaMie3 = horaSalidaMie3;
					break;

					case 'Ju':
					horaEntrada.Ju.horaEntradaJue =horaEntradaJue;
					horaEntrada.Ju.horaEntradaJue2 =horaEntradaJue2;
					horaEntrada.Ju.horaEntradaJue3 =horaEntradaJue3;
					horaSalida.Ju.horaSalidaJue = horaSalidaJue;	
					horaSalida.Ju.horaSalidaJue2 = horaSalidaJue2;	
					horaSalida.Ju.horaSalidaJue3 = horaSalidaJue3;
					break;

					case 'Vi':
					horaEntrada.Vi.horaEntradaVier =horaEntradaVier;
					horaEntrada.Vi.horaEntradaVier2 =horaEntradaVier2;
					horaEntrada.Vi.horaEntradaVier3 =horaEntradaVier3;
					horaSalida.Vi.horaSalidaVier = horaSalidaVier;	
					horaSalida.Vi.horaSalidaVier2 = horaSalidaVier2;	
					horaSalida.Vi.horaSalidaVier3 = horaSalidaVier3;	
					break;
					case 'Sa':
					horaEntrada.Sa.horaEntradaSab =horaEntradaSab;
					horaEntrada.Sa.horaEntradaSab2 =horaEntradaSab2;
					horaEntrada.Sa.horaEntradaSab3 =horaEntradaSab3;
					horaSalida.Sa.horaSalidaSab = horaSalidaSab;	
					horaSalida.Sa.horaSalidaSab2 = horaSalidaSab2;	
					horaSalida.Sa.horaSalidaSab3 = horaSalidaSab3;
					break;
				}
	        }
	    }
	    console.log("fuera del if", chk_arr[1].checked);

		if (medico_selected != 0 && ( chk_arr[1].checked && horaEntradaLu != '' && horaSalidaLu != '') || (chk_arr[2].checked && horaEntradaMa != '' && horaSalidaMa != '') ||
		(chk_arr[3].checked && horaEntradaMie != '' && horaSalidaMie != '') || (chk_arr[4].checked && horaEntradaJue != '' && horaSalidaJue != '') || (chk_arr[5].checked && horaEntradaVier != '' && horaSalidaVier != '')||
		(chk_arr[6].checked && horaEntradaSab != '' && horaSalidaSab != '') || (chk_arr[0].checked && horaEntradaDom != '' && horaSalidaDom != '') && dia_laboral != '') {
	        console.log("ya entró");
			
			console.log("variable antes del parse", horaEntrada);
			
			
			horaEntrada =  JSON.stringify(horaEntrada);
			horaSalida =  JSON.stringify(horaSalida);
			console.log("variable despues del parse", horaEntrada);
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