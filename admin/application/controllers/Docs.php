<?php

/**
 * Doctores class
 * CONTROLADOR PARA LOS USUARIOS DOCTORES
 * @extends CI_Controller
 	@Ing.LuisCobian
 	@Ing.PedroFernandez
 */
class Docs extends CI_Controller {
	//Global variable  
    public $outputData;     //Holds the output data for each view
    public $loggedInUser;
    /**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		
		$this->_modulo_id = "LOGIN";
		$this->_plantilla = "inicio/template/head";//el nav y head
		$this->_plantilla_admin = "usuario/template/head";//el nav y head

		$plantilla_clinica;

		$this->load->helper(array('url'));
        $this->load->database();
        $this->load->library('session');
        $this->load->model('usuario_model');

		$this->load->model('doc_model');

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

		//$this->load->library('tooltip_gcrud');  //load the library

		//$variable="ok";
	}


	/*
		DESPLIEGA EL INDEX DEL PERFIL 
		DE LOS DOCTORES
		*/
		
		public function index() {
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {			
				$login=$this->session->userdata('autenticado');
				$clinicas=$this->usuario_model->get_clinicas_one($login['user_id']);
				if ($clinicas!=null) {
					$data['clinicas']=$this->usuario_model->get_clinicas_one($login['user_id']);
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['info']=$login;

				    $this->load->view("inc/header2",$data); 
					$this->load->view("inc/navbar",$data); 
					//include('inc/navbar.php');
					$this->load->view("inc/footer"); 
					$this->load->view("doctores/start",$data); 
					//include('inc/lateral.php');
				} else {
					redirect(base_url('Docs/clinicas/'));
				}						
			}		
		}
		
		
		public function perfil() {
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {			
				$login = $this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				if ($clinicas !=  null) {
					$data['clinicas'] = $this->usuario_model->get_clinicas_one($login['user_id']);
					$data['perfil'] = $this->usuario_model->get_perfil($login['user_id']);
					$data['info'] = $login;
					$data['prestaciones']=$this->doc_model->get_prestaciones();
					
					//$data['scripts'] = 'doctores/scripts.php';
					//$data['header'] = 'inc_doc/header';
					//$data['lateral'] = 'inc_doc/lateral';
					//$data['navbar'] = 'inc_doc/navbar';
					//$data['footer'] = 'inc_doc/footer';
					//$data['titulo'] = 'login';
					//$data['pagina_interna'] = 'doctores/miperfil/index';
					//$this->load->view($this->_plantilla_admin, $data);
					$this->load->view('doctores/miperfil/index', $data);
				
				} else {
					redirect(base_url('perfil/'));
				}						
			}		
		}

		//DESPLIEGA EL JSON QUE TRAE TODAS LAS PRESTACIONES DEL DOCTOR
		function get_prestacion_doc(){
			$id_medico=$_SESSION['user_id'];
			$prestaciones=$this->doc_model->get_prestaciones_doc($id_medico);
			$datos=array();
			if($prestaciones!=NULL){
				foreach ($prestaciones as $key) {
					$datos['prestaciones'] = $key;
				}
				echo json_encode($datos);
			}
		}

		//Inserta la prestacion cuando le das nueva prestacion y la asigna al medico
		function insert_prestacion(){
			$prestacion=$_POST['nombre'];
			$costo=$_POST['costo'];
			$datos['nombre']=$prestacion;
			$datos['costo']=$costo;
			$this->doc_model->insert_prestacion($datos,$_SESSION['user_id']);
		}
		
		function select_prestacion(){
			$id_prestacion = $_POST['id_prestacion'];
			$id_medico = $_SESSION['user_id'];
			$this->doc_model->select_prestacion( $id_prestacion, $id_medico );
		}
		
		


