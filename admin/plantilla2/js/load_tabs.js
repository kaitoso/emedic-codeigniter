		var base_url = "";
		
		///======================================================================
		// CARGA EL DIV SELECCIONADO DE LOS TABS
		//======================================================================
		
		/* OBTIENE EL DATO DESDE LA URL PARA CARGAR EL CONTENIDO */
		if ( document.location.hash != '' ) {    
			var etiqueta_pagina = document.location.hash.replace('#',''); 
			var current_button = document.getElementById(etiqueta_pagina+'_');
			document.getElementById(etiqueta_pagina+'_').click();
			current_button.style.display = "block";
			obtener_hash(etiqueta_pagina);
			//removeUrlHash();
		} else {
			var etiqueta_pagina = document.location.hash.replace('#',''); 
			var current_button = document.getElementById(etiqueta_pagina+'_');
			if(current_button!=null){
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
			var current_button = document.getElementById(etiqueta_pagina+'_');
			current_div.style.display = "block";
			current_button.style.display = "block";



			/* HACE UN CLICK SOBRE EL BOTON CREADO */
			document.getElementById(etiqueta_pagina+'_').click();
			
			
			
			/* CARGA CONTENIDOS DE PÁGINA SELECCIONADA */
			if(etiqueta_pagina!=='cita'){
				$.ajax({
					type:'post',
					url: base_url+'../'+etiqueta_pagina,
					success: function(data){
						document.getElementById(etiqueta_pagina).innerHTML = data;
					}
				});
			}
			if(etiqueta_pagina==='perfil'){
				window.onload = function() {
					get_prestaciones_doc();
				}
			}
			if(etiqueta_pagina==='consultas_del_dia'){
				window.onload = function() {
					citas_pendientes_hoy();
				}
			}
		}	