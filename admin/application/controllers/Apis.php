<?php 

/* CONTROLADOR DE LOS SERVICIOS WEB DE LA AGENDA ONLINE
	@Ing.LuisCobian
 	@Ing.PedroFernandez

*/


class Apis extends CI_Controller
{
	
	public function __construct(){
			
			parent::__construct();
			
			$this->_modulo_id = "LOGIN";
			$this->_plantilla = "inicio/template/head";//el nav y head
			$this->_plantilla_admin = "usuario/template/head";//el nav y head

			$plantilla_clinica;

				
			$this->load->database();
			$this->load->helper('url');
			$this->load->model('publico_model');
			
			$this->load->library('session');
			$this->load->model('usuario_model');
			$this->load->model('doc_model');
			$this->load->model('paciente_model');

			$this->load->library('email');
			$this->load->library('upload');
			$this->load->library('form_validation');
			$this->outputData['listOfUsers']    = $this->usuario_model->getUsersChat();
	        @session_start();
	        $this->load->library('ci_chat');
	        if( !isset( $_SESSION['username'] )  || !isset( $_SESSION['user_id'] )  ){
	            $_SESSION['username'] = $this->session->userdata('username');
	            $_SESSION['user_id'] = $this->session->userdata('user_id');
	        }

		
		}


		/*
			Web Service para loguear a un paciente
			
			Parametros 

			$email = Correo que fue registrado 
			$pass= Contraseña que escribio

			Retorno 

			Json Array message true si fue logueado
			false si no fue logueado
		*/

		function login_paciente(){

			$email=$_GET['username'];
			$pass=$_GET['password'];
			

			if (isset($email)and !is_null($email) and isset($pass) and !is_null($pass) ) {
				# code...
				$paciente=$this->paciente_model->get_login($email,$pass);

				if ($paciente) {
					# code...
					foreach ($paciente as $key) {
			# code...

						$datos['success']=$key;
					}
					echo json_encode(Array('message' => 'true'));
				}
				else{

					echo json_encode(Array('message' => 'false'));
				}

					
		
			}

			else{
				
					$datos[]="Ingrese Campos";
					echo  json_encode($datos);
			}
			
		}



		/*
			Web Service para el registro de pacientes
			
			Parametros 

			$nombre = Nombre del Paciente
			$apellidopat= Apellido paterno del Paciente
			$apellidomat= Apellido materno del Paciente
			$rut=rut del paciente
			$cel=celular del paciente
			$correo=correo del paciente
			$isapre=empresa de seguro que pertenece
			$id_clinica=pertenece a la clinica que ofrece los servicos que quiere

			Retorno 

			Json Array message true si el paciente fue registrado
			false si no fue registrado
		*/

		function registro_paciente(){

					

					
						$datos['rut_otro']=$this->input->post("rut");
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellidopat");
						$datos['apellido_materno']=$this->input->post("apellidomat");
						
						$datos['celular']=$this->input->post("cel");
						$datos['telefono']=$this->input->post("tel");
						$datos['email']=$this->input->post("correo");
						$datos['isapre']=$this->input->post('isapre');
						$datos['fecha_creacion']=date("Y-m-d");
						
							# code...
						$datos['id_clinica']=$this->input->post("id_clinica");

						
						
						if (isset($datos) and is_array($datos) and count($datos)>0) {
							# code...
							$data['message']="Registrado";
							echo  json_encode($data);
							$this->usuario_model->insert_pacientes($datos);
							
						}
						else{
							$datos['message']="Error";
							echo  json_encode($datos);
						}

						//echo  json_encode($datos);

						//var_dump();

						
					

		}


		/*
			Web Service para el actualizar de pacientes
			
			Parametros 

			$nombre = Nombre del Paciente
			$apellidopat= Apeñido del Paciente
			$apellidomat= Apeñido del Paciente
			$rut=rut del paciente
			$cel=celular del paciente
			$correo=correo del paciente
			$isapre=empresa de seguro que pertenece
			$id_clinica=pertenece a la clinica que ofrece los servicos que quiere

			Retorno 

			Json Array message true si el paciente fue actualizado
			false si no fue actualizado
		*/


		function editar_pacientes(){


						$datos['rut_otro']=$this->input->post("rut");
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellidopat");
						$datos['apellido_materno']=$this->input->post("apellidomat");
						
						$datos['celular']=$this->input->post("cel");
						$datos['telefono']=$this->input->post("tel");
						$datos['email']=$this->input->post("correo");
						$datos['isapre']=$this->input->post('isapre');
						$datos['fecha_creacion']=date("Y-m-d");
						
							# code...
						$datos['id_clinica']=$this->input->post("id_clinica");

						
						
						if (isset($datos) and is_array($datos) and count($datos)>0) {
							# code...
							$data['message']="Registrado";
							echo  json_encode($data);
							$this->usuario_model->update_paciente($datos);
							
						}
						else{
							$datos['message']="Error";
							echo  json_encode($datos);
						}
			
		}


