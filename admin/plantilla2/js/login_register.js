	var base_url = "";

	///======================================================================
	// ======================================================================
	///======================================================================
	///======================================================================
	// ACCIONES DE INICIO DE SESION
	///======================================================================
	///======================================================================
	// ======================================================================
	///======================================================================
	
	
	
	

	///======================================================================
	// INICIAR SESION
	//======================================================================
	function login() {
		var usuario = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		$.ajax({
			type:'post',
			url: base_url + 'Login/login',
			data: {
                email: usuario,
                password: password
            },
			success: function(response){
				if( response == 'invalid' || usuario == '' || password == '' ){
					swal({
						  title: '¡Usuario y/o contraseña inválida!',
						  text: 'El usuario y/o contraseña que con los que intenta acceder no son válidos...',
						  type: 'warning',
						  confirmButtonText: 'Aceptar'
					});
				} else {
					window.location.href = base_url+response;
				}
				
			}
		});
	}
	
	window.onload = function() {
		var inputEntrar = document.getElementById("password");
		inputEntrar.addEventListener("keyup", function(event) {
		  event.preventDefault();
		  if (event.keyCode === 13) {
		    document.getElementById("btnLogin").click();
		  }
		});
	}