		/*Metodo de salto que al selecionar id_clinica 
				te manda a un salto de _user
				y te manda a usuario
			*/
		public function set_clinica($id_clinica) { //sirve para seleccionar la clinica que va trabajar
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$this->_user($id_clinica);
			}
		}


		
		/*Metodo que guarda el id_clinica en una 
			variable de session
			*/

		public function _user($row) {	
			//$this->Mcontacto->resolver($row->id_coment);
			$datos['clinicas']=$row;
			$this->session->set_userdata('clinics', $datos);
			redirect(base_url('consultorio/'));
		}

		/*Despliega el home del sistema
		donde te muestra LAS CONSULTAS QUE TIENE 
		EN EL DIA
		*/


		public function home(){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {

				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				$fecha=date("d-m-Y");
				$data['info']=$login;
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['total_paciente']=$this->usuario_model->get_total_pacientes($clinicas['clinicas']);
				$data['total_citas']=$this->usuario_model-> get_total_citas($login['user_id'],$clinicas['clinicas']);//cambiar estatus
				$data['medicamentos']=$this->doc_model->get_medicamentos($login['id_clinica']);
				
				$data['total_citas_hoy']=$this->usuario_model->get_total_citas_hoy($login['user_id'],$fecha,$clinicas['clinicas']);//cambiar estatus
				$data['ganancia']=$this->doc_model->get_total_dinero($login['user_id'],$fecha,$clinicas['clinicas']);
				$data['pendientes']=$this->doc_model->get_citas($login['user_id'],1);
				$data['espera']=$this->doc_model->get_citas($login['user_id'],2);
				$data['consulta']=$this->doc_model->get_citas($login['user_id'],3);
				$data['canceladas']=$this->doc_model->get_citas($login['user_id'],4);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				//$data['scripts'] = 'doctores/scripts.php';
				//$data['header'] = 'inc_doc/header';
				//$data['lateral'] = 'inc_doc/lateral';
				//$data['navbar'] = 'inc_doc/navbar';
				//$data['footer'] = 'inc_doc/footer';
				//$data['titulo'] = 'login';
				//$data['pagina_interna'] = 'doctores/home/home';

				$this->load->view('doctores/home/home', $data);
			}		
		}
		
		
		/*Despliega el consultorio del sistema
			Será la página principal del sistema para cargar contenidos con ajax
		*/


		public function consultorio(){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {

				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				$fecha=date("d-m-Y");
				$data['info']=$login;
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['total_paciente']=$this->usuario_model->get_total_pacientes($clinicas['clinicas']);
				$data['total_citas']=$this->usuario_model-> get_total_citas($login['user_id'],$clinicas['clinicas']);//cambiar estatus
				$data['medicamentos']=$this->doc_model->get_medicamentos($login['id_clinica']);
				
				$data['total_citas_hoy']=$this->usuario_model->get_total_citas_hoy($login['user_id'],$fecha,$clinicas['clinicas']);//cambiar estatus
				$data['ganancia']=$this->doc_model->get_total_dinero($login['user_id'],$fecha,$clinicas['clinicas']);
				$data['pendientes']=$this->doc_model->get_citas($login['user_id'],1);
				$data['espera']=$this->doc_model->get_citas($login['user_id'],2);
				$data['consulta']=$this->doc_model->get_citas($login['user_id'],3);
				$data['canceladas']=$this->doc_model->get_citas($login['user_id'],4);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				
				$data['header'] = 'inc_doc/header';
				$data['lateral'] = 'inc_doc/lateral';
				$data['navbar'] = 'inc_doc/navbar';
				$data['titulo'] = 'login';
				$data['pagina_interna'] = 'doctores/consultas/index';
				$data['scripts'] = 'doctores/scripts.php';
				$data['footer'] = 'inc_doc/footer';

				$this->load->view($this->_plantilla_admin, $data);
			}		
		}

		/*function get_receta($id_cita=-1){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {

				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				$fecha=date("d-m-Y");
				$data['info']=$login;


				$data['header'] = 'inc_doc/header';
				$data['lateral'] = 'inc_doc/lateral';
				$data['navbar'] = 'inc_doc/navbar';
				$data['titulo'] = 'login';
				$data['pagina_interna'] = 'doctores/receta';
				$data['scripts'] = 'doctores/scripts.php';
				$data['footer'] = 'inc_doc/footer';

				$this->load->view($this->_plantilla_admin, $data);

			}

			

		}*/

		function get_receta(){
			$id_cita=$_GET['id_cita'];

			$receta=$this->doc_model->get_receta_imprimir($_GET['id_cita']);

			foreach ($receta as $key ) {
				# code...
				echo json_encode($key);
			}


				
			
		}

		/*
		DESPLIEGA EL PERFIL DEL USUARIO
		$ID=EL ID_USUER DEL USUARIO EN SESSION
		*/

		public function miperfil($id) {
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				$fecha=date("d-m-Y");
				$this->form_validation->set_rules('nombre', 'Por favor ingrese su nombre', 'required');
				$this->form_validation->set_rules('apellido_paterno', 'Por favor ingrese Apellido ', 'required');
				$this->form_validation->set_rules('apellido_materno', 'Por favor ingrese Apellido ', 'required');
				$this->form_validation->set_rules('username', 'Por favor ingrese Username ', 'required');
				$this->form_validation->set_rules('email', 'Por favor ingrese correo electrónico', 'required');
				$this->form_validation->set_rules('pass', 'Por favor ingrese Contraseña Nueva');
				$this->form_validation->set_rules('tarch', 'Fecha de Inscripción');


					if ($this->form_validation->run() == false) {
						//echo "falso";
					} else {
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellido_paterno");
						$datos['apellido_materno']=$this->input->post("apellido_materno");
						$datos['usuario']=$this->input->post("username");
						if ($this->input->post('pass')!='') {
							# code...
							$datos['contrasena']=md5($this->input->post('pass'));
						}
						if (!empty($_FILES['tarch']['name'])) {
											
							$config['upload_path'] =RUTA_USUARIOS;
							$config['allowed_types'] = 'gif|jpg|png';		
							$config['max_size']    = '20000'; // 20Mb
							$new_name =$_FILES['tarch']['name'];
							$config['file_name'] = $new_name;				
							$this->upload->initialize($config);
							if ($this->upload->do_upload('tarch')) {
								$file_data = $this->upload->data();
								$file_path =$file_data['file_name'];
								$datos['nombre']=$this->input->post("nombre");
								$datos['apellido_paterno']=$this->input->post("apellido_paterno");
								$datos['apellido_materno']=$this->input->post("apellido_materno");
								$datos['usuario']=$this->input->post("username");
								if ($this->input->post('pass')!='') {
									$datos['contrasena']=md5($this->input->post('pass'));
								}		
								$datos['foto']=$file_path;
								

							} else {

							}											
						}
						$this->usuario_model->update_perfil($id,$datos);
						redirect(base_url('Usuario/miperfil/').$id);
					}
					$data['info']=$login;
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['perfil']=$this->usuario_model->get_perfil($id);
					$data['scripts'] = 'doctores/scripts.php';
					$data['header'] = 'inc_doc/header';
					$data['lateral'] = 'inc_doc/lateral';
					$data['navbar'] = 'inc_doc/navbar';
					$data['footer'] = 'inc_doc/footer';
					$data['titulo'] = 'login';
					$data['pagina_interna'] = 'doctores/perfil/perfil';
					$this->load->view($this->_plantilla_admin, $data);
			}

					
		}

		/*
		CRUD DE PACIENTES
		*/

		public function pacientes() {
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				$data['pacientes']=$this->usuario_model->get_pacientes($clinicas['clinicas']);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	
				$data['scripts'] = 'doctores/scripts.php';
				$data['header'] = 'inc_doc/header';
				$data['lateral'] = 'inc_doc/lateral';
				$data['navbar'] = 'inc_doc/navbar';
				$data['footer'] = 'inc_doc/footer';
				$data['info']=$login;
				$data['pagina_interna'] = 'doctores/pacientes/pacientes';
				$this->load->view($this->_plantilla_admin, $data);
			}
		}



		public function agregar_pacientes(){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				//aqui va 
				$this->form_validation->set_rules('nombre', 'Por favor ingrese su nombre', 'required');
				$this->form_validation->set_rules('apellidopat', 'Por favor ingrese su nombre', 'required');
				$this->form_validation->set_rules('apellidomat', 'Por favor ingrese su nombre', 'required');
				$this->form_validation->set_rules('rut', 'Por favor ingrese su Rut', 'required');
				$this->form_validation->set_rules('edad', 'Por favor ingrese su Edad', 'required');
				$this->form_validation->set_rules('dir', 'Por favor ingrese su Direción', 'required');
				$this->form_validation->set_rules('cel', 'Por favor ingrese su Numero de Celular', 'required');
				$this->form_validation->set_rules('tel', 'Por favor ingrese su Numero de Telefonico', 'required');
				$this->form_validation->set_rules('tfecha', 'Por favor ingrese su Fecha de Nacimiento', 'required');
				$this->form_validation->set_rules('prof', 'Por favor ingrese su Profesión', 'required');
				$this->form_validation->set_rules('sexo', 'Por favor ingrese su Sexo', 'required');
				$this->form_validation->set_rules('prevision', 'Por favor ingrese su Previsión', 'required');
				$this->form_validation->set_rules('region', 'Por favor ingrese su Región', 'required');
				$this->form_validation->set_rules('comuna', 'Por favor ingrese su Comuna', 'required');		
				$this->form_validation->set_rules('ciudad', 'Por favor ingrese su Ciudad', 'required');
				$this->form_validation->set_rules('prov', 'Por favor ingrese su Provincia', 'required');
				if ($this->form_validation->run() == false) {
					//echo "falso";
				} else {
					$datos['rut_otro']=$this->input->post("rut");
					$datos['nombre']=$this->input->post("nombre");
					$datos['apellido_paterno']=$this->input->post("apellidopat");
					$datos['apellido_materno']=$this->input->post("apellidomat");
					$datos['direccion']=$this->input->post("dir");
					$datos['celular']=$this->input->post("cel");
					$datos['telefono']=$this->input->post("tel");
					$datos['edad']=$this->input->post("edad");
					$datos['sexo']=$this->input->post("sexo");
					$datos['fecha_nacimiento']=$this->input->post("tfecha");
					$datos['profesion']=$this->input->post("prof");
					$datos['comuna']=$this->input->post("comuna");
					$datos['region']=$this->input->post("region");
					$datos['prevision']=$this->input->post("prevision");
					$datos['ciudad']=$this->input->post("ciudad");
					$datos['provincia']=$this->input->post("prov");
					$datos['id_usr_creo']=$login['user_id'];
					$datos['fecha_creacion']=date("Y-m-d");
					$datos['id_clinica']=$clinica['clinicas'];
					$this->usuario_model->insert_pacientes($datos);
					redirect('Docs/pacientes');
				}	
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['header'] = 'inc_doc/header';
				$data['lateral'] = 'inc_doc/lateral';
				$data['navbar'] = 'inc_doc/navbar';
				$data['footer'] = 'inc_doc/footer';
				$data['info']=$login;
				//$data['info']=$login;
				$data['pagina_interna'] = 'doctores/pacientes/agregar_pacientes';
				$data['titulo'] = 'login';
				$this->load->view($this->_plantilla_admin, $data);
			}
		}

		
		
		public function eliminar_paciente($id_paciente){
			if (!$this->session->has_userdata('autenticado')) {
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$this->usuario_model->eliminar_paciente($id_paciente);
				redirect('Docs/pacientes');
			}
		}

		
		public function editar_paciente($id_paciente){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinica');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				//aqui va 
				$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
				$this->form_validation->set_rules('apellidopat', 'porfavor ingrese su nombre', 'required');
				$this->form_validation->set_rules('apellidomat', 'porfavor ingrese su nombre', 'required');
				$this->form_validation->set_rules('rut', 'porfavor ingrese su Rut', 'required');
				$this->form_validation->set_rules('edad', 'porfavor ingrese su Edad', 'required');
				$this->form_validation->set_rules('dir', 'porfavor ingrese su Direción', 'required');
				$this->form_validation->set_rules('cel', 'porfavor ingrese su Numero de Celular', 'required');
				$this->form_validation->set_rules('tel', 'porfavor ingrese su Numero de Telefonico', 'required');
				$this->form_validation->set_rules('tfecha', 'porfavor ingrese su Fecha de Nacimiento', 'required');
				$this->form_validation->set_rules('prof', 'porfavor ingrese su Profesión', 'required');
				$this->form_validation->set_rules('sexo', 'porfavor ingrese su Sexo', 'required');
				$this->form_validation->set_rules('prevision', 'porfavor ingrese su Previsión', 'required');
				$this->form_validation->set_rules('region', 'porfavor ingrese su Región', 'required');
				$this->form_validation->set_rules('comuna', 'porfavor ingrese su Comuna', 'required');		
				$this->form_validation->set_rules('ciudad', 'porfavor ingrese su Ciudad', 'required');
				$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');
				if ($this->form_validation->run() == false) {
					//echo "falso";
				} else {
					$datos['rut_otro']=$this->input->post("rut");
					$datos['nombre']=$this->input->post("nombre");
					$datos['apellido_paterno']=$this->input->post("apellidopat");
					$datos['apellido_materno']=$this->input->post("apellidomat");
					$datos['direccion']=$this->input->post("dir");
					$datos['celular']=$this->input->post("cel");
					$datos['telefono']=$this->input->post("tel");
					$datos['edad']=$this->input->post("edad");
					$datos['sexo']=$this->input->post("sexo");
					$datos['fecha_nacimiento']=$this->input->post("tfecha");
					$datos['profesion']=$this->input->post("prof");
					$datos['comuna']=$this->input->post("comuna");
					$datos['region']=$this->input->post("region");
					$datos['prevision']=$this->input->post("prevision");
					$datos['ciudad']=$this->input->post("ciudad");
					$datos['provincia']=$this->input->post("prov");
					$datos['id_usr_creo']=$login['user_id'];
					$datos['fecha_creacion']=date("Y-m-d");

					if (!empty($_FILES['tarch']['name'])) {		
						$config['upload_path'] =RUTA_PACIENTES;
						$config['allowed_types'] = 'gif|jpg|png|';		
						$config['max_size']    = '20000'; // 20Mb
						$new_name =$_FILES['tarch']['name'];
						$config['file_name'] = $new_name;				
						$this->upload->initialize($config);

						if ($this->upload->do_upload('tarch')) {
							$file_data = $this->upload->data();
							$file_path =$file_data['file_name'];
							$datos['rut_otro']=$this->input->post("rut");
							$datos['nombre']=$this->input->post("nombre");
							$datos['apellido_paterno']=$this->input->post("apellidopat");
							$datos['apellido_materno']=$this->input->post("apellidomat");
							$datos['direccion']=$this->input->post("dir");
							$datos['celular']=$this->input->post("cel");
							$datos['telefono']=$this->input->post("tel");
							$datos['edad']=$this->input->post("edad");
							$datos['sexo']=$this->input->post("sexo");
							$datos['fecha_nacimiento']=$this->input->post("tfecha");
							$datos['profesion']=$this->input->post("prof");
							$datos['comuna']=$this->input->post("comuna");
							$datos['region']=$this->input->post("region");
							$datos['prevision']=$this->input->post("prevision");
							$datos['ciudad']=$this->input->post("ciudad");
							$datos['provincia']=$this->input->post("prov");
							$datos['id_usr_creo']=$login['user_id'];
							$datos['fecha_creacion']=date("Y-m-d");
							$datos['foto']=$file_path;
						} else {		 
							$data['error']="La Convocatoria no se registro ";
							$data['messege']="El archivo"."  ".$_FILES['tarch']['name']."  "."no se subió correctamente ";
						}					
					}
					$this->usuario_model->update_paciente($datos,$id_paciente);
					redirect(base_url('Docs/editar_paciente').'/'.$id_paciente);
				}
				
				$data['paciente']=$this->usuario_model->get_paciente($id_paciente);
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['header'] = 'inc_doc/header';
				$data['lateral'] = 'inc_doc/lateral';
				$data['navbar'] = 'inc_doc/navbar';
				$data['footer'] = 'inc_doc/footer';
				$data['titulo'] = 'login';
				$data['info']=$login;
				$data['pagina_interna'] = 'usuario/pacientes/editar_pacientes';
				$data['titulo'] = 'login';
				$this->load->view($this->_plantilla_admin, $data);
			}
		}
		
		/*
			CRUD DE CLINICAS INSERTAR
		*/

		function insert_clinicas(){

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}

			else{


			$login=$this->session->userdata('autenticado');
			$clinicas=$this->session->userdata('clinics');
			//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
			$this->form_validation->set_rules('colores', 'porfavor ingrese una clinica', 'required');

			if ($this->form_validation->run() == false) {
				
				//echo "falso";
			}
			else{

				$login=$this->session->userdata('autenticado');

				$clinicas=$this->input->post("colores");


					$datos['id_user']=$login['user_id'];
					$datos['id_clinica']=$clinicas;

					$this->usuario_model->insert_clinica($datos);

					redirect(base_url('Docs/clinicas'));

				
			}
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['info']=$login;
					$data['user_id']=$login['user_id'];
					$data['scripts'] = 'doctores/scripts.php';
					$data['clinicas']=$this->usuario_model->get_clinicas();			
					$this->load->view("inc_doc/header2",$data); 


						 	 $this->load->view("inc_doc/navbar",$data); 

						    //include('inc/navbar.php');
						   	$this->load->view("inc_doc/footer"); 
						   	$this->load->view("doctores/sin_clinica",$data);

			}


		}



		

		/*
			CRUD DE CLINICAS VER
		*/

	    function clinicas(){

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}
			else{
					$login=$this->session->userdata('autenticado');
					$clinicas=$this->session->userdata('clinics');
					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$data['info']=$login;
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['clinicas']=$this->usuario_model->get_clinicas_one($login['user_id']);
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'doctores/scripts.php';
					$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);



					$this->load->view("inc_doc/header2",$data); 


					$this->load->view("inc_doc/navbar",$data); 

						    //include('inc/navbar.php');
					$this->load->view("inc_doc/footer"); 
				 	$this->load->view("doctores/clinicas",$data); 
			}

		

		}



		/*
		FIN DEL CRUD PACIENTES
		*/
		public function consultas(){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['info']=$login;
				$data['clinicas']=$this->usuario_model->adm_clinicas();
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['consultas']=$this->usuario_model->get_consultas($login['user_id'],$clinica['clinicas']);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['scripts'] = 'doctores/scripts.php';
				$this->load->view("inc_doc/header",$data); 
				$this->load->view("inc_doc/navbar",$data); 
				$this->load->view("inc_doc/lateral",$data); 
				//include('inc/navbar.php');
				$this->load->view("inc_doc/footer"); 
			 	$this->load->view("doctores/consultas/consultas",$data); 
			}
		}

		public function documentos(){
			if (!$this->session->has_userdata('autenticado')) {
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else{
				$datos['id_cita'] = $this->input->post('id_cita');
				$datos['nombre']=$this->input->post('nombre_doc');
				$datos['descripcion']=$this->input->post('descripcion');
				$datos['fecha']= date("Y-m-d");
				
				$uploadedFile = '';
			    if(!empty($_FILES["tarch"]["type"])){
					$fileName = $_FILES['tarch']['name'];
					$tipo = $_FILES['tarch']['type'];
					$tamanio = $_FILES['tarch']['size'];
					$ruta = $_FILES['tarch']['tmp_name'];
					$datos['documento'] = $fileName;
					$destino = "img/documentos/".$fileName;
				    if(move_uploaded_file($ruta, $destino)){
				        $uploadedFile = $fileName;
				    }
				}
				
				if(isset($_FILES["tarch"]["type"])) {
					$this->usuario_model->insert_documento($datos);
					echo 'ok';
				} else {
					echo 'error';
				}
			}
		}

		public function get_documentos(){
			$datos=array();
			$documentos=$this->doc_model->get_documentos($_GET['id_cita']);
			
			if($documentos!=NULL){
				foreach ($documentos as $key) {
					echo json_encode($key);
				}
			}		
		}

		function eliminar_documento(){
			if (!$this->session->has_userdata('autenticado')) {
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			}
			else{
				$this->doc_model->eliminar_documento($_POST['id']);
			}
		}





 		public function escapar($str) {
			return mysqli_real_escape_string($this->db->conn_id, $str);
		}
					
					
		public function nocero($str) {
			if($str <> 0){
				return true;
			}else{
				$this->form_validation->set_message('nocero', 'Debe seleccionar %s ');
				return false;
			}
		}
					
					
		public function porciento($str) {
			if($str >= 0 and $str <=100){
				return true;
			}else{
				$this->form_validation->set_message('porciento', 'El valor del campo debe estar entre 0 y 100');
				return false;
			}
		}	




}

?>