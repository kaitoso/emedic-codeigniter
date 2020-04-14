	var base_url = "";

	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// ACCIONES DE USUARIOS PACINTES
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================
	
	
	
	
	function load_fechaNacimiento() {
		document.getElementById('tfecha').value = ano_fechaNacimiento.value+'-'+mes_fechaNacimiento.value+'-'+dia_fechaNacimiento.value;
		var tfecha = document.getElementById('tfecha').value;
		var today_date = new Date();
		var today_year = today_date.getFullYear();
		var today_month = today_date.getMonth();
		var today_day = today_date.getDate();
		if(tfecha==='0-0-0'){
			$("#dia_fechaNacimiento").val(("0" + today_day).slice(-2));
			$("#mes_fechaNacimiento").val(("0" + (today_date.getMonth() + 1)).slice(-2));
			$("#ano_fechaNacimiento").val(today_year);
		}
		function cuantosAnios(mes, dia, anio) {
			var tienes = today_year - anio;
			if (today_month < (mes - 1)) {
				tienes--;
			}
			if (((mes - 1) == today_month) && (today_day < dia)) {
				tienes--;
			}
			return tienes;
		}
	    var edad_paciente = cuantosAnios(mes_fechaNacimiento.value,dia_fechaNacimiento.value,ano_fechaNacimiento.value)+' años de edad';
	    document.getElementById('edadPaciente').innerHTML = edad_paciente;
	}
	
	///======================================================================
	// CARGA PACIENTES
	//======================================================================
	function carga_lista_pacientes() {
		$.ajax({
			type:'post',
			url: base_url+'../pacientes',
			data: {

            },
			success: function(response){
				document.getElementById('pacientes').innerHTML = response;
			}
		});
	}

	///======================================================================
	// CARGAR LISTA DE PACIENTES EN AGENDA
	//======================================================================
	/*var refreshId = setInterval(function() {
						carga_pacientes();
					}, 3000);*/
	function carga_pacientes() {
		$.ajax({
			type:'post',
			url: base_url+'../Usuario/get_pacientes',
			data: {

            },
            beforeSend: function() {
			    //$.getScript(base_url+'../plantilla2/assets/plugins/bootstrap-select/bootstrap-select.min.js');
		        //$.getScript(base_url+'../plantilla2/assets/plugins/bootstrap-select/defaults-es_CL.min.js');
		    },
			success: function(response){
				var lista_pacientes = '<option value="0" selected>-- Seleccione paciente --</option>';
		        if(response!=0) {
			        var obj = JSON.parse(response);
					for(var i = 0; i < obj.length; i++) {
						var rut_otro_str = obj[i].rut_otro.toString();
						var find = ['.','.','-'], replace = ['','',''];
						rut_otro_str = rut_otro_str.replaceArray(find, replace);
						lista_pacientes += '<option value="' + obj[i].id + '" data-tokens="' + rut_otro_str + ' - ' + obj[i].nombre + ' ' + obj[i].apellido_paterno + ' ' + obj[i].apellido_materno + '" >' + obj[i].nombre + ' ' + obj[i].apellido_paterno + ' ' + obj[i].apellido_materno + '</option>';
					}
				}
		        pacienteSelect.innerHTML = lista_pacientes;
		        id_paciente = $('[role="listbox"] .selected').attr('data-original-index');
		        $('#pacienteSelect').selectpicker({
				    liveSearch: true
				});
				$('#pacienteSelect').selectpicker('refresh');
				$('#pacienteSelect').selectpicker('val', id_paciente);
			}
		});
	}
	
	///======================================================================
	// AGREGAR PACIENTE
	//======================================================================
	function click_add() {
		document.getElementById('submit_add_paciente').click();
	}
	function paciente_formulario_agregar() {
		var modal_pacientes_name = document.getElementById('modal_pacientes_name');
		var actionAddEdit = document.getElementById('actionAddEdit');
		$.ajax({
            type: 'post',
            url: base_url + '../Usuario/agregar_pacientes',
            data: {

            },
            beforeSend: function() {
	        		$.getScript(base_url+'../plantilla2/js/jquery.validate.min.js');
	        		$.getScript(base_url+'../plantilla2/js/jquery.rut.min.js');
            },
            success: function(response) {
	            actionAddEdit.style.display = 'inline';
				actionAddEdit.setAttribute('onclick', 'click_add()');
				actionAddEdit.innerHTML = '<i class="fa fa-floppy-o" aria-hidden="true"></i> Agregar';
	            modal_pacientes_name.innerHTML = 'Agregar paciente';
	            	document.getElementById('load_action_paciente').innerHTML = response;
	            	load_fechaNacimiento();
				
				$.validator.addMethod("valueNotEquals", function(value, element, param) {
				  return this.optional(element) || value != param;
				}, 'Por favor, especifique un valor diferente (no predeterminado).');
				$('#frmAgregar').validate({
					rules: {
						sexo: { 
							valueNotEquals: '0' 
						},
						prevision: { 
							valueNotEquals: '0' 
						}
					},
			        messages: {
			            nombre: 'Debe introducir nombre(s).',
			            apellidopat: 'Debe introducir apellido paterno.',
			            apellidomat: 'Debe introducir apellido materno.',
			            rut: 'Debe llenar RUT.',
			            cel: 'Debe introducir solo números',
			            tfecha: 'Debe llenar fecha de nacimiento.',
			            sexo: {
			            	valueNotEquals: 'Debe seleccionar orientación sexual.'
			            },
			            prevision: {
			            	valueNotEquals: 'Debe seleccionar prevision.' 
			            }
			        },
			        submitHandler: function(form){
				        event.preventDefault();
				        agregar_paciente();
			        }
			    });
			    $("input#rut").rut().rut({formatOn: 'keyup', validateOn: 'keyup'}).on('rutInvalido', function(){ 
				    $('#rut-error').css('display','block');
				}).on('rutValido', function(){ 
					$('#rut-error').css('display','none');
				});
            }
        });	
	}
	
	function agregar_paciente() {
		var formData = $("#frmAgregar").serialize();
		$.ajax({
		    type: 'post',
		    url: base_url + '../Usuario/agregar_pacientes',
		    data: formData,
			success: function(response) {
				var fechaNacimiento = document.getElementById('tfecha').value;
				var dia_fechaNacimiento = document.getElementById('dia_fechaNacimiento').value;
				var mes_fechaNacimiento = document.getElementById('mes_fechaNacimiento').value;
				var ano_fechaNacimiento = document.getElementById('ano_fechaNacimiento').value;
				carga_lista_pacientes(fechaNacimiento,dia_fechaNacimiento,mes_fechaNacimiento,ano_fechaNacimiento);
				swal({
					title: '¡Agregado con éxito!',
					text: 'Los datos del paciente se registraron con éxito...',
					type: 'success',
					confirmButtonText: 'Aceptar'
				}).then((willAcept) => {
					if (willAcept.value) {
						$('#modal_pacientes').modal('hide');
					}
				});
			}
		});
	}



	///======================================================================
	// ACTUALIZAR PACIENTE
	//======================================================================
	function click_edit() {
		document.getElementById('submit_edit_paciente').click();
	}
	function paciente_formulario_editar(id_paciente,tipo) {
		var modal_pacientes_name = document.getElementById('modal_pacientes_name');
		var actionAddEdit = document.getElementById('actionAddEdit');
		
		$.ajax({
            type: 'post',
            url: base_url + '../Usuario/editar_paciente',
            data: {
                id_paciente: id_paciente
            },
            beforeSend: function() {
        		$.getScript(base_url+'../plantilla2/js/jquery.validate.min.js');
        		$.getScript(base_url+'../plantilla2/js/jquery.rut.min.js');
            },
            success: function(response) {
	            actionAddEdit.style.display = 'inline';
				actionAddEdit.setAttribute('onclick', 'click_edit()');
				actionAddEdit.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i> Editar';
	            	modal_pacientes_name.innerHTML = 'Editar paciente';
	            	document.getElementById('load_action_paciente').innerHTML = response;
	            	var fechaNacimiento = document.getElementById('tfecha').value;
	            	var sexoSelect = document.getElementById('sex_selected').value;
	            	var prevSelected = document.getElementById('prev_selected').value;
	            	var regSelected = document.getElementById('reg_selected').value;
	            	var provSelected = document.getElementById('prov_selected').value;
	            	var comSelected = document.getElementById('com_selected').value;
            	
				var indexSelected = fechaNacimiento.split('-');
				var dia_fechaNacimiento = indexSelected[2];
				var mes_fechaNacimiento = indexSelected[1];
				var ano_fechaNacimiento = indexSelected[0];
				
				$("#dia_fechaNacimiento").val(indexSelected[2]);
				$("#mes_fechaNacimiento").val(indexSelected[1]);
				$("#ano_fechaNacimiento").val(indexSelected[0]);
				$("#sexo").val(sexoSelect);
				$("#prevision").val(prevSelected);
				$("#region").val(regSelected);
				$("#prov").val(provSelected);
				$("#comuna").val(comSelected);
				var regSelected = $("#region option:selected").attr('id');
				var provSelected = $("#prov option:selected").attr('id');
				$("#prov [idregion='"+regSelected+"']").removeClass('hidden');
				$("#comuna [idprovincia='"+provSelected+"']").removeClass('hidden');
				
	
            		load_fechaNacimiento(fechaNacimiento,dia_fechaNacimiento,mes_fechaNacimiento,ano_fechaNacimiento);				
				$.validator.addMethod("valueNotEquals", function(value, element, param) {
				  return this.optional(element) || value != param;
				}, 'Por favor, especifique un valor diferente (no predeterminado).');
				$('#frmAgregar').validate({
					rules: {
						sexo: { 
							valueNotEquals: '0' 
						},
						prevision: { 
							valueNotEquals: '0' 
						}
					},
			        messages: {
			            nombre: 'Debe introducir nombre(s).',
			            apellidopat: 'Debe introducir apellido paterno.',
			            apellidomat: 'Debe introducir apellido materno.',
			            rut: 'Debe llenar RUT.',
			            cel: 'Debe introducir solo números',
			            tfecha: 'Debe llenar fecha de nacimiento.',
			            sexo: {
			            	valueNotEquals: 'Debe seleccionar orientación sexual.'
			            },
			            prevision: {
			            	valueNotEquals: 'Debe seleccionar prevision.' 
			            }
			        },
			        submitHandler: function(form){
				        event.preventDefault();
				        editar_paciente(tipo);
			        }
			    });
			    $("input#rut").rut({
					formatOn: 'keyup',
				    minimumLength: 8, // validar largo mínimo; default: 2
					validateOn: 'change' // si no se quiere validar, pasar null
				});
            }
        });
	}
	
	
	function editar_paciente(tipo) {
		var formData = $("#frmAgregar").serialize();
		$.ajax({
		    type: 'post',
		    url: base_url + '../Usuario/editar_paciente',
		    data: formData,
			success: function(response) {
				id_paciente = document.getElementById('id_paciente').value;
				if(tipo != 'Agenda'){
					carga_lista_pacientes();
				} else {
					//$('#pacienteSelect').selectpicker('destroy');
					carga_pacientes();
				}
				swal({
					title: '¡Actualizado con éxito!',
					text: 'Los datos del paciente se actualizaron con éxito...',
					type: 'success',
					confirmButtonText: 'Aceptar'
				}).then((willAcept) => {
					if (willAcept.value) {
						//campo.focus();
						//$('#pacienteSelect').selectpicker('val', id_paciente);
						//$('#pacienteSelect').selectpicker('refresh');
						$('#modal_pacientes').modal('hide');
					}
				});
			}
		});
	}

	///======================================================================
	// VISUALIZAR PACIENTE
	//======================================================================
	function ver_paciente(id_paciente) {
		var modal_pacientes_name = document.getElementById('modal_pacientes_name');
		var actionAddEdit = document.getElementById('actionAddEdit');
	
		$.ajax({
            type: 'post',
            url: base_url + '../usuario/ver_paciente',
            data: {
                id_paciente: id_paciente
            },
            beforeSend: function() {
	            
            },
            success: function(response) {
	            	actionAddEdit.style.display = 'none';
				actionAddEdit.setAttribute('onclick', '#');
				actionAddEdit.innerHTML = 'Ver';
	            modal_pacientes_name.innerHTML = 'Visualizar paciente';
	            	document.getElementById('load_action_paciente').innerHTML = response;
	            	
	            	function cuantosAnios(dia,mes,anio){
					var hoy = new Date();
					var nacido = new Date(anio,mes-1,dia);
					var tiempo = hoy-nacido;
					var unanio = 1000*60*60*24*365;
					var tienes = parseInt(tiempo/unanio);
					return tienes;
				}
            }
        });
		
	}
	
	
	
	///======================================================================
	// CAMBIO DE ESTADO DE PACIENTES
	//======================================================================
	function status_paciente(nombre_paciente,id_paciente,activo){
        var nombre_paciente = nombre_paciente;
        
        if( activo != 0 ) {
	        swal({
				  title: '¿Seguro desea desactivar el paciente?',
				  text: 'Una vez desactivado, el paciente "'+nombre_paciente+'" el médico no podrá ver su información personal.',
				  type: 'warning',
				  showCancelButton: true,
				  cancelButtonText: 'Cancelar',
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Desactivar'
			}).then((willAcept) => {
				if (willAcept.value) {
					$.ajax({
			            type: 'post',
			            url: base_url + '../Usuario/status_paciente',
			            data: {
			                activar: activo,
			                id_paciente: id_paciente
			            },
			            beforeSend: function() {
			
			            },
			            success: function(response) {
			            		carga_lista_pacientes();
			            }
			        });
				    swal({
				    	title: '¡El paciente fue desactivado con éxito!',
				    	type: 'success'
					});
				} else {
				    swal('¡Esta acción fue cancelada!');
				}
			});
        } else {
	        swal({
				  title: '¿Desea activar el paciente?',
				  html: 'Una vez activado, el paciente <strong>"'+nombre_paciente+'"</strong> el médico podrá ver su información personal.',
				  type: 'warning',
				  showCancelButton: true,
				  cancelButtonText: 'Cancelar',
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Activar'
			}).then((willAcept) => {
				if (willAcept.value) {
					$.ajax({
			            type: 'post',
			            url: base_url + '../Usuario/status_paciente',
			            data: {
			                activar: activo,
			                id_paciente: id_paciente
			            },
			            beforeSend: function() {
			
			            },
			            success: function(response) {
			            		carga_lista_pacientes();
			            }
			        });
				    swal({
				    	title: '¡El paciente fue activado con éxito!',
				    	type: 'success',
					});
				} else {
				    swal('¡Esta acción fue cancelada!');
				}
			});
        }
		
	}

	
	
	
		
	///======================================================================
	// ELIMINAR PACIENTE
	//======================================================================
	function eliminar_paciente(id_paciente,nombre_paciente) {
		var nombre_paciente = nombre_paciente;
		swal({
			  title: '¿Seguro de borrar el paciente?',
			  text: 'Una vez aceptado, el paciente "'+nombre_paciente+'" será borrado definitivamente',
			  type: 'warning',
			  showCancelButton: true,
			  cancelButtonText: 'Cancelar',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Borrar'
		}).then((willAcept) => {
			if (willAcept.value) {
				$.ajax({
		            type: 'post',
		            url: base_url + '../Usuario/eliminar_paciente',
		            data: {
		                id_paciente: id_paciente
		            },
		            beforeSend: function() {
			            
		            },
		            success: function(response) {
		            		carga_lista_pacientes();
		            }
		        });
			    swal({
			    	title: '¡El paciente fue borrado con éxito!',
			    	type: 'success',
				});
			} else {
			    swal('¡Esta acción fue cancelada!');
			}
		});
	}
	
	function filtrarSelects(optionNombre,selectNombre,selectId){
		var optionProvincia = document.getElementById('prov').options.length;
		var optionComuna = document.getElementById('comuna').options.length;
		var provinciaId,
		comunaId = 0;
		if(selectNombre=='region') {
			if(selectId != 0) {
			    for (i = 0; i < optionProvincia; i++) {
					provinciaId = document.getElementById('prov').options[i].getAttribute('idRegion');
					if( selectId == provinciaId ) {
						document.getElementById('prov').options[i].setAttribute('class', 'show');
						document.getElementById('prov').options[0].selected = true;
						document.getElementById('comuna').options[0].selected = true;
					} else {
						document.getElementById('prov').options[i].setAttribute('class', 'hidden');
					}
				}
		    }
		}
		if(selectNombre=='prov') {
			if(selectId != 0) {
			    for (i = 0; i < optionComuna; i++) {
					comunaId = document.getElementById('comuna').options[i].getAttribute('idProvincia');
					if( selectId == comunaId ) {
						document.getElementById('comuna').options[i].setAttribute('class', 'show');
						document.getElementById('comuna').options[0].selected = true;
					} else {
						document.getElementById('comuna').options[i].setAttribute('class', 'hidden');
					}
				}
		    }
		}
	}
	
	///======================================================================
	// LISTA MEDICAMENTOS
	//======================================================================
	function lista_medicamentos() {
		$.ajax({
    			url: base_url + '../Usuario/medicinas',
			data: {
	            
	        },
	        cache: false,
	        type: 'get',
			beforeSend: function() {

			},
			success: function(data) {
				document.getElementById('medicinas').innerHTML = data;
			}
		});
	}
	
	///======================================================================
	// AGREGAR MEDICAMENTOS
	//======================================================================
	function click_add_medicamento() {
		document.getElementById('submit_add_medicamento').click();
	}
	
	function medicamentos_formulario_agregar() {
		var modal_pacientes_name = document.getElementById('modal_medicamento_name');
		var actionAddEdit = document.getElementById('actionAddEditMedicamento');
		$.ajax({
            type: 'post',
            url: base_url + '../Usuario/agregar_medicamentos',
            data: {

            },
            beforeSend: function() {
	        		$.getScript(base_url+'../plantilla2/js/jquery.validate.min.js');
            },
            success: function(response) {
	            actionAddEdit.style.display = 'inline';
				actionAddEdit.setAttribute('onclick', 'click_add_medicamento()');
				actionAddEdit.innerHTML = '<i class="fa fa-floppy-o" aria-hidden="true"></i> Agregar';
	            modal_pacientes_name.innerHTML = 'Agregar medicamento';
            		document.getElementById('load_action_medicamento').innerHTML = response;
				
				$('#frmAgregarMedicamentos').validate({
			        messages: {
			            nombre_medicamento: 'Debe introducir nombre del medicamento.',
			            nombre_fisticio: 'Debe introducir nombre generico del medicamento.',
			            presentacion: 'Debe introducir la presentación del producto.',
			            concentracion: 'Debe introducir la concentración del medicamento.'
			        },
			        submitHandler: function(form){
				        event.preventDefault();
				        agregar_medicina();
			        }
			    });
            }
        });	
	}
	
	function agregar_medicina() {
		var formData = $("#frmAgregarMedicamentos").serialize();
		$.ajax({
		    type: 'post',
		    url: base_url + '../Usuario/agregar_medicamentos',
		    data: formData,
			success: function(data) {
				swal({
					title: '¡Agregado con éxito!',
					text: 'El medicamento se agregó correctamente...',
					type: 'success',
					confirmButtonText: 'Aceptar'
				}).then((willAcept) => {
					if (willAcept.value) {
						$('#modal_medicamentos').modal('hide');
						lista_medicamentos();
					}
				});
			}
		});
	}
	
	///======================================================================
	// ACTUALIZAR MEDICAMENTOS
	//======================================================================
	function click_edit_medicamento() {
		document.getElementById('submit_edit_medicamento').click();
	}
	function medicamentos_formulario_editar(id_medicamento) {
		var modal_pacientes_name = document.getElementById('modal_medicamento_name');
		var actionAddEdit = document.getElementById('actionAddEditMedicamento');
		
		$.ajax({
            type: 'post',
            url: base_url + '../Usuario/editar_medicamentos',
            data: {
                id_medicamento: id_medicamento
            },
            beforeSend: function() {
        			$.getScript(base_url+'../plantilla2/js/jquery.validate.min.js');
            },
            success: function(response) {
	            actionAddEdit.style.display = 'inline';
				actionAddEdit.setAttribute('onclick', 'click_edit_medicamento()');
				actionAddEdit.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i> Editar';
	            modal_pacientes_name.innerHTML = 'Editar medicamento';
            		document.getElementById('load_action_medicamento').innerHTML = response;
				
				$('#frmEditarMedicamentos').validate({
			        messages: {
				        codigo: 'Debe introducir código del medicamento.',
			            nombre_medicamento: 'Debe introducir nombre del medicamento.',
			            nombre_fisticio: 'Debe introducir nombre generico del medicamento.',
			            presentacion: 'Debe introducir la presentación del producto.',
			            concentracion: 'Debe introducir la concentración del medicamento.'
			        },
			        submitHandler: function(form){
				        event.preventDefault();
				        editar_medicina();
			        }
			    });
            }
        });
	}
	
	
	function editar_medicina() {
		var formData = $("#frmEditarMedicamentos").serialize();
		$('input[disabled]').each( function() {
			formData = formData + '&' + $(this).attr('name') + '=' + $(this).val();
		});
          
		$.ajax({
		    type: 'post',
		    url: base_url + '../Usuario/editar_medicamentos',
		    data: formData,
			success: function(data) {
				swal({
					title: '¡Actualizado con éxito!',
					text: 'El medicamento se actualizó con éxito...',
					type: 'success',
					confirmButtonText: 'Aceptar'
				}).then((willAcept) => {
					if (willAcept.value) {
						$('#modal_medicamentos').modal('hide');
						lista_medicamentos();
					}
				});
			}
		});
	}

	
	///======================================================================
	// ELIMINAR MEDICAMENTO
	//======================================================================
	function eliminar_medicina(id_medicamento) {
		swal({
			  title: '¿Seguro de borrar el medicamento?',
			  text: 'Una vez aceptado, el medicamento será borrado definitivamente',
			  type: 'warning',
			  showCancelButton: true,
			  cancelButtonText: 'Cancelar',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Borrar'
		}).then((willAcept) => {
			if (willAcept.value) {
				$.ajax({
		            type: 'post',
		            url: base_url + '../Usuario/eliminar_medicina',
		            data: {
		                id_medicamento: id_medicamento
		            },
		            beforeSend: function() {
			            
		            },
		            success: function(response) {
		            		lista_medicamentos();
		            }
		        });
			    swal({
			    	title: '¡El medicamento fue borrado con éxito!',
			    	type: 'success',
				});
			} else {
			    swal('¡Esta acción fue cancelada!');
			}
		});
	}