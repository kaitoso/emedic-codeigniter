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
		        url: base_url + '../Usuario/' + etiqueta_pagina,
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
		// AGREGAR USUARIOS
		//======================================================================
		function click_add() {
		    document.getElementById('submit_add_usuario').click();
		}

		// function usuarios_formulario_agregar() {
		//     var modal_pacientes_name = document.getElementById('modal_usuarios_name');
		//     var actionAddEdit = document.getElementById('actionAddEdit');
		//     $.ajax({
		//         type: 'post',
		//         url: base_url + '../Usuario/agregar_usuario',
		//         data: {

		//         },
		//         beforeSend: function() {
		//             event.preventDefault();
		//             agregar_usuario();
		//         },
		//         success: function(response) {
		//             actionAddEdit.style.display = 'inline';
		//             actionAddEdit.setAttribute('onclick', 'click_add()');
		//             actionAddEdit.innerHTML = 'Agregar';
		//             modal_pacientes_name.innerHTML = 'Agregar usuario';
		//             document.getElementById('load_cont_usuarios').innerHTML = response;
		//         }
		//     });
		// }
		function usuarios_formulario_agregar() {
		    var modal_usuarios_name = document.getElementById('modal_usuarios_name');
		    var actionAddEdit = document.getElementById('actionAddEdit');
		    $.ajax({
		        type: 'post',
		        url: base_url + '../Usuario/agregar_usuario',
		        data: {

		        },
		        beforeSend: function() {
		            $.getScript(base_url + '../plantilla2/js/jquery.validate.min.js');
		            $.getScript(base_url + '../plantilla2/js/jquery.rut.min.js');
		        },
		        success: function(response) {
		            actionAddEdit.style.display = 'inline';
		            actionAddEdit.setAttribute('onclick', 'click_add()');
		            actionAddEdit.innerHTML = 'Agregar';
		            modal_usuarios_name.innerHTML = 'Agregar usuario';
		            document.getElementById('load_cont_usuarios').innerHTML = response;




		            event.preventDefault();
		            agregar_paciente();



		        }
		    });
		}





		function agregar_usuario() {
		    var formData = $("#frmAgregar").serialize();
		    $.ajax({
		        type: 'post',
		        url: base_url + '../Usuario/agregar_usuario',
		        data: formData,
		        success: function(response) {
		            //carga_lista_usuarios();
		            swal({
		                title: '¡Agregado con éxito!',
		                text: 'Los datos del usuario se registraron con éxito...',
		                type: 'success',
		                confirmButtonText: 'Aceptar'
		            }).then((willAcept) => {
		                if (willAcept.value) {
		                    $('#modal_usuarios').modal('hide');
		                }
		            });
		        }
		    });
		}
		//editar esta funcion para que funcione
		function carga_lista_usuarios() {
		    $.ajax({
		        type: 'post',
		        url: base_url + '../usuarios',
		        data: {

		        },
		        success: function(response) {
		            document.getElementById('usuarios').innerHTML = response;
		        }
		    });
		}

		function elimina_usuario(id) {
		    console.log("prueba");

		    swal({
		        title: '¿Seguro de borrar el Usuario?',
		        text: 'Una vez aceptado, el Usuario  será borrado definitivamente',
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
		                url: base_url + '../Usuario/elimina_usuario',
		                data: {
		                    id: id
		                },
		                beforeSend: function() {

		                },
		                success: function(response) {

		                }
		            });
		            swal({
		                title: '¡El Usuario fue borrado con éxito!',
		                type: 'success',
		            });

		            location.reload();
		        } else {
		            swal('¡Esta acción fue cancelada!');
		        }
		    });
		}