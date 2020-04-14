	var base_url = "";
	var timeAjax = 5000;
	$.getScript(base_url + '../plantilla2/js/base64.js');

	String.prototype.replaceArray = function(find, replace) {
	    var replaceString = this;
	    for (var i = 0; i < find.length; i++) {
	        replaceString = replaceString.replace(find[i], replace[i]);
	    }
	    return replaceString;
	};

	function eventFire(el, etype) {
	    if (el.fireEvent) {
	        el.fireEvent('on' + etype);
	    } else {
	        var evObj = document.createEvent('Events');
	        evObj.initEvent(etype, true, false);
	        el.dispatchEvent(evObj);
	    }
	}


	function recetaPropiedades(objeto) {
	    var resultado = "";
	    for (var i in objeto) {
	        if (objeto.hasOwnProperty(i)) {
	            resultado += objeto[i];
	        }
	    }
	    return resultado;
	}

	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// INICIALIZAR CONTENIDOS PARA EL MÉDICO VÍA AJAX
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================
	if (etiqueta_pagina === '' || etiqueta_pagina === '#') {
	    window.location.href = window.location.href + "#inicio";
	    location.reload();
	}
	if (etiqueta_pagina === 'cita') {
	    window.onload = function() {
	        select_citas_medico(medico_id);
	        document.querySelectorAll('[id="cita_"]')[1].style.display = 'block';
	        document.querySelectorAll('[id="cita_"]')[1].setAttribute('class', 'tablinks active');
	    }
	}
	$('a[href*="#cita"]').on('click', function() {
	    var loading_data_cita = '<center style="color:red;"><h5>No hay pacientes en su agenda</h5></center>';
	    var cita_consultorio = document.getElementById('cita_consultorio').innerHTML;
	    if (cita_consultorio.trim() == loading_data_cita) {
	        select_citas_medico(medico_id);
	    }
	    document.querySelectorAll('[id="cita_"]')[1].style.display = 'block';
	    document.querySelectorAll('[id="cita_"]')[1].setAttribute('class', 'tablinks active');
	});
	$('a[href*="#perfil"]').on('click', function() {
	    setTimeout(get_prestaciones_doc, 1000);
	});
	$('a[href*="#consultas_del_dia"]').on('click', function() {
	    setTimeout(citas_pendientes_hoy, 1000);
	});





	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// COMIENZAN CITAS DEL DIA
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================

	function select_citas_medico(val) {
	    consulta_medico(val);
	    citas_espera(val);
	    var refreshId = setInterval(function() {
	        citas_espera(val);
	    }, timeAjax);
	    citas_terminadas_canceladas(val);
	    var refreshId = setInterval(function() {
	        citas_terminadas_canceladas(val);
	    }, timeAjax);
	}

	function citas_pendientes_hoy(val) {
	    $.ajax({
	        url: base_url + '../Agenda/citas_pendientes_hoy',
	        data: {
	            id_medico: val
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(response) {
	            $('#tabla-citas-hoy').empty().append(response);
	        }
	    });
	}

	function consulta_medico(val) {
	    var loading_data_cita = '<center style="color:red;"><h5>No hay pacientes en su agenda</h5></center>';
	    var cita_consultorio = document.getElementById('cita_consultorio');
	    var count = $('#cita_consultorio').length;
	    var contador_consulta = document.getElementById('contador_consulta');

	    $.ajax({
	        url: base_url + '../Agenda/cita_consultorio',
	        data: {
	            id_medico: val
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            if (data.trim() == loading_data_cita) {
	                var refreshId = setInterval(function() {
	                    $.ajax({
	                        url: base_url + '../Agenda/cita_consultorio',
	                        data: {
	                            id_medico: val
	                        },
	                        cache: false,
	                        type: 'get',
	                        beforeSend: function() {

	                        },
	                        success: function(data) {
	                            if (data == loading_data_cita) {
	                                cita_consultorio.innerHTML = data;
	                                contador_consulta.innerHTML = '( 0 )';
	                            } else {
	                                cita_consultorio.innerHTML = data;
	                                contador_consulta.innerHTML = '( ' + count + ' )';
	                                clearInterval(refreshId);
	                            }
	                        }
	                    });
	                }, timeAjax);
	            } else {
	                //if(cita_consultorio!=null) {
	                cita_consultorio.innerHTML = data;
	                var id_cita = document.getElementById('cIDcita').innerHTML;
	                var cPaciente = document.getElementById('cPaciente').innerHTML;
	                var cRut = document.getElementById('cRut').innerHTML;
	                //}


	                var rec_pac_name = document.getElementById('rec_pac_name');
	                var rec_pac_rut = document.getElementById('rec_pac_rut');
	                rec_pac_name.innerHTML = cPaciente;
	                rec_pac_rut.innerHTML = cRut;
	                contador_consulta.innerHTML = '( ' + count + ' )';
	                document.getElementById('id_cita').value = id_cita;

	                archivos_adjuntos_cita(id_cita);
	                carga_recetas_cita(id_cita);
	                $('#cMedicamento').selectpicker({
	                    liveSearch: true
	                });
	                $('[aria-label="Search"]').keydown(function(e) {
	                    var Search = $(this).val();
	                    if (Search != '') {
	                        if (e.which == 13) {
	                            medicamento_nuevo(Search);
	                        }
	                    }
	                });
	            }
	        }
	    });
	}

	function citas_espera(val) {
	    var div_citas = document.getElementById('div_citas');
	    var contador_espera = document.getElementById('contador_espera');

	    $.ajax({
	        url: base_url + '../Agenda/citas_espera_hoy',
	        data: {
	            id_medico: val
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            div_citas.innerHTML = data;
	            var count = $('#div_citas tr.cn_cita').length;
	            contador_espera.innerHTML = '( ' + count + ' )';
	        }
	    });
	}

	function citas_terminadas_canceladas(val) {
	    var div_citas_terminadas = document.getElementById('div_citas_terminadas');
	    var contador_terminadas = document.getElementById('contador_terminadas');

	    $.ajax({
	        url: base_url + '../Agenda/citas_terminadas_canceladas_hoy',
	        data: {
	            id_medico: val
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            div_citas_terminadas.innerHTML = data;
	            var count = $('#div_citas_terminadas tr.cn_cita').length;
	            contador_terminadas.innerHTML = '( ' + count + ' )';
	        }
	    });
	}

	///======================================================================
	// ACTUALIZAR PACIENTE
	//======================================================================
	function click_edit() {
	    document.getElementById('submit_edit_paciente').click();
	}

	function paciente_formulario_editar(id_paciente, tipo) {
	    var modal_pacientes_name = document.getElementById('modal_pacientes_name');
	    var actionAddEdit = document.getElementById('actionAddEdit');

	    $.ajax({
	        type: 'post',
	        url: base_url + '../Usuario/editar_paciente',
	        data: {
	            id_paciente: id_paciente
	        },
	        beforeSend: function() {
	            $.getScript(base_url + '../plantilla2/js/jquery.validate.min.js');
	            $.getScript(base_url + '../plantilla2/js/jquery.rut.min.js');
	        },
	        success: function(response) {
	            actionAddEdit.style.display = 'inline';
	            actionAddEdit.setAttribute('onclick', 'click_edit()');
	            actionAddEdit.innerHTML = 'Editar';
	            modal_pacientes_name.innerHTML = 'Editar paciente';
	            document.getElementById('load_action_paciente').innerHTML = response;

	            function cuantosAnios(dia, mes, anio) {
	                var hoy = new Date();
	                var nacido = new Date(anio, mes - 1, dia);
	                var tiempo = hoy - nacido;
	                var unanio = 1000 * 60 * 60 * 24 * 365;
	                var tienes = parseInt(tiempo / unanio);
	                return tienes;
	            }
	            $(function() {
	                var date = new Date();
	                date.setDate(date.getDate());
	                $('#datepicker').datetimepicker({
	                    locale: 'es',
	                    viewMode: 'years',
	                    format: 'YYYY-MM-DD'
	                }).on('dp.change', function(e) {
	                    var year = e.date.format('YYYY');
	                    var month = e.date.format('MM');
	                    var day = e.date.format('DD');
	                    var edad_paciente = cuantosAnios(day, month, year) + ' años de edad';
	                    document.getElementById('edadPaciente').innerHTML = edad_paciente;
	                });
	            });

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
	                submitHandler: function(form) {
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
	    var id_medico = document.getElementById('id_medico').innerHTML;
	    var formData = $("#frmAgregar").serialize();
	    $.ajax({
	        type: 'post',
	        url: base_url + '../Usuario/editar_paciente',
	        data: formData,
	        success: function(response) {
	            id_paciente = document.getElementById('id_paciente').value;
	            consulta_medico(id_medico);
	            swal({
	                title: '¡Actualizado con éxito!',
	                text: 'Los datos del paciente se actualizaron con éxito...',
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
	// VISUALIZAR PACIENTE
	//======================================================================
	function ver_paciente(id_paciente) {
	    var modal_pacientes_name = document.getElementById('modal_pacientes_name');
	    var actionAddEdit = document.getElementById('actionAddEdit');

	    $.ajax({
	        type: 'post',
	        url: base_url + '../Usuario/ver_paciente',
	        data: {
	            id_paciente: id_paciente
	        },
	        beforeSend: function() {

	        },
	        success: function(response) {
	            actionAddEdit.setAttribute('onclick', 'paciente_formulario_editar(\'' + id_paciente + '\')');
	            actionAddEdit.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i> Editar';
	            modal_pacientes_name.innerHTML = 'Visualizar paciente';
	            document.getElementById('load_action_paciente').innerHTML = response;

	            function cuantosAnios(dia, mes, anio) {
	                var hoy = new Date();
	                var nacido = new Date(anio, mes - 1, dia);
	                var tiempo = hoy - nacido;
	                var unanio = 1000 * 60 * 60 * 24 * 365;
	                var tienes = parseInt(tiempo / unanio);
	                return tienes;
	            }
	        }
	    });

	}


	///======================================================================
	// HISTORIAL DE CONSULTAS
	//======================================================================
	function consultas_anteriores(id_paciente) {
	    id_paciente = Base64.encode(id_paciente);
	    var load_historial_citas_paciente = document.getElementById('load_historial_citas_paciente');
	    var load_modal_recetas = document.getElementById('load_modal_recetas');
	    var load_modal_consulta = document.getElementById('load_modal_consulta');
	    var citas_paciente = '';
	    $.ajax({
	        url: base_url + '../Usuario/get_citas_paciente',
	        data: {
	            id_paciente: id_paciente
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            //console.log(data);
	            modal_recetas = '';
	            modal_consulta = '';
	            citas_paciente = '<table class="table table-responsive table-striped table-bordered m-b-0">';
	            citas_paciente += '<tr>';
	            citas_paciente += '<th>FECHA</th>';
	            citas_paciente += '<th>HORA</th>';
	            citas_paciente += '<th>COMENTARIO</th>';
	            citas_paciente += '<th>CONSULTA</th>';
	            citas_paciente += '<th>RECETAS</th>';
	            citas_paciente += '<th>DOCUMENTOS</th>';
	            citas_paciente += '<th>TIPO</th>';
	            citas_paciente += '</tr>';
	            if (data != 'null') {
	                var obj = JSON.parse(data);
	                for (var i = 0; i < obj.length; i++) {
	                    citas_paciente += '<tr><td>' + obj[i].fecha + '</td><td>' + obj[i].hora + '</td><td>' + obj[i].comentario + '</td>';
	                    if (obj[i].consultas != false && obj[i].consultas[0] != undefined) {
	                        citas_paciente += '<td class="text-center"><a href="#consulta_' + z + i + '" data-toggle="modal" class="btn btn-primary btn-sm">Ver consulta</a></td>';
	                        modal_consulta += '<div class="modal" id="consulta_' + z + i + '" tabindex="-2">';
	                        modal_consulta += '<div class="modal-dialog">';
	                        modal_consulta += '<div class="modal-content">';
	                        modal_consulta += '<div class="modal-header">';
	                        modal_consulta += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
	                        modal_consulta += '<h5 class="modal-title">Datos de consulta</h5>';
	                        modal_consulta += '</div>';
	                        modal_consulta += '<div class="modal-body" id="cont_rec_der">';
	                        modal_consulta += '<strong>Anamnesis:</strong> ' + obj[i].consultas[0].anamnesis + '</br>';
	                        modal_consulta += '<strong>Examen físico:</strong> ' + obj[i].consultas[0].examen_fisico + '</br>';
	                        modal_consulta += '<strong>Diagnóstico:</strong> ' + obj[i].consultas[0].diagnostico + '</br>';
	                        modal_consulta += '<strong>Indicaciones:</strong> ' + obj[i].consultas[0].indicaciones + '</br>';
	                        modal_consulta += '</div>';
	                        modal_consulta += '<div class="modal-footer">';
	                        modal_consulta += '<a href="javascript:;" class="btn btn-sm btn-default close_historial_consulta" data-dismiss="modal">Cerrar</a>';
	                        modal_consulta += '</div>';
	                        modal_consulta += '</div>';
	                        modal_consulta += '</div>';
	                        modal_consulta += '</div>';

	                    } else {
	                        citas_paciente += '<td class="text-center">--</td>';
	                    }

	                    if (obj[i].recetas[0] != false && obj[i].recetas[0] != undefined) {
	                        citas_paciente += '<td class="text-center">';
	                        citas_paciente += '<div class="btn-group">';
	                        citas_paciente += '<a href="javascript:;" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Recetas <span class="caret"></span></a>';
	                        citas_paciente += '<ul class="dropdown-menu">';
	                        for (var x = 0; x < obj[i].recetas.length; x++) {
	                            var data_nom = obj[i].recetas[x].id_medicamento,
	                                data_cant = obj[i].recetas[x].cantidad,
	                                data_ind = obj[i].recetas[x].indicaciones;
	                            var arr_id = data_nom.split(' | '),
	                                arr_nom = data_nom.split(' | '),
	                                arr_cant = data_cant.split(' | '),
	                                arr_ind = data_ind.split(' | ');
	                            var z = x + 1;
	                            citas_paciente += '<li><a href="#receta_' + z + i + '" data-toggle="modal"><i class="fa fa-eye" aria-hidden="true"></i> Ver receta ' + z + '</a></li>';
	                            modal_recetas += '<div class="modal" id="receta_' + z + i + '" tabindex="-2">';
	                            modal_recetas += '<div class="modal-dialog">';
	                            modal_recetas += '<div class="modal-content">';
	                            modal_recetas += '<div class="modal-header">';
	                            modal_recetas += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
	                            modal_recetas += '<h5 class="modal-title">Receta ' + z + '</h5>';
	                            modal_recetas += '</div>';
	                            modal_recetas += '<div class="modal-body" id="cont_rec_der">';
	                            var cont_med = 0;
	                            for (var y = 0; y < arr_cant.length; y++) {
	                                var data = obj[i].recetas[0].medicamentos;
	                                if (arr_cant[y] != '') {
	                                    var med_id = arr_id[y];
	                                    modal_recetas += '<div id="receta_">';
	                                    modal_recetas += '<div class="receta_grupo">';
	                                    data.forEach(function(medicamento) {
	                                        if (med_id === medicamento.id) {
	                                            modal_recetas += '<span class="medicamentos_select_id hidden" value="' + medicamento.id + '">' + medicamento.id + '</span>';
	                                            modal_recetas += medicamento.nombre + ' / ' + medicamento.concentracion + ' ' + medicamento.presentacion + ' / ' + medicamento.nombre_fisticio + '<br>';
	                                        }
	                                    });
	                                    modal_recetas += arr_cant[y] + '<br>';
	                                    modal_recetas += arr_ind[y];
	                                    modal_recetas += '</div>';
	                                    modal_recetas += '</div>';
	                                }
	                                cont_med++;
	                            }
	                            modal_recetas += '</div>';
	                            modal_recetas += '<div class="modal-footer">';
	                            modal_recetas += '<a href="javascript:;" class="btn btn-sm btn-default close_historial_citas" data-dismiss="modal">Cerrar receta</a>';
	                            modal_recetas += '<!--a href="javascript:;" class="btn btn-sm btn-success">Imprimir receta</a-->';
	                            modal_recetas += '</div>';
	                            modal_recetas += '</div>';
	                            modal_recetas += '</div>';
	                            modal_recetas += '</div>';
	                        }
	                        citas_paciente += '</ul>';
	                        citas_paciente += '</div>';
	                        citas_paciente += '</td>';
	                    } else {
	                        citas_paciente += '<td class="text-center">--</td>';
	                    }
	                    if (obj[i].archivos != false && obj[i].archivos != undefined) {
	                        citas_paciente += '<td class="text-center">';
	                        citas_paciente += '<div class="btn-group">';
	                        citas_paciente += '<a href="javascript:;" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Documentos adjuntos <span class="caret"></span></a>';
	                        citas_paciente += '<ul class="dropdown-menu">';
	                        for (var x = 0; x < obj[i].archivos.length; x++) {
	                            citas_paciente += '<li><a href="' + base_url + '../img/documentos/' + obj[i].archivos[x].documento + '" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> ' + obj[i].archivos[x].nombre + ' - ' + obj[i].archivos[x].descripcion + '</a></li>';
	                        }
	                        citas_paciente += '</ul>';
	                        citas_paciente += '</div>';
	                        citas_paciente += '</td>';
	                    } else {
	                        citas_paciente += '<td class="text-center">--</td>';
	                    }
	                    citas_paciente += '<td>' + obj[i].tipo + '</td></tr>';
	                }
	            } else {
	                citas_paciente += '<tr><td class="text-center" colspan="7" style="color:red;">Este pacente no tiene historial médico...</td></tr>';
	            }
	            citas_paciente += '</table>';
	            load_modal_recetas.innerHTML = modal_recetas;
	            load_modal_consulta.innerHTML = modal_consulta;
	            load_historial_citas_paciente.innerHTML = citas_paciente;
	            $('[href*="receta_"]').click(function() {
	                $('#modal_historial_citas').modal('hide');
	            });
	            $('.close_historial_citas').click(function() {
	                $('#modal_historial_citas').modal('show');
	            });
	            $('[href*="consulta_"]').click(function() {
	                $('#modal_historial_citas').modal('hide');
	            });
	            $('.close_historial_consulta').click(function() {
	                $('#modal_historial_citas').modal('show');
	            });
	        }
	    });
	}


	///======================================================================
	// CAMBIO DE ESTADO DE CITAS Y CANCELAR CITAS
	//======================================================================
	///======================================================================
	// CAMBIO DE ESTADO DE CITAS Y CANCELAR CITAS
	//======================================================================
	function pasar_pendiente(id, tipo, id_medico) {
	    $.ajax({
	        type: 'post',
	        url: base_url + '../Agenda/pasar_pendiente',
	        data: {
	            id: id,
	            tipo: tipo,
	            id_medico: id_medico
	        },
	        beforeSend: function() {
	            //eventFire(document.getElementById('pendientes-tab'), 'click');
	        },
	        success: function(response) {
	            select_citas_medico(id_medico);
	        }
	    });
	}

	function pasar_espera(id, tipo, id_medico) {
	    $.ajax({
	        type: 'post',
	        url: base_url + '../Agenda/pasar_espera',
	        data: {
	            id: id,
	            tipo: tipo,
	            id_medico: id_medico
	        },
	        beforeSend: function() {
	            eventFire(document.getElementById('enEspera'), 'click');
	        },
	        success: function(response) {
	            select_citas_medico(id_medico);
	        }
	    });
	}

	function pasar_espera_examen(id, tipo, id_medico) {
	    $.ajax({
	        type: 'post',
	        url: base_url + '../Agenda/pasar_espera_examen',
	        data: {
	            id: id,
	            tipo: tipo,
	            id_medico: id_medico
	        },
	        beforeSend: function() {

	        },
	        success: function(response) {
	            select_citas_medico(id_medico);
	        }
	    });
	}

	function pasar_consulta(id, tipo, id_medico) {
	    var contador_consulta = document.getElementById('contador_consulta').innerHTML;
	    if (contador_consulta != '( 1 )') {
	        $.ajax({
	            type: 'post',
	            url: base_url + '../Agenda/pasar_consulta',
	            data: {
	                id: id,
	                tipo: tipo,
	                id_medico: id_medico
	            },
	            beforeSend: function() {
	                eventFire(document.getElementById('enConsulta'), 'click');
	            },
	            success: function(response) {
	                select_citas_medico(id_medico);
	            }
	        });
	    } else {
	        swal({
	            title: '¡Hay un paciente en consulta!',
	            text: 'Por favor espere a que el doctor termine de atender al paciente...',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }
	}


	function pasar_terminada(id_paciente, id, tipo, id_medico) {
	    var anamnesis = document.getElementById('cAnamnesis').value;
	    var examen_fisico = document.getElementById('cExamenFisico').value;
	    var diagnostico = document.getElementById('cDiagnostico').value;
	    var cIndicacionesCita = document.getElementById('cIndicacionesCita').value;

	    $.ajax({
	        type: 'post',
	        url: base_url + '../Agenda/pasar_terminada',
	        data: {
	            id: id,
	            tipo: tipo,
	            id_medico: id_medico,
	            id_paciente: id_paciente
	        },
	        beforeSend: function() {

	        },
	        success: function(response) {
	            select_citas_medico(id_medico);
	        }
	    });

	    $.ajax({
	        type: 'post',
	        url: base_url + '../Agenda/put_citas_consultas',
	        data: {
	            id_cita: id,
	            anamnesis: anamnesis,
	            examen_fisico: examen_fisico,
	            diagnostico: diagnostico,
	            indicaciones: cIndicacionesCita
	        },
	        beforeSend: function() {

	        },
	        success: function(response) {
	            select_citas_medico(id_medico);
	        }
	    });
	}


	function select_medicamentos(id_medicamento) {
	    var data = document.getElementById('cMedicamento').options[document.getElementById('cMedicamento').selectedIndex].text;
	    if (id_medicamento != 0) {
	        var data = document.getElementById('cMedicamento').options[document.getElementById('cMedicamento').selectedIndex].text;
	        var arr = data.split('/');
	        document.getElementById("cPresentacion").value = arr[1];
	        document.getElementById("cGenerico").value = arr[2];
	    } else {
	        document.getElementById("cPresentacion").value = "";
	        document.getElementById("cGenerico").value = "";
	    }
	}


	function agrega_medicamentos_receta() {
	    var cIndicaciones = document.getElementById('cIndicaciones');
	    var medicamentos_select = document.getElementById('cMedicamento').options[document.getElementById('cMedicamento').selectedIndex].text;
	    var medicamentos_select_id = document.getElementById('cMedicamento').options[document.getElementById('cMedicamento').selectedIndex].value;
	    var medicamentos_unidades = document.getElementById('cCantidad').value;
	    var nombre_medicamento = document.getElementById('nombre_medicamento').value;
	    var cConcentracion = document.getElementById('cConcentracion').value;
	    var cPresentacion = document.getElementById('cPresentacion').value;
	    var cGenerico = document.getElementById('cGenerico').value;
	    var medicamentos_indicaciones = cIndicaciones.value;
	    var medicamento_seleccionado = document.getElementById('cMedicamento').value;
	    var medicamentos_unidades_total = '';
	    if (medicamento_seleccionado != 0 || nombre_medicamento != '') {
	        if (medicamentos_indicaciones != 0) {
	            if (medicamentos_unidades == 1) {
	                medicamentos_unidades_total = 'TOTAL ' + medicamentos_unidades + ' UNIDAD';
	            } else {
	                medicamentos_unidades_total = 'TOTAL ' + medicamentos_unidades + ' UNIDADES';
	            }
	            var nodo = document.getElementById('na_medicamento');
	            if (nodo != null) {
	                if (nodo.parentNode) {
	                    nodo.parentNode.removeChild(nodo);
	                }
	            }
	            var parent_receta = document.getElementById('receta_lista');
	            var div = document.createElement('div');
	            if (nombre_medicamento != '') {
	                medicamentos_select = nombre_medicamento + ' / ' + cConcentracion + ' ' + cPresentacion + ' / ' + cGenerico;
	                nuevo_medicamento(nombre_medicamento, cPresentacion, cConcentracion, cGenerico);

	                $.ajax({
	                    type: 'post',
	                    url: base_url + '../Agenda/ultimo_medicamento',
	                    data: {},
	                    beforeSend: function() {

	                    },
	                    success: function(data) {
	                        console.log(data);
	                    }
	                });

	            }
	            div.className = 'receta_grupo';
	            div.innerHTML = '<span class="medicamentos_select_id hidden" value="' + medicamentos_select_id + '">' + medicamentos_select_id + '</span>' +
	                '<span class="medicamentos_select" value="' + medicamentos_select + '">' + medicamentos_select + '</span><br>' +
	                '<span class="medicamentos_unidades_total" value="' + medicamentos_unidades_total + '">' + medicamentos_unidades_total + '</span><br>' +
	                '<span class="medicamentos_indicaciones" value="' + medicamentos_indicaciones + '">' + medicamentos_indicaciones + '</span><br>\
											<a href="javascript:void(0)" class="pull-right" onclick="elimina_medicamento(this)"><span class="glyphicon glyphicon-trash"></span></a>';
	            parent_receta.appendChild(div);
	            cIndicaciones.value = '';
	        } else {
	            swal({
	                title: '¡Sin indicaciones!',
	                text: 'Se necesitan las indicaciones del medicamento seleccionado... De aceptar para llenar las indicaciones...',
	                type: 'warning',
	                confirmButtonText: 'Aceptar'
	            }).then((willAcept) => {
	                if (willAcept.value) {
	                    cIndicaciones.focus();
	                }
	            });
	        }
	    } else {
	        swal({
	            title: '¡Medicamento no seleccionado!',
	            text: 'Se necesita seleccionar un medicamento para crear la receta médica...',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }
	}



	function elimina_medicamento(div) {
	    document.getElementById('receta_lista').removeChild(div.parentNode);
	}

	function pasar_receta() {
	    var nuevos_medicamentos = '<p id="na_medicamento" style="color:red;text-align:center;">No se han agregado medicamentos</p>';
	    var receta_lista = document.getElementById('receta_lista');
	    var busca_receta = receta_lista.innerHTML;
	    if (busca_receta.trim() != nuevos_medicamentos) {
	        var parent = document.getElementById('cont_rec_der');
	        var divs = parent.querySelectorAll('div');
	        var cantidad = divs.length;
	        var nodo = document.getElementById('na_recetas');
	        var cIDcita = document.getElementById('cIDcita').innerHTML;
	        var medicamentos_unidades_total = document.getElementsByClassName('medicamentos_unidades_total');
	        var medicamentos_unidades_id = document.getElementsByClassName('medicamentos_select_id');
	        var medicamentos_indicaciones_cont = document.getElementsByClassName('medicamentos_indicaciones');
	        var informe_resultados = document.getElementById('cResultados').value;
	        var medicamentos_indicaciones_item = medicamentos_indicaciones_cont.length;
	        var indicaciones_receta = '',
	            medicamentos_id = '',
	            cantidad_medicamentos = '';
	        var i;
	        var last_medicamento_item = medicamentos_indicaciones_cont.length - 1;
	        for (i = 0; i < medicamentos_indicaciones_item; i++) {
	            indicaciones_receta += medicamentos_indicaciones_cont[i].getAttribute("value") + " | ";
	            medicamentos_id += medicamentos_unidades_id[i].getAttribute("value") + " | ";
	            cantidad_medicamentos += medicamentos_unidades_total[i].getAttribute("value") + " | ";
	        }
	        var cantidad_med = recetaPropiedades(cantidad_medicamentos);
	        var id_med = recetaPropiedades(medicamentos_id);
	        var indicaciones_receta = recetaPropiedades(indicaciones_receta);

	        $.ajax({
	            type: 'post',
	            url: base_url + '../Agenda/put_citas_recetas',
	            data: {
	                id_medicamento: id_med,
	                id_cita: cIDcita,
	                cantidad: cantidad_med,
	                indicaciones: indicaciones_receta,
	                resultados: informe_resultados
	            },
	            beforeSend: function() {

	            },
	            success: function(response) {
	                receta_lista.innerHTML = nuevos_medicamentos;
	            }
	        });

	        if (nodo != null) {
	            if (nodo.parentNode) {
	                nodo.parentNode.removeChild(nodo);
	            }
	        }
	        $('#receta_lista > .receta_grupo').wrapAll('<div id="receta_' + cantidad + '" value="' + cantidad + '" onclick="select_receta_print(this)"></div>');
	        $('#receta_' + cantidad).detach().appendTo(parent);
	        $('#receta_' + cantidad + ' span').removeClass('medicamentos_unidades_total');
	        $('#receta_' + cantidad + ' span').removeClass('medicamentos_indicaciones');
	    } else {
	        swal({
	            title: '¡Medicamentos no agregados!',
	            text: 'Se necesitan agregar medicamentos para poder crear una receta...',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }
	    carga_recetas_cita(cIDcita);
	}

	function carga_recetas_cita(id_cita) {
	    var parent = document.getElementById('cont_rec_der');

	    $.ajax({
	        url: base_url + '../Agenda/get_recetas_citas',
	        data: {
	            id_cita: id_cita
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            parent.innerHTML = data;
	        }
	    });
	}

	function select_receta_print(id_receta) {
	    imprimir_receta(id_receta);
	}

	function imprimir_receta(id_receta) {
	    if (id_receta != null) {
	        var ficha = document.getElementById('receta_medica');
	        var ventanaImpresion = window.open(' ', 'popUp');
	        ventanaImpresion.document.write(ficha.innerHTML);
	        ventanaImpresion.document.close();
	        ventanaImpresion.print();
	    } else {
	        swal({
	            title: '¡Receta no seleccionada!',
	            text: 'Se necesita seleccionar una receta para imprimir...',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }
	}

	function medicamento_nuevo(nombre_medicamento) {
	    var cPresentacion = document.getElementById('cPresentacion'),
	        med_presentacion = document.getElementById('med_presentacion'),
	        nombre_medicamentoX = document.getElementById('nombre_medicamento'),
	        med_medicamento = document.getElementById('med_medicamento'),
	        cGenerico = document.getElementById('cGenerico');
	    document.getElementsByClassName('bootstrap-select')[0].style.display = 'none';
	    med_medicamento.setAttribute('class', 'col-sm-3 m-b-15');
	    nombre_medicamentoX.value = nombre_medicamento, nombre_medicamentoX.style.display = 'inherit';
	    cPresentacion.disabled = false, cPresentacion.value = '', cPresentacion.setAttribute('placeholder', 'Tabletas');
	    med_presentacion.setAttribute('class', 'col-sm-3 m-b-15');
	    document.getElementById('med_concentracion').hidden = false;
	    cGenerico.disabled = false, cGenerico.value = '', cGenerico.setAttribute('placeholder', 'Tempra');
	}

	function medicamentos_existentes() {
	    var cPresentacion = document.getElementById('cPresentacion'),
	        med_presentacion = document.getElementById('med_presentacion'),
	        nombre_medicamentoX = document.getElementById('nombre_medicamento'),
	        med_medicamento = document.getElementById('med_medicamento'),
	        cGenerico = document.getElementById('cGenerico');
	    document.getElementsByClassName('bootstrap-select')[0].style.display = 'inherit';
	    med_medicamento.setAttribute('class', 'col-sm-4 m-b-15');
	    nombre_medicamentoX.value = nombre_medicamento, nombre_medicamentoX.style.display = 'none';
	    cPresentacion.disabled = true, cPresentacion.value = '', cPresentacion.setAttribute('placeholder', '== Seleccionar medicamento ==');
	    med_presentacion.setAttribute('class', 'col-sm-4 m-b-15');
	    document.getElementById('med_concentracion').hidden = true;
	    cGenerico.disabled = true, cGenerico.value = '', cGenerico.setAttribute('placeholder', '== Seleccionar medicamento ==');
	}

	function nuevo_medicamento(nombre_medicamento, cPresentacion, cConcentracion, cGenerico) {
	    $.ajax({
	        url: base_url + '../Usuario/agregar_medicamentos_medico',
	        data: {
	            nombre_medicamento: nombre_medicamento,
	            nombre_fisticio: cGenerico,
	            concentracion: cConcentracion,
	            presentacion: cPresentacion
	        },
	        type: 'post',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            swal({
	                title: '¡Medicamento nuevo!',
	                text: 'Se agregó nuevo medicamento al catálogo...',
	                type: 'success',
	                confirmButtonText: 'Aceptar'
	            });
	            medicamentos_existentes();
	        }
	    });
	}


	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// PRESTACIONES
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================
	function get_prestaciones_doc() {
	    var load_prestaciones_medicas = document.getElementById('load_prestaciones_medicas');
	    $.ajax({
	        url: base_url + '../Docs/get_prestacion_doc',
	        data: {

	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            prestaciones_medicas = '';
	            if (data != null) {
	                var obj = JSON.parse(data);
	                for (var i = 0; i < obj.length; i++) {
	                    prestaciones_medicas += '<tr><td>' + obj[i].prestacion + '</td><td>' + obj[i].costo + '</td><td class="text-center"><button  class="btn btn-success btn-sm">Activo</button></td><td class="text-center"><a title="Eliminar" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
	                }
	            } else {
	                prestaciones_medicas += '<tr><td class="text-center" colspan="4" style="color:red;">No cuenta con prestaciones asignadas...</td></tr>';
	            }
	            prestaciones_medicas += '</table>';
	            if (load_prestaciones_medicas != null) {
	                load_prestaciones_medicas.innerHTML = prestaciones_medicas;
	            }
	        }
	    });
	}
	//get_prestaciones_doc();


	function insert_prestacion() {
	    var formData = $("#add_prestacion").serialize();
	    $.ajax({
	        type: 'post',
	        url: base_url + '../Docs/insert_prestacion',
	        data: formData,
	        success: function(data) {
	            get_prestaciones_doc();
	            swal({
	                title: '¡Prestación asignada!',
	                text: 'Se agregó la prestación a sus servicios principales',
	                type: 'success',
	                confirmButtonText: 'Aceptar'
	            });
	        }
	    });
	}


	function select_prestacion() {
	    var prestacionSelect = document.getElementById('prestacionSelect');
	    var id_prestacion = prestacionSelect.options[prestacionSelect.selectedIndex].value;
	    if (id_prestacion != 0) {
	        $.ajax({
	            url: base_url + '../Docs/select_prestacion',
	            data: {
	                id_prestacion: id_prestacion
	            },
	            cache: false,
	            type: 'post',
	            beforeSend: function() {

	            },
	            success: function(data) {
	                if (data === 'ok') {
	                    $('#prestacionSelect').prop('selectedIndex', 0);
	                    get_prestaciones_doc();
	                    swal({
	                        title: '¡Prestación asignada!',
	                        text: 'Se agregó la prestación a sus servicios principales',
	                        type: 'success',
	                        confirmButtonText: 'Aceptar'
	                    });
	                } else {
	                    swal({
	                        title: '¡Error en la prestación seleccionada!',
	                        text: 'No se pudo agregar la prestación',
	                        type: 'warning',
	                        confirmButtonText: 'Aceptar'
	                    });
	                }
	            }
	        });
	    } else {
	        swal({
	            title: '¡Seleccione una prestación!',
	            text: 'Por favor seleccione una prestación para continuar',
	            type: 'warning',
	            confirmButtonText: 'Aceptar'
	        });
	    }
	}


	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// DOCUMENTOS
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================
	function subir_doc_cita() {
	    var id_cita = document.getElementById('id_cita').value;
	    var file2 = $('#tarch');
	    var archivo = file2[0].files;
	    if (archivo) {
	        var formData = new FormData(document.getElementById('frmDocumentos'));
	        formData.append('file[]', archivo);
	        console.log(formData);
	        $.ajax({
	            type: 'post',
	            url: base_url + '../Docs/documentos',
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            beforeSend: function() {
	                document.getElementById("up_file").disabled = true;
	            },
	            success: function(data) {
	                if (data === 'ok') {
	                    console.log(data);
	                    $('#modal_add_docs').modal('hide');
	                    document.getElementById("up_file").disabled = false;
	                    swal({
	                        title: '¡Se agregó el correctamente!',
	                        text: 'El documento se agregó correctamente',
	                        type: 'success',
	                        confirmButtonText: 'Aceptar'
	                    }).then((willAcept) => {
	                        if (willAcept.value) {
	                            archivos_adjuntos_cita(id_cita);
	                        }
	                    });
	                } else {
	                    swal({
	                        title: '¡Error al subir documento!',
	                        text: 'El documento no se pudo cargar correctmente',
	                        type: 'warning',
	                        confirmButtonText: 'Aceptar'
	                    });
	                }
	            }
	        });
	    }
	    return false;
	}

	function archivos_adjuntos_cita(id_cita) {
	    var div_adjuntos = document.getElementById('div_adjuntos');

	    $.ajax({
	        url: base_url + '../Docs/get_documentos',
	        data: {
	            id_cita: id_cita
	        },
	        cache: false,
	        type: 'get',
	        beforeSend: function() {

	        },
	        success: function(data) {
	            var adjuntos_cita = '';
	            if (data != 0) {
	                var obj = JSON.parse(data);
	                for (var i = 0; i < obj.length; i++) {
	                    adjuntos_cita += '<tr><td>' + obj[i].nombre + '</td><td class="text-center"><a href="' + base_url + '../img/documentos/' + obj[i].documento + '" target="_blank" title="' + obj[i].nombre + '">Ver adjunto <i class="fa fa-external-link-square" aria-hidden="true"></i></a></td><td>' + obj[i].fecha + '</td><td>' + obj[i].descripcion + '</td><td><center><a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="eliminar_documento(' + obj[i].id + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></center></td</tr>';
	                }
	            } else {
	                adjuntos_cita += '<tr><td colspan="5"><center>No hay documentos adjuntos para esta cita...</center></td></tr>'
	            }
	            div_adjuntos.innerHTML = adjuntos_cita;
	        }
	    });
	}

	function eliminar_documento(id_doc) {
	    var id_cita = document.getElementById('cIDcita').innerHTML;
	    swal({
	        title: '¡Eliminar documento!',
	        html: '¿Está seguro de eliminar el documento?',
	        type: 'warning',
	        showCancelButton: true,
	        cancelButtonText: 'Cancelar',
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Aceptar'
	    }).then((willAcept) => {
	        if (willAcept.value) {
	            $.ajax({
	                type: 'post',
	                url: base_url + '../Docs/eliminar_documento',
	                data: {
	                    id: id_doc
	                },
	                success: function(data, status) {
	                    swal({
	                        title: 'Eliminado exitosamente!',
	                        text: 'El archivo se eliminó exitosamente...',
	                        type: 'success',
	                        confirmButtonText: 'Aceptar'
	                    });
	                    archivos_adjuntos_cita(id_cita);
	                }
	            });
	            return false;
	        } else {
	            swal('¡Esta acción fue cancelada!');
	        }
	    });
	}