		/*
			Web Service obtiene los medicos por clinica
			
			Parametros 

			$id_clinica =la clinica que esta afiliado el doctor
			

			Retorno 

			Json Array medicos regresa el nombre , id_doctor ,prestacion y el costo que ofrece el doctor  
		*/

		function medicos(){

			$id_clinica=$this->input->get("id_clinica");

			if (isset($id_clinica) and count($id_clinica)>0) {
				# code...

				$medicos=$this->publico_model->get_doctores($id_clinica);


				if (isset($medicos) and is_array($medicos) and count($medicos)>0) {
					# code...

						$datos=array();
					
					foreach ($medicos as $key) {

							$datos[]=$key;

							
							//echo json_encode(Array('medicos' =>$key));
						
					}

					echo  json_encode($datos);
				}

				else{
					$datos=array();
					$datos[]="Error";
					echo  json_encode($datos);
				}
				
				


			}


		}


		/*
			Web Service obtiene los Horarios del doctor
			
			Parametros 

			$id_medico =el medico que quieres saber su horarios
			

			Retorno 

			Json Array medicos regresa el nombre y id_doctor 
		*/


		function horarios(){

			$id_medico=$this->input->get("id_medico");

			if (isset($id_medico) and count($id_medico)>0) {
				# code...

				$horarios=$this->paciente_model->get_horarios();

				foreach ($horarios as $key) {


						echo json_encode(Array('horarios' =>$key));
					
				}

			}

		}

		/*
			Web Service para agendar cita normal
			
			Parametros 

			$comentario =el comentario de la cita
			id_paciente=el id del paciente que quiere cita
			id_medico=el medico que va dirigido el medico
			fecha=la fecha de la cita
			hora=la hora de la cita
			id_prestacion=la prestacion del doctor
			id_clinica=la clinica que solicita la clinica

			Retorno 

			Json Array citas si se guardo regresa true si no false
		*/

		public function guardar_cita() {
		
		$id = 0;	
		$comentario="";

		if (empty($this->input->post("comentario"))) {
			# code...
			$comentario="sin";
		}
		else {
			# code...
			$comentario=$this->input->post("comentario");
		}
		

        	$data = array(
            'id_paciente' =>$this->input->post("id_paciente"),
            'id_medico' =>$this->input->post("id_medico"),
			'fecha' =>$this->input->post("fecha"),
			'hora' =>$this->input->post("hora"),

			'comentario'=>$comentario,
			'id_prestacion'=>$this->input->post("id_prestacion"),
			'tipo'=>"normal",
			'pendiente'=>1,
			'finalizada'=>0,
			'espera'=>0,
			'consulta'=>0,
			'id_clinica'=>$this->input->post("id_clinica")
        );

        	$datos=array(
        	'citado'=> 1 //paciente citado estatus = 1

        	);
        
        if ($this->paciente_model->agendar_cita($id,$data,$datos)) {
        	# code...
        	echo json_encode(Array('citas' =>"success"));
        }

        else{
        	echo json_encode(Array('citas' =>"false"));
        }
        //return redirect('/agenda/', 'refresh');
    }



    /*
			Web Service para agendar cita sobrecupo
			
			Parametros 

			$comentario =el comentario de la cita
			id_paciente=el id del paciente que quiere cita
			id_medico=el medico que va dirigido el medico
			fecha=la fecha de la cita
			hora=la hora de la cita
			id_prestacion=la prestacion del doctor
			id_clinica=la clinica que solicita la clinica

			Retorno 

			Json Array citas si se guardo regresa true si no false
	*/



    public function guarda_sobrecupo() {//aqui inserto en la tabla de pacientes el citado al hacer sobrecoupo
	    $id = 0;	
		$comentario="";

		if (empty($this->input->post("comentario"))) {
			# code...
			$comentario="sin";
		}
		else {
			# code...
			$comentario=$this->input->post("comentario");
		}
		

        	$data = array(
            'id_paciente' =>$this->input->post("id_paciente"),
            'id_medico' =>$this->input->post("id_medico"),
			'fecha' =>$this->input->post("fecha"),
			'hora' =>$this->input->post("hora"),

			'comentario'=>$comentario,
			'id_prestacion'=>$this->input->post("id_prestacion"),
			'tipo'=>"sobrecupo",
			'pendiente'=>1,
			'finalizada'=>0,
			'espera'=>0,
			'consulta'=>0,
			'id_clinica'=>$this->input->post("id_clinica")
        );

        	$datos=array(
        	'citado'=> 1 //paciente citado estatus = 1

        	);
        
        if ($this->paciente_model->agendar_cita($id,$data,$datos)) {
        	# code...
        	echo json_encode(Array('citas' =>"success"));
        }

        else{
        	echo json_encode(Array('citas' =>"false"));
        }
        //return redirect('/agenda/', 'refresh');
    }




