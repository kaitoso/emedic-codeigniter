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



		///======================================================================
		// CARGA EL DIV SELECCIONADO DE LOS TABS
		//======================================================================

		/* OBTIENE EL DATO DESDE LA URL PARA CARGAR EL CONTENIDO */
		if (document.location.hash != '') {
		    var etiqueta_pagina = document.location.hash.replace('#', '');
		    var current_button = document.getElementById(etiqueta_pagina + '_');
		    document.getElementById(etiqueta_pagina + '_').click();
		    current_button.style.display = "block";
		    obtener_hash(etiqueta_pagina);
		    //removeUrlHash();
		} else {
		    var etiqueta_pagina = document.location.hash.replace('#', '');
		    var current_button = document.getElementById(etiqueta_pagina + '_');
		    if (current_button != null) {
		        current_button.click();
		        current_button.style.display = "block";
		    }
		}

		/*function removeUrlHash() {
			hashSelected = document.location.hash.replace('#','');
			$('a[href*="'+hashSelected+'"]').attr('onclick','openAjaxInfo(event, "'+hashSelected+'")');
			$('a[href*="'+hashSelected+'"]').attr('href','#'+hashSelected);
			console.log('entra');
		}*/

		/* CARGA LOS CONTENIDOS DESDE LAS TABS */
		function openAjaxInfo(evt, contentName) {
		    // Declare all variables
		    var i, tabcontent, tablinks;

		    // Get all elements with class="tabcontent" and hide them
		    tabcontent = document.getElementsByClassName('tabcontent');
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = 'none';
		    }

		    // Get all elements with class="tablinks" and remove the class "active"
		    tablinks = document.getElementsByClassName('tablinks');
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(' active', '');
		    }

		    // Show the current tab, and add an "active" class to the button that opened the tab
		    document.getElementById(contentName).style.display = 'block';
		    evt.currentTarget.className += ' active';
		    //removeUrlHash();
		}


		/* CARGA LOS CONTENIDOS DESDE EL MENÚ LATERAL */
		function obtener_hash(etiqueta_pagina) {
		    var current_div = document.getElementById(etiqueta_pagina);
		    var current_button = document.getElementById(etiqueta_pagina + '_');
		    current_div.style.display = "block";
		    current_button.style.display = "block";



		    /* HACE UN CLICK SOBRE EL BOTON CREADO */
		    document.getElementById(etiqueta_pagina + '_').click();



		    /* CARGA CONTENIDOS DE PÁGINA SELECCIONADA */
		    $.ajax({
		        type: 'post',
		        url: base_url + '../' + etiqueta_pagina,
		        success: function(data) {
		            document.getElementById(etiqueta_pagina).innerHTML = data;
		        }
		    });

		}

		function eventFire(el, etype) {
		    if (el.fireEvent) {
		        el.fireEvent('on' + etype);
		    } else {
		        var evObj = document.createEvent('Events');
		        evObj.initEvent(etype, true, false);
		        el.dispatchEvent(evObj);
		    }
		}






		///======================================================================
		// ======================================================================
		///======================================================================
		///======================================================================
		// COMIENZA EL AGENDAR CITAS MÉDICAS
		///======================================================================
		///======================================================================
		// ======================================================================
		///======================================================================

		///======================================================================
		// SELECCIONAR MEDICO
		//======================================================================
		function select_medico(id_medico, fecha) {
		    var prestacionSelect = document.getElementById('prestacionSelect');
		    var tableHorarios = document.getElementById('table-horarios');
		    var disponibilidadFechasHorarios = document.getElementById('disponibilidadFechasHorarios');
		    var td_fecha_titulo = document.getElementById('td_fecha_titulo');
		    var pacienteDIV = document.getElementById('pacienteDIV');
		    var pacienteSelect = document.getElementById('pacienteSelect');
		    var opc_pacientes = document.getElementById('opc_pacientes');
		    var div_horarios = document.getElementById('div_horarios');
		    var script_calendario = document.getElementById('script_calendario');
		    var currentDiv = document.getElementById('calendar-horas');
		    var texto_fecha_hora_disp = document.getElementById('texto_fecha_hora_disp');
		    var id_medico = Base64.encode(document.getElementById('medicoSelect').value);
		    var newDiv = document.createElement("div");
		    newDiv.setAttribute('id', 'calendarioDia');
		    //newDiv.setAttribute('data-date-end-date', '0d');
		    var d = new Date();
		    var fechaSeleccionada = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());

		    $.fn.datepicker.dates['es'] = {
		        days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		        daysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
		        daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		        today: 'Today',
		        clear: 'Clear',
		        format: 'dd/mm/yyyy',
		        titleFormat: 'MM yyyy'
		    };
		    $('[data-toggle="alertas"]').popover();
		    if (currentDiv.innerHTML != '') {
		        currentDiv.removeChild(currentDiv.childNodes[0]);
		        currentDiv.appendChild(newDiv);
		    } else {
		        currentDiv.appendChild(newDiv);
		    }
		    if (id_medico != 0) {
		        /* Carga todas las prestaciones del medico */
		        $.ajax({
		            type: 'post',
		            url: base_url + 'prestaciones_medico',
		            data: {
		                id_medico: id_medico
		            },
		            beforeSend: function() {
		                tableHorarios.style.display = 'none';
		                disponibilidadFechasHorarios.style.display = 'block';
		            },
		            success: function(response) {
		                if (fechaSeleccionada = true) {
		                    disponibilidadFechasHorarios.innerHTML = 'Seleccione la fecha en que desea agendar la cita.';
		                    td_fecha_titulo.innerHTML = '------Días disponibles------';
		                } else {
		                    disponibilidadFechasHorarios.innerHTML = 'Seleccione un médico para ver disponibilidad de horario.';
		                    td_fecha_titulo.innerHTML = 'Seleccione un médico para ver sus días laborales';
		                }
		                prestacionSelect.style.display = 'block';
		                daySelect = document.getElementById('prestacionSelect');
		                daySelect.innerHTML = response;
		                prestacionSelect.style.display = 'block';
		                pacienteDIV.style.display = 'block';
		                opc_pacientes.style.display = 'none';
		            }
		        });

		        /* Carga las fechas laborales y no laborales del medico en el calendario */
		        $.ajax({
		            type: 'post',
		            url: base_url + 'dias_laborales_medico',
		            data: {
		                id_medico: id_medico,
		                fecha: fechaSeleccionada
		            },
		            beforeSend: function() {
		                div_horarios.innerHTML = '';
		            },
		            success: function(response) {
		                script_calendario.innerHTML = '';
		                var script = document.createElement('script');
		                script.type = 'text/javascript';
		                script.text = response;
		                script_calendario.appendChild(script);
		            }
		        });
		        /* Carga los horarios disponibles y descansos del medico para agendar pacientes en la tabla */
		        select_dia_horario(id_medico, fechaSeleccionada);
		        carga_sobrecupo_medico(id_medico, fechaSeleccionada);
		        var refreshId = setInterval(function() {
		            fechaSeleccionada = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());
		            select_dia_horario(id_medico, fechaSeleccionada);
		        }, 3000);
		    } else {
		        div_horarios.innerHTML = '';
		        tableHorarios.style.display = 'none';
		        texto_fecha_hora_disp.style.display = 'none';
		        disponibilidadFechasHorarios.style.display = 'block';
		        disponibilidadFechasHorarios.innerHTML = 'Seleccione un médico para ver disponibilidad de horario.';
		        td_fecha_titulo.innerHTML = 'Seleccione un médico para ver sus días laborales';
		    }
		}






		///======================================================================
		// ALERTAS POR PACIENTE
		//======================================================================
		function alertas_por_paciente(id_paciente) {
		    if (id_paciente == undefined)  {
		        id_paciente = $('[role="listbox"] .selected').attr('data-original-index');
		    }
		    var alertas_paciente = document.getElementById('alertas_paciente');
		    var cuadro_alertas = document.getElementById('cuadro-alertas');
		    var opc_pacientes = document.getElementById('opc_pacientes');
		    var link_editar_paciente = document.getElementById('link_editar_paciente');

		    $.ajax({
		        type: 'post',
		        url: base_url + 'alertas_por_paciente',
		        data: {
		            id_paciente: id_paciente
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {
		            var data = response.split('|');
		            if (data[0] == 0) {
		                alertas_paciente.innerHTML = 'Paciente sin alertas';
		                alertas_paciente.setAttribute('data-content', 'Paciente sin alertas');
		                alertas_paciente.style.display = 'none';
		                cuadro_alertas.setAttribute('class', 'alert alert-success m-t-15 m-b-0');
		                cuadro_alertas.style.display = 'none';
		            } else {
		                alertas_paciente.innerHTML = 'Este paciente tiene ' + data[0] + ' alertas';
		                alertas_paciente.setAttribute('data-content', data[1]);
		                alertas_paciente.style.display = 'block';
		                cuadro_alertas.setAttribute('class', 'alert alert-danger m-t-15 m-b-0');
		                cuadro_alertas.style.display = 'block';
		            }
		            opc_pacientes.style.display = 'block';
		            link_editar_paciente.setAttribute('onclick', "paciente_formulario_editar(" + id_paciente + ",'Agenda')");
		        }
		    });
		}



		///======================================================================
		// SELECCIONAR PACIENTE
		//======================================================================
		function select_paciente(id_paciente) {
		    var rut_paciente = document.getElementById('rut_paciente');
		    var link_sobrecupo = document.getElementById('link_sobrecupo');
		    var agendar_cita_hora = document.getElementsByClassName('agendar_cita_hora');
		    var email_ = document.getElementById('email_');
		    var nombre_paciente = document.getElementById('pacienteSelect');
		    var pacienteSelect = $('[role="listbox"] .selected').attr('data-original-index');

		    alertas_por_paciente(id_paciente);


		    $.ajax({
		        type: 'post',
		        url: base_url + 'llenar_datos_paciente',
		        data: {
		            id_paciente: id_paciente
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {
		            if (pacienteSelect != 0) {
		                var datosPaciente = response.split(',');
		                rut_paciente.innerHTML = '<b>RUT: </b><span style="color:red;">' + datosPaciente[0] + '</span>';
		                rut_paciente.style.display = 'inherit';
		                link_sobrecupo.style.display = 'inherit';
		                link_editar_paciente.style.display = 'inherit';
		                opc_pacientes.style.display = 'inherit';
		                email_.value = datosPaciente[1];
		            } else {
		                rut_paciente.innerHTML = '';
		                rut_paciente.style.display = 'none';
		                link_sobrecupo.style.display = 'none';
		                link_editar_paciente.style.display = 'none';
		                opc_pacientes.style.display = 'none';
		            }
		        }
		    });

		    $.ajax({
		        type: 'post',
		        url: base_url + 'get_citasPacientes',
		        data: {
		            id_paciente: id_paciente
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {
		            var agendar_cita = agendar_cita_hora;
		            if (response != 0) {
		                var citas_paciente = '';
		                var obj = JSON.parse(response);
		                for (var i = 0; i < obj.length; i++) {
		                    citas_paciente += '<tr><td>' + obj[i].fecha + '</td><td>' + obj[i].hora + '</td><td>' + obj[i].medico + '</td></tr>';
		                }
		                for (var i = 0; i < agendar_cita.length; i++) {
		                    agendar_cita[i].style.display = 'none'
		                }
		                swal({
		                    title: '¡Paciente con citas pendientes!',
		                    html: 'El paciente <strong>"' + nombre_paciente.options[nombre_paciente.selectedIndex].text + '"</strong> tiene las siguientes citas registradas:<br><table class="table table-responsive table-striped m-t-15" style="text-align:left!important;"><thead><tr><th>Fecha</th><th>Hora</th><th>M&eacute;dico</th></tr></thead></tbody>' + citas_paciente + '</tbody></table>',
		                    type: 'warning',
		                    showCancelButton: true,
		                    cancelButtonText: 'Cancelar',
		                    confirmButtonColor: '#3085d6',
		                    cancelButtonColor: '#d33',
		                    confirmButtonText: 'Agendar'
		                }).then((willAcept) => {
		                    if (willAcept.value) {
		                        link_sobrecupo.style.display = 'inherit';
		                        for (var i = 0; i < agendar_cita.length; i++) {
		                            agendar_cita[i].style.display = 'inherit'
		                        }
		                    } else {
		                        swal('¡Esta acción fue cancelada!');
		                        link_sobrecupo.style.display = 'none';
		                    }
		                });
		            } else {
		                for (var i = 0; i < agendar_cita.length; i++) {
		                    agendar_cita[i].style.display = 'inherit'
		                }
		            }
		        }
		    });
		}


		///======================================================================
		// SELECCIONAR HORARIOS
		//======================================================================
		function select_dia_horario(id_medico, fechaSeleccionada) {
		    var tableHorarios = document.getElementById('table-horarios');
		    var disponibilidadFechasHorarios = document.getElementById('disponibilidadFechasHorarios');
		    var agendar_cita_hora = document.getElementsByClassName('agendar_cita_hora');
		    var td_fecha_titulo = document.getElementById('td_fecha_titulo');
		    var div_horarios = document.getElementById('div_horarios');
		    var hora_sobrecupo_lista = document.getElementById('hora_sobrecupo_lista');
		    var texto_fecha_hora_disp = document.getElementById('texto_fecha_hora_disp');
		    var fecha_seleccionada = $('#calendarioDia').datepicker('getDate');
		    var agendar_cita_hora = document.getElementsByClassName('agendar_cita_hora');
		    var cont_calendar = document.getElementById('cont_calendar');
		    var tipo_agendado = { 0: Base64.encode('normal'), 1: Base64.encode('sobrecupo') };
		    if (!isNaN(id_medico)) {
		        var medicoSeleccionado = Base64.encode(id_medico.toString());
		    } else {
		        var medicoSeleccionado = id_medico;
		    }
		    if (fecha_seleccionada != null) {
		        var d = new Date(fecha_seleccionada);
		        var fechaSeleccionada = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());
		    }

		    /* Carga los horarios disponibles y descansos del medico para agendar pacientes en la tabla */
		    $.ajax({
		        type: 'post',
		        url: base_url + '../Usuario/get_citas_medico',
		        async: false,
		        data: {
		            id_medico: medicoSeleccionado,
		            fecha: fechaSeleccionada
		        },
		        beforeSend: function() {
		            td_fecha_titulo.style.display = 'block';
		        },
		        success: function(response) {
		            carga_pacientes();

		            var horarios_dia = '';
		            var hora_inicio_str = 0,
		                hora_fin_str = 0;
		            var rango_minutos = 15;
		            if (response != 0) {
		                var obj = JSON.parse(response);
		                var hora_cita = 0;
		                hora_inicio_str = obj[0].horarios.hora_inicio.split(':');
		                hora_fin_str = obj[0].horarios.hora_fin.split(':');
		                var hora_agendada = '',
		                    comentario_cita = '',
		                    tipo_cita = '',
		                    id_paciente = '',
		                    id_cita = '',
		                    separador = '|';
		                var fecha_hoy = moment().format('DD-MM-YYYY');
		                var hora_actual = moment().format('HH:mm');
		                if (obj[0].citas !== null) {
		                    for (i = 0; i < obj[0].citas.length; i++) {
		                        hora_agendada += obj[0].citas[i].hora + '|';
		                        arregloHoras = hora_agendada.split(separador, i + 1);
		                        id_paciente += obj[0].citas[i].id_paciente + '|';
		                        arregloIdPaciente = id_paciente.split(separador, i + 1);
		                        id_cita += obj[0].citas[i].id + '|';
		                        arregloIdCita = id_cita.split(separador, i + 1);
		                        tipo_cita += obj[0].citas[i].tipo + '|';
		                        arregloTipoCita = tipo_cita.split(separador, i + 1);
		                        comentario_cita += obj[0].citas[i].comentario + '|';
		                        arregloComentarios = comentario_cita.split(separador, i + 1);
		                    }
		                } else  {
		                    arregloHoras = 'HH:MM';
		                }

		                for (var h = hora_inicio_str[0]; h <= hora_fin_str[0]; h++) {
		                    for (var m = parseInt(hora_inicio_str[1]); m <= 45; m += rango_minutos) {
		                        if (h <= 9) {
		                            if (m <= 9) {
		                                hora_cita = '0' + parseInt(h) + ':0' + parseInt(m);
		                            } else  {
		                                hora_cita = '0' + parseInt(h) + ':' + parseInt(m);
		                            }
		                        } else  {
		                            if (m <= 9) {
		                                hora_cita = parseInt(h) + ':0' + parseInt(m);
		                            } else  {
		                                hora_cita = parseInt(h) + ':' + parseInt(m);
		                            }
		                        }
		                        for (i = 0; i < arregloHoras.length; i++) {
		                            if (hora_cita === arregloHoras[i] && arregloTipoCita[i] === 'normal') {
		                                horarios_dia += '<tr';
		                                if (fecha_hoy === Base64.decode(fechaSeleccionada) && hora_cita <= hora_actual) {
		                                    horarios_dia += ' class="hidden"';
		                                }
		                                horarios_dia += '>';
		                                horarios_dia += '<td>' + arregloHoras[i] + '</td>';
		                                horarios_dia += '<td class="text-center"><span class="badge badge-danger">Reservada</span></td>';
		                                horarios_dia += '<td>' + arregloComentarios[i] + '</td>';
		                                horarios_dia += '<td class="text-center"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalCancelar" onclick="abre_modal_cancela(' + arregloIdPaciente[i] + ',' + arregloIdCita[i] + ',\'' + arregloHoras[i] + '\',0);">Cancelar</button></td>';
		                                horarios_dia += '<tr>';
		                            }
		                        }
		                        for (i = 0; i < arregloHoras.length; i++) {
		                            if (hora_cita !== arregloHoras[i]) {
		                                horarios_dia += '<tr';
		                                for (i = 0; i < arregloHoras.length; i++) {
		                                    if (hora_cita === arregloHoras[i] && arregloTipoCita[i] === 'normal') {
		                                        horarios_dia += ' class="hidden"';
		                                    }
		                                }
		                                for (i = 0; i < arregloHoras.length; i++) {
		                                    if (fecha_hoy === Base64.decode(fechaSeleccionada) && hora_cita <= hora_actual) {
		                                        horarios_dia += ' class="hidden"';
		                                    }
		                                }
		                                horarios_dia += '>';
		                                horarios_dia += '<td>' + hora_cita + '</td>';
		                                horarios_dia += '<td class="text-center"><span class="badge badge-success">Disponible</span></td>';
		                                horarios_dia += '<td></td>';
		                                horarios_dia += '<td class="text-center"><button type="button" class="btn btn-default btn-sm agendar_cita_hora" id="agendar_cita_hora" data-toggle="modal" data-target="#modal_agendar_cita" onclick="abre_modal_agendar(\'' + hora_cita + '\',\'' + fechaSeleccionada + '\')">Agendar</button></td>';
		                                horarios_dia += '</tr>';
		                                break;
		                            }
		                        }
		                        for (i = 0; i < arregloHoras.length; i++) {
		                            if (hora_cita === arregloHoras[i] && arregloTipoCita[i] === 'sobrecupo') {
		                                horarios_dia += '<tr';
		                                if (fecha_hoy === Base64.decode(fechaSeleccionada) && hora_cita <= hora_actual) {
		                                    horarios_dia += ' class="hidden"';
		                                }
		                                horarios_dia += '>';
		                                horarios_dia += '<td>' + arregloHoras[i] + '</td>';
		                                horarios_dia += '<td class="text-center"><span class="badge badge-warning cita_sobrecupo">Sobrecupo <i class="fa fa-check-circle" aria-hidden="true"></i></span></td>';
		                                horarios_dia += '<td>' + arregloComentarios[i] + '</td>';
		                                horarios_dia += '<td class="text-center"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalCancelar" onclick="abre_modal_cancela(' + arregloIdPaciente[i] + ',' + arregloIdCita[i] + ',\'' + arregloHoras[i] + '\',0);">Cancelar</button></td>';
		                                horarios_dia += '<tr>';
		                            }
		                        }
		                    }
		                }
		            }
		            div_horarios.innerHTML = horarios_dia;
		            texto_fecha_hora_disp.innerHTML = 'para el día ' + Base64.decode(fechaSeleccionada);
		            //scrollTo(cont_calendar, 0, 100);

		            if (fechaSeleccionada = true) {
		                disponibilidadFechasHorarios.style.display = 'none';
		                tableHorarios.style.display = 'table';
		            } else {
		                disponibilidadFechasHorarios.style.display = 'block';
		                tableHorarios.style.display = 'none';
		            }
		            if (div_horarios.innerHTML != '' && fecha_seleccionada == null) {
		                var dia_descanso = document.getElementsByClassName('disabled today')[0];
		                if (dia_descanso) {
		                    disponibilidadFechasHorarios.style.display = 'block';
		                    disponibilidadFechasHorarios.innerHTML = 'El médico descansa hoy, seleccione otra fecha o de lo contrario seleccione otro médico.';
		                    tableHorarios.style.display = 'none';
		                    div_horarios.innerHTML = '';
		                }
		            }
		            if (id_paciente === '' || id_paciente === undefined)  {
		                id_paciente = $('[role="listbox"] .selected').attr('data-original-index');
		            }
		            if (id_paciente === '0' || id_paciente === undefined) {
		                var agendar_cita = agendar_cita_hora;
		                for (var i = 0; i < agendar_cita.length; i++) {
		                    agendar_cita[i].style.display = 'none';
		                }
		            } else {
		                var agendar_cita = agendar_cita_hora;
		                for (var i = 0; i < agendar_cita.length; i++) {
		                    agendar_cita[i].style.display = 'inherit';
		                }
		            }
		        }
		    });




		}

		function carga_sobrecupo_medico(id_medico, fechaSeleccionada) {
		    var fecha_seleccionada = $('#calendarioDia').datepicker('getDate');
		    if (!isNaN(id_medico)) {
		        var medicoSeleccionado = Base64.encode(id_medico.toString());
		    } else {
		        var medicoSeleccionado = id_medico;
		    }
		    if (fecha_seleccionada != null) {
		        var d = new Date(fecha_seleccionada);
		        var fechaSeleccionada = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());
		    }

		    /* Carga todos los horarios en los que se puede agendar sobrecupo */
		    $.ajax({
		        type: 'post',
		        url: base_url + 'carga_horario_sobrecupo_por_medico',
		        data: {
		            id_medico: medicoSeleccionado,
		            fecha: fechaSeleccionada
		        },
		        beforeSend: function() {},
		        success: function(response) {
		            hora_sobrecupo_lista.innerHTML = response;

		        }
		    });
		}


		function editar_usuario(id_paciente) {
		    $.ajax({
		        type: 'post',
		        url: base_url + 'actualiza_paciente',
		        data: $('#edita_usr').serialize(),
		        beforeSend: function() {},
		        success: function(response) {


		        }
		    });
		}



		///======================================================================
		// AGENDAR CITAS
		//======================================================================
		function agendar_cita(hora, fecha) {
		    var email_ = document.getElementById('email_');
		    var chk_mail = document.getElementById('checkMail');
		    var pacienteSelect = $('#rut_paciente span').text();
		    if (pacienteSelect != 0) {
		        if (chk_mail.value != 0) {
		            if (email_.value != '') {
		                sendMail(email_.value, hora, fecha);
		            } else {
		                swal({
		                    title: '¡Sin correo electrónico!',
		                    text: 'Favor de ingresar correo del paciente...',
		                    type: 'warning',
		                    confirmButtonText: 'Aceptar'
		                }).then((willAcept) => {
		                    if (willAcept.value) {
		                        email_.focus();
		                    }
		                });
		            }
		        } else {
		            agendar_cita_confirma(hora, fecha);
		            $('#modal_agendar_cita').modal('hide');
		            swal({
		                title: '¡Agendado exitosamente!',
		                text: 'La cita médica se realizó con éxito...',
		                type: 'success',
		                confirmButtonText: 'Aceptar'
		            });
		        }
		    } else {
		        swal({
		            title: '¡Sin selección de paciente!',
		            text: 'Selecciona un paciente para continuar...',
		            type: 'warning',
		            confirmButtonText: 'Aceptar'
		        });
		    }
		}

		function agendar_cita_confirma(hora, fecha) {
		    var tableHorarios = document.getElementById('table-horarios');
		    var id_medico = document.getElementById('medicoSelect').value;
		    var pacienteSelect = $('#rut_paciente span').text();
		    var id_prestacion = document.getElementById('prestacionSelect').value;
		    var comentario = document.getElementById('comentario').value;
		    $.ajax({
		        type: 'post',
		        url: base_url + 'guardar_cita',
		        data: {
		            id_medico: id_medico,
		            rut_paciente: pacienteSelect,
		            fecha: fecha,
		            comentario: comentario,
		            hora: hora,
		            id_prestacion: id_prestacion
		        },
		        beforeSend: function() {
		            tableHorarios.style.display = "table";
		        },
		        success: function(response) {
		            select_dia_horario(id_medico, fecha);
		        }
		    });
		}


		///======================================================================
		// AGENDAR SOBRECUPOS
		//======================================================================
		function agendar_sobrecupo() {
		    var id_medico = document.getElementById('medicoSelect').value;
		    var rut_paciente = $('#rut_paciente span').text();
		    var comentario = document.getElementById('comentario_sobrecupo').value;
		    var d = new Date();
		    var fechaSeleccionada = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());
		    var fecha_seleccionada = $('#calendarioDia').datepicker('getDate');
		    if (fecha_seleccionada != null) {
		        var d = new Date(fecha_seleccionada);
		        var fechaSeleccionada = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());
		    }
		    var hora = document.getElementById('hora_sobrecupo_lista').value;
		    var id_prestacion = document.getElementById('prestacionSelect').value;

		    $.ajax({
		        type: 'post',
		        url: base_url + 'guarda_sobrecupo',
		        data: {
		            id_medico: id_medico,
		            rut_paciente: rut_paciente,
		            fecha: fechaSeleccionada,
		            comentario: comentario,
		            hora: hora,
		            id_prestacion: id_prestacion
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {
		            select_dia_horario(id_medico, fechaSeleccionada);
		        }
		    });
		}







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
		    //-------------------------------------llenar cpendientes
		    document.getElementById('tabs_status_info').style.display = 'none';
		    document.getElementById('tabs_status').style.display = 'block';

		    pendientes_medico(val);
		    var refreshId = setInterval(function() {
		        pendientes_medico(val);
		    }, timeAjax);

		    espera_medico(val);
		    var refreshId = setInterval(function() {
		        espera_medico(val);
		    }, 10000);

		    consulta_medico(val);
		    var refreshId = setInterval(function() {
		        consulta_medico(val);
		    }, 20000);

		    citas_terminadas_canceladas(val);
		    var refreshId = setInterval(function() {
		        citas_terminadas_canceladas(val);
		    }, 30000);

		}

		function report_citas_medico(val) {
		    //-------------------------------------llenar cpendientes
		    document.getElementById('tabs_status_info_report').style.display = 'none';
		    document.getElementById('tabs_status_report').style.display = 'block';

		    lista_citas_medico(val);
		    /*var refreshId = setInterval(function() {
		    	lista_citas_medico(val);
			}, timeAjax);     */
		}

		function lista_citas_medico(val) {
		    $.ajax({
		        url: base_url + 'lista_citas_medico',
		        data: {
		            id_medico: val,
		            //fecha: date('d-m-Y')
		        },
		        cache: false,
		        type: 'get',
		        beforeSend: function() {

		        },
		        success: function(response) {
		            $('#reporte_citas').empty().append(response);
		        }
		    });
		}

		function pendientes_medico(val) {
		    var contador_pendientes = document.getElementById('contador_pendientes');
		    $.ajax({
		        url: base_url + 'citas_pendientes_hoy',
		        data: {
		            id_medico: val
		        },
		        cache: false,
		        type: 'get',
		        beforeSend: function() {

		        },
		        success: function(response) {
		            $('#div_citas').empty().append(response);
		            var count = $('#div_citas tr.cn_cita').length;
		            contador_pendientes.innerHTML = '( ' + count + ' )';
		        }
		    });
		}

		function espera_medico(val) {
		    var contador_espera = document.getElementById('contador_espera');
		    $.ajax({
		        url: base_url + 'citas_espera_hoy',
		        data: {
		            id_medico: val
		        },
		        cache: false,
		        type: 'get',
		        beforeSend: function() {

		        },
		        success: function(response) {
		            $('#div_citas_espera').empty().append(response);
		            var count = $('#div_citas_espera tr.cn_cita').length;
		            contador_espera.innerHTML = '( ' + count + ' )';
		        }
		    });
		}

		function consulta_medico(val) {
		    var contador_consulta = document.getElementById('contador_consulta');
		    $.ajax({
		        url: base_url + 'citas_consulta_hoy',
		        data: {
		            id_medico: val
		        },
		        cache: false,
		        type: 'get',
		        beforeSend: function() {

		        },
		        success: function(response) {
		            $('#div_citas_consulta').empty().append(response);
		            var count = $('#div_citas_consulta tr.cn_cita').length;
		            contador_consulta.innerHTML = '( ' + count + ' )';
		        }
		    });
		}

		function citas_terminadas_canceladas(val) {
		    var contador_terminadas = document.getElementById('contador_terminadas');
		    $.ajax({
		        url: base_url + 'citas_terminadas_canceladas_hoy',
		        data: {
		            id_medico: val
		        },
		        cache: false,
		        type: 'get',
		        beforeSend: function() {

		        },
		        success: function(response) {
		            $('#div_citas_terminadas').empty().append(response);
		            var count = $('#div_citas_terminadas tr.cn_cita').length;
		            contador_terminadas.innerHTML = '( ' + count + ' )';
		        }
		    });
		}



		///======================================================================
		// CAMBIO DE ESTADO DE CITAS Y CANCELAR CITAS
		//======================================================================
		function pasar_pendiente(id, tipo, id_medico) {
		    $.ajax({
		        type: 'post',
		        url: base_url + 'pasar_pendiente',
		        data: {
		            id: id,
		            tipo: tipo,
		            id_medico: id_medico
		        },
		        beforeSend: function() {
		            eventFire(document.getElementById('pendientes-tab'), 'click');
		        },
		        success: function(response) {
		            select_citas_medico(id_medico);
		        }
		    });
		}

		function pasar_espera(id, tipo, id_medico) {
		    $.ajax({
		        type: 'post',
		        url: base_url + 'pasar_espera',
		        data: {
		            id: id,
		            tipo: tipo,
		            id_medico: id_medico
		        },
		        beforeSend: function() {
		            eventFire(document.getElementById('enEspera-tab'), 'click');
		        },
		        success: function(response) {
		            select_citas_medico(id_medico);
		        }
		    });
		}

		function pasar_espera_examen(id, tipo, id_medico) {
		    $.ajax({
		        type: 'post',
		        url: base_url + 'pasar_espera_examen',
		        data: {
		            id: id,
		            tipo: tipo,
		            id_medico: id_medico
		        },
		        beforeSend: function() {
		            eventFire(document.getElementById('enEspera-tab'), 'click');
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
		            url: base_url + 'pasar_consulta',
		            data: {
		                id: id,
		                tipo: tipo,
		                id_medico: id_medico
		            },
		            beforeSend: function() {
		                eventFire(document.getElementById('enConsulta-tab'), 'click');
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
		    $.ajax({
		        type: 'post',
		        url: base_url + 'pasar_terminada',
		        data: {
		            id: id,
		            tipo: tipo,
		            id_medico: id_medico,
		            id_paciente: id_paciente
		        },
		        beforeSend: function() {
		            eventFire(document.getElementById('enEspera-tab'), 'click');
		        },
		        success: function(response) {
		            select_citas_medico(id_medico);
		        }
		    });
		}


		function pasar_cancelada(id_paciente, id_cita, tipo_canc) {
		    $.getScript(base_url + '../plantilla2/js/jquery.validate.min.js');
		    var id_medico = document.getElementById('medicoSelect').value;
		    var motivo_cancelacion = document.getElementById('motivo_cancelacion').value;
		    var observacion = document.getElementById('observacion').value;
		    var d = new Date();
		    var fecha = Base64.encode(('0' + d.getDate()).slice(-2) + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear());

		    if (motivo_cancelacion != 0) {
		        $.ajax({
		            type: 'post',
		            url: base_url + 'pasar_cancelada',
		            data: {
		                id: id_cita,
		                fecha: fecha,
		                motivo_cancelacion: motivo_cancelacion,
		                observacion: observacion,
		                id_paciente: id_paciente,
		                id_medico: id_medico
		            },
		            beforeSend: function() {

		            },
		            success: function(response) {
		                if (tipo_canc != 0) {
		                    select_citas_medico(id_medico, fecha);
		                } else {
		                    select_dia_horario(id_medico, fecha);
		                }
		                swal({
		                    title: '¡Cancelación de cita médica!',
		                    text: 'La cita se canceló con éxito...',
		                    type: 'success',
		                    confirmButtonText: 'Aceptar'
		                }).then((willAcept) => {
		                    if (willAcept.value) {
		                        $('#modalCancelar').modal('hide');
		                    }
		                });
		            }
		        });
		    } else {
		        swal({
		            title: '¡Motivo de cancelación!',
		            text: 'Falta seleccionar el motivo de la cancelación...',
		            type: 'warning',
		            confirmButtonText: 'Aceptar'
		        });
		    }
		}

		/* CARGA MODAL AGENDAR CITAS */
		function abre_modal_agendar(hora, fecha) {
		    document.getElementById('comentario').value = "";
		    document.getElementById('hora_agendado').innerHTML = hora;
		    document.getElementsByClassName('btn_agendado')[0].setAttribute('onclick', "agendar_cita('" + hora + "','" + fecha + "')");
		}

		/* CARGA MODAL CANCELAR CITAS */
		function abre_modal_cancela(id_paciente, id_cita, hora, tipo_canc) {
		    document.getElementById("motivo_cancelacion").value = 0;
		    document.getElementById("observacion").value = "";
		    var id_medico = document.getElementById('medicoSelect').value;
		    document.getElementById("hora_cancelacion").innerHTML = hora;
		    if (tipo_canc != 0) {
		        document.getElementsByClassName('btn_cancel')[0].setAttribute('onclick', "pasar_cancelada(" + id_paciente + "," + id_cita + "," + tipo_canc + ")");
		    } else {
		        document.getElementsByClassName('btn_cancel')[0].setAttribute('onclick', "pasar_cancelada(" + id_paciente + "," + id_cita + "," + tipo_canc + ")");
		    }
		}

		/*CARGAR DATOS DE PAGO*/
		function carga_pagos_depositos_cita(id_cita, costo_prestacion) {
		    $.ajax({
		        type: 'post',
		        url: base_url + 'get_ultimo_abono',
		        data: {
		            id_cita: id_cita
		        },
		        beforeSend: function() {

		        },
		        success: function(data) {
		            if (data.trim() === '') {
		                console.log(data.trim());
		                document.getElementById('tPagado').innerHTML = 0;
		                document.getElementById('pRestante').innerHTML = costo_prestacion - data;
		            } else {
		                document.getElementById('pRestante').innerHTML = costo_prestacion - data;
		                document.getElementById('tPagado').innerHTML = data;
		            }
		        }
		    });


		    $.ajax({
		        type: 'post',
		        url: base_url + 'lista_depositos_por_cita',
		        data: {
		            id_cita: id_cita
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {
		            select_tipo_pago();
		            document.getElementById('lista_depositos').innerHTML = response;
		        }
		    });
		}

		function select_tipo_pago() {
		    var selected_pago = document.getElementById("oPago").value;
		    var numero_documento = document.getElementById("numero_documento");
		    var monto_abonado = document.getElementById("monto_abonado");
		    var pago_descripcion = document.getElementById("pago_descripcion");
		    if (selected_pago === 'Efectivo') {
		        numero_documento.style.display = 'none';
		        pago_descripcion.style.display = 'none';
		        monto_abonado.setAttribute('class', 'form-group col-md-9');
		    } else {
		        numero_documento.style.display = 'inherit';
		        pago_descripcion.style.display = 'inherit';
		        monto_abonado.setAttribute('class', 'form-group col-md-6');
		    }
		}

		/* CARGA PAGAR CITAS MEDICAS */
		function abre_modal_pagar_consulta(id_cita, hora, nombre_paciente, nombre_prestacion, costo_prestacion) {
		    var pago_abonar_citas = document.getElementsByClassName('agrega_pago_abono');
		    document.getElementById('nombre_paciente_pago').innerHTML = nombre_paciente;
		    document.getElementById('nombre_prestacion_pago').innerHTML = nombre_prestacion;
		    document.getElementById('valorConsulta').value = costo_prestacion;
		    document.getElementById('costo_prestacion_pago').innerHTML = costo_prestacion;
		    for (var i = 0; i < pago_abonar_citas.length; i++) {
		        pago_abonar_citas[i].setAttribute('onclick', "agregar_pago_abono_cita(" + id_cita + "," + costo_prestacion + ")");
		    }
		    carga_pagos_depositos_cita(id_cita, costo_prestacion);
		}

		function agregar_pago_abono_cita(id_cita, costo_prestacion) {
		    var pago_deposito_citas = document.getElementsByClassName('mAbonado');
		    var tipo_pago = document.getElementById('oPago');
		    var tipo_pago_ex = document.getElementById('oTipoPago');
		    var tipo_form_pago = '';
		    if ($(tipo_pago_ex).attr('disabled') !== "disabled")  {
		        tipo_form_pago = tipo_pago_ex.value;
		    } else {
		        tipo_form_pago = tipo_pago.value;
		    }


		    var comentario = document.getElementById('oPago_desc').value;
		    var noDocumento = document.getElementById('nDocumento').value;
		    var pRestante = document.getElementById('pRestante').innerHTML;
		    for (var i = 0; i < pago_deposito_citas.length; i++) {
		        deposito_cita = pago_deposito_citas[i].value;
		    }
		    if (deposito_cita != 0 && deposito_cita != '') {
		        if (pRestante != 0) {
		            if (parseInt(deposito_cita) <= parseInt(pRestante)) {
		                $.ajax({
		                    type: 'post',
		                    url: base_url + 'put_abonos',
		                    data: {
		                        id_cita: id_cita,
		                        deposito_cita: deposito_cita,
		                        resto: pRestante - deposito_cita,
		                        tipo_pago: tipo_form_pago,
		                        no_documento: noDocumento,
		                        comentario_pago: comentario
		                    },
		                    beforeSend: function() {

		                    },
		                    success: function(response) {
		                        swal({
		                            title: '¡Pago realizado con éxito!',
		                            text: 'El pago se realizó correctamente...',
		                            type: 'success',
		                            confirmButtonText: 'Aceptar'
		                        }).then((willAcept) => {
		                            if (willAcept.value) {
		                                carga_pagos_depositos_cita(id_cita, costo_prestacion);
		                                $('#form_pagos')[0].reset();
		                            }
		                        });
		                    }
		                });
		            } else {
		                swal({
		                    title: '¡Cantidad mayor!',
		                    text: 'La cantidad ingresada supera el costo de la cita, por favor de ingresar correctamente la cantidad...',
		                    type: 'error',
		                    confirmButtonText: 'Aceptar'
		                });
		            }
		        } else {
		            swal({
		                title: '¡Cita pagada!',
		                text: 'La cita se encuentra pagada...',
		                type: 'error',
		                confirmButtonText: 'Aceptar'
		            });
		        }
		    } else {
		        swal({
		            title: '¡Falta llenar pago!',
		            text: 'El pago es incorrecto, por favor de llenar la cantidad...',
		            type: 'error',
		            confirmButtonText: 'Aceptar'
		        });
		    }
		}

		function eliminar_pago(id_pago, id_cita, resto) {
		    var costo_prestacion = document.getElementById('costo_prestacion_pago').innerHTML;
		    swal({
		        title: '¿Seguro de borrar el pago?',
		        text: 'Una vez aceptado, el pago será borrado definitivamente',
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
		                url: base_url + 'eliminar_pago',
		                data: {
		                    id_pago: id_pago,
		                    id_cita: id_cita,
		                    resto: resto
		                },
		                beforeSend: function() {

		                },
		                success: function(response) {
		                    carga_pagos_depositos_cita(id_cita, costo_prestacion);
		                }
		            });
		            swal({
		                title: '¡El pago fue eliminado con éxito!',
		                type: 'success',
		            });
		        } else {
		            swal('¡Esta acción fue cancelada!');
		        }
		    });
		}

		var toggle = false;

		function toggleCheckboxTotal(check_pago) {
		    var opcion_pago_cita = document.getElementById('opcion_pago_cita');
		    var nCantidad = document.getElementById('mAbonado');
		    var pagoXcnt = document.getElementById('pagoXcnt');
		    var pRestante = document.getElementById('pRestante').innerHTML;
		    $('#oCheck').attr('checked', !toggle);
		    toggle = !toggle;
		    if (toggle != false) {
		        opcion_pago_cita.setAttribute('class', 'form-group col-md-10');
		        pagoXcnt.style.display = 'none';
		        nCantidad.value = pRestante;
		    } else {
		        opcion_pago_cita.setAttribute('class', 'form-group col-md-8');
		        pagoXcnt.style.display = 'inherit';
		        nCantidad.value = '';
		    }
		}

		function toggleCheckboxExcento(check_pago) {
		    var opcion_pago_cita = document.getElementById('opcion_pago_cita');
		    var nCantidad = document.getElementById('mAbonado');
		    var pagoXcnt = document.getElementById('pagoXcnt');
		    var opc_pago_total = document.getElementById('opc_pago_total');
		    var tipo_pago_cita = document.getElementById('tipo_pago_cita');
		    var oCheck = document.getElementById('oCheck');
		    var oTipoPago = document.getElementById('oTipoPago');
		    var pRestante = document.getElementById('pRestante').innerHTML;
		    $('#xcPago').attr('checked', !toggle);
		    toggle = !toggle;
		    if (toggle != false) {
		        opc_pago_total.style.display = 'none';
		        tipo_pago_cita.style.display = 'inherit';
		        nCantidad.value = 0;
		        opcion_pago_cita.style.display = 'none';
		        oCheck.disabled = true;
		        oTipoPago.disabled = false;
		    } else {
		        opc_pago_total.style.display = 'inherit';
		        tipo_pago_cita.style.display = 'none';
		        pagoXcnt.value = 0;
		        opcion_pago_cita.style.display = 'inherit';
		        oCheck.disabled = false;
		        oTipoPago.disabled = true;
		    }
		}


		function enviaMail(checked) {
		    var checkMail = document.getElementById('checkMail');
		    var rmvClass = document.getElementById('checked_mail');
		    if (checked == 0) {
		        checkMail.value = 1;
		        rmvClass.style.display = 'block';
		    } else {
		        checkMail.value = 0;
		        rmvClass.style.display = 'none';
		    }
		}


		function sendMail(email_, hora, fecha) {
		    var medicoSelect = document.getElementById('medicoSelect');
		    var clinica_nombre = document.getElementById('clinica_nombre');
		    var pacienteSelect = document.querySelectorAll('[data-id="pacienteSelect"]');
		    var nombre_paciente = pacienteSelect[0].getAttribute('title');
		    var id_paciente = $('#rut_paciente span').text();
		    var nombre_medico = medicoSelect.options[medicoSelect.selectedIndex].text;
		    var clinica_nombre = clinica_nombre.getAttribute('name');
		    var abrev_med = nombre_medico.split(". ");
		    if (abrev_med[0] != 'Dra') {
		        abrev_med = 'el';
		    } else {
		        abrev_med = 'la';
		    }
		    var message = '<h1>' + clinica_nombre + '</h1>';
		    message += '<p>Estimado/a <strong>' + nombre_paciente + '</strong>,<br>';
		    message += 'Su cita con ' + abrev_med + ' <strong>' + nombre_medico + '</strong> fue agendada para el día <strong>' + Base64.decode(fecha) + '</strong> a las <strong>' + hora + '</strong></p>';

		    $.ajax({
		        type: 'post',
		        url: base_url + 'update_email',
		        data: {
		            id_paciente: id_paciente,
		            email: email_,
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {

		        }
		    });

		    $.ajax({
		        type: 'post',
		        url: base_url + 'send_mail',
		        data: {
		            email: email_,
		            message: message
		        },
		        beforeSend: function() {

		        },
		        success: function(response) {
		            agendar_cita_confirma(hora, fecha);
		            $('#modal_agendar_cita').modal('hide');
		            swal({
		                title: '¡Agendado exitosamente!',
		                text: 'La cita médica se realizó con éxito y se envío correo electrónico al paciente...',
		                type: 'success',
		                confirmButtonText: 'Aceptar'
		            });
		        }
		    });

		}