 /*
			Web Service para agendar cita web
			
			Parametros 

			$comentario =el comentario de la cita
			id_paciente=el id del paciente que quiere cita
			id_medico=el medico que va dirigido el medico
			fecha=la fecha de la cita
			hora=la hora de la cita
			id_prestacion=la prestacion del doctor
			id_clinica=la clinica que solicita la clinica

			Retorno 

			Json Array citas si se guardo regresa true si no false
	*/



    public function guarda_citasWeb() {//aqui inserto en la tabla de pacientes el citado al hacer sobrecoupo
	  	 $id = 0;	
		$comentario="";

		if (empty($this->input->post("comentario"))) {
			# code...
			$comentario="sin";
		}
		else {
			# code...
			$comentario=$this->input->post("comentario");
		}
		

        	$data = array(
            'id_paciente' =>$this->input->post("id_paciente"),
            'id_medico' =>$this->input->post("id_medico"),
			'fecha' =>$this->input->post("fecha"),
			'hora' =>$this->input->post("hora"),

			'comentario'=>$comentario,
			'id_prestacion'=>$this->input->post("id_prestacion"),
			'tipo'=>"web",
			'pendiente'=>1,
			'finalizada'=>0,
			'espera'=>0,
			'consulta'=>0,
			'id_clinica'=>$this->input->post("id_clinica")
        );

        	$datos=array(
        	'citado'=> 1 //paciente citado estatus = 1

        	);
        
        if ($this->paciente_model->agendar_cita($id,$data,$datos)) {
        	# code...
        	$data['message']="Agendada";
			echo  json_encode($data);

        	//echo json_encode(Array('citas' =>"success"));
        }

        else{

        	$data['message']="No agendada";
			echo  json_encode($data);
        	//echo json_encode(Array('citas' =>"false"));
        }
        //return redirect('/agenda/', 'refresh');
    }



/*
			Web Service para obtener la tabla de 
			horarios
			
			Parametros 
			
			id_medico selecionando el horario y te retonar
			los horarios diponibles que tiene el id selecionado 
			con un intervalo de 15 cada hora que es lo que
			dura la cita
			
			Retorno 

			Json Array citas con las horas 
	*/
     function getCitas(){

    	$id_medico=$this->input->get("id_medico");

    	$horas = array('9:45','10:15','10:20','10:35','10:45','11:00','11:15','11:30','11:45',
    	 '12:00','12:15','12:30','12:45','13:00','13:15','13:30','13:45','14:00','14:15','14:30'
    	 ,'14:45','15:00','15:15','15:30','15:45','16:00','16:15','16:30','16:45','17:00','17:15','17:30',
    	 '17:45','18:00','18:15','18:30','18:45','19:00','19:15','19:30','19:45','20:00','20:15',
    	 '20:30','20:45','21:00','21:15','21:30','21:45','22:00','22;15','22:30','22:45','23:00'
    	);


    	$horarios=$this->paciente_model->get_horarios_doc($id_medico);
    	$parts = explode(':', $horarios->hora_fin);
    	$hora_fin=$parts[0];
    	$datos=array();
    	
    	if (isset($horarios)  and count($horarios)>0) {
    		# code...
    	
    	foreach ($horas as $key => $value) {

    		$hrs=explode(':', $value);
    			# code...

    		if ($hrs[0]<=$hora_fin) {
    			# code...
    			$datos[]=$value;
    		}

    		   		
    	}

    	}
    	else{
    		$datos[]="sin horario";
    	}

   
    	echo json_encode($datos);

				

    }

    function getEspecialidad(){
    	
    	$especialidad=$this->input->get("especialidad");
    	$clinica=$this->input->get("clinica");
    	$medico=$this->input->get("medico");

    	$medicos=$this->publico_model->get_especialidad($especialidad,$medico,$clinica);


    		$datos=array();
					
					foreach ($medicos as $key) {

							$datos[]=$key;

							
							//echo json_encode(Array('medicos' =>$key));
						
					}



					echo  json_encode($datos);
    }





}








 ?>