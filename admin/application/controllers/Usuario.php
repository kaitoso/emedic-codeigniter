<?php 

/**
 * User class.
 * 
 * @extends CI_Controller
 Controlador para las enfermeras y administradores

 @Ing.LuisCobian
 	@Ing.PedroFernandez
 */
class Usuario  extends CI_Controller {
	//Global variable  
    public $outputData;     //Holds the output data for each view
    public $loggedInUser;
    /**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(){
			parent::__construct();
			
			$this->_modulo_id = "LOGIN";
			$this->_plantilla = "inicio/template/head";//el nav y head
			$this->_plantilla_admin = "usuario/template/head";//el nav y head
			$this->load->model('publico_model');
			$plantilla_clinica;

			///$this->_plant = "template/admin_lte.php";//el nav y head			
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('Csvimport');
			//$this->load->library('grocery_CRUD');
			//$this->load->model('grocery_crud_model');
			$this->load->library('session');
			$this->load->model('usuario_model');
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

		/*Despliega el listado de clinicas

			si no estas enrolado a ninguna clinica te manda 
			a otro metodo para que insertes clinica si no
			te despliega las clinicas que esta enroladas
			
			$dep = ID de la Dependencia, tabla: plan.ca_dep
		*/


        function index(){

					if (!$this->session->has_userdata('autenticado')) {
						# code...
							$this->session->sess_destroy();//para destruir sesion
							redirect(base_url());

					}

					else{
							
							$login=$this->session->userdata('autenticado');


							$clinicas=$this->usuario_model->get_clinicas_one($login['user_id']);

							$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);

							


							if ($clinicas!=null) {
								# code...
		//ver
								$data['clinicas']=$this->usuario_model->get_clinicas_one($login['user_id']);
								$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);

								$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);

								$data['info']=$login;

								 	$this->load->view("inc/header2",$data); 


								 	 $this->load->view("inc/navbar",$data); 

								    //include('inc/navbar.php');
								   	$this->load->view("inc/footer",$data); 
								   	$this->load->view("usuario/start",$data); 
								    //include('inc/lateral.php');

							}

							else{
								//si no estas enrolado te manda a clinicas para insertar una 
								//nueva

								redirect(base_url('Usuario/clinicas/'));

								
							}
					}
		}
		
		function index2(){

					if (!$this->session->has_userdata('autenticado')) {
						# code...
							$this->session->sess_destroy();//para destruir sesion
							redirect(base_url());

					}

					else{
							
							$login=$this->session->userdata('autenticado');


							$clinicas=$this->usuario_model->get_clinicas_one($login['user_id']);

							$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);

							


							if ($clinicas!=null) {
								# code...
		//ver
								$data['clinicas']=$this->usuario_model->get_clinicas_one($login['user_id']);
								$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);

								$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);

								$data['info']=$login;

								 	$this->load->view("inc/header2",$data); 
								 	$this->load->view("inc/navbar",$data); 
								 	$this->load->view("inc/lateral",$data); 
								 	$this->load->view("usuario/usuarios/index",$data); 
								    //include('inc/navbar.php');
								   	$this->load->view("inc/footer",$data); 
								   	
								    //include('inc/lateral.php');

							}

							else{
								//si no estas enrolado te manda a clinicas para insertar una 
								//nueva

								redirect(base_url('Usuario/usuarios/index'));

								
							}
					}
		}
		
		public function citas_medico() {
			if (!$this->session->has_userdata('autenticado')) {
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['info']=$login;
				$data['motivos']=$this->usuario_model->adm_motivos();
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['presentacion']=$this->usuario_model->get_prestacion();
				$data['doctores']=$this->usuario_model->get_doctores($clinica['clinicas']);
				$data['pacientes']=$this->usuario_model->get_pacientes($clinica['clinicas']);
	
				//$data['clinicas']=$this->usuario_model->adm_clinicas();
				//$data['consultas']=$this->usuario_model->get_consultas($login['user_id'],$clinica['clinicas']);
	
				$this->load->view("usuario/reportes/citas_medico",$data); 
			}
		}

			/*Metodo de salto que al selecionar id_clinica 
				te manda a un salto de _user
				y te manda a usuario
			*/

		function set_clinica($id_clinica)
		{ //sirve para seleccionar la clinica que va trabajar

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}
			else{
				$login=$this->session->userdata('autenticado');
				
				$this->_user($id_clinica);
					


					

			}


		}


			/*Metodo que guarda el id_clinica en una 
			variable de session
			*/
		function _user($row)
		{
			
			//$this->Mcontacto->resolver($row->id_coment);

			$datos['clinicas']=$row;
			

			$this->session->set_userdata('clinics', $datos);


			

			redirect(base_url('agenda/#inicio'));
	
			
		}


		/*Despliega el home del sistema
		donde te muestra los pacientes citas y dinero 
		recudado
		*/

		function home(){

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}
			else{

				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');
				//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);

				
				$fecha=date("d-m-Y");

				
					$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);

					$data['info']=$login;
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['total_paciente']=$this->usuario_model->get_total_pacientes_card($clinicas['clinicas']);
					$data['total_citas']=$this->usuario_model-> get_total_citas($login['user_id'],$clinicas['clinicas']);//cambiar estatus
					$data['total_citas_hoy']=$this->usuario_model->get_total_citas_hoy($login['user_id'],$fecha,$clinicas['clinicas']);//cambiar estatus
					

					

					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					
					//$data['scripts'] = 'usuario/scripts.php';
					//$data['header'] = 'inc/header';
					//$data['lateral'] = 'inc/lateral';
					//$data['navbar'] = 'inc/navbar';
					//$data['footer'] = 'inc/footer';
					//$data['titulo'] = 'login';
					//$data['pagina_interna'] = 'usuario/home';
					//$this->load->view($this->_plantilla_admin, $data);
					
					$this->load->view("usuario/home",$data);
			}

					
		}


		/*Despliega los pacientes q
		que tienes en la clinica
		
		*/
		function pacientes(){

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}
			else{
					$login=$this->session->userdata('autenticado');//variable de session del usuario
					$clinicas=$this->session->userdata('clinics');//variable de session de la clinica

					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);
					

					
					if (isset($_POST['estado']) and $_POST['estado']>0) {
						/*cuando usted cargue los pacientes desde la agenda envie un parametro 
						de agenda=0 para saber que esta ubicado en agenda y le pueda mostrar los 
						pacientes que pueden agendar  
						# code... */

						$data['pacientes']=$this->usuario_model->get_pacientes($clinicas['clinicas']);


					}
					else{
						$data['pacientes']=$this->usuario_model->get_pacientes($clinicas['clinicas'],1);
					}



					
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['previsiones']=$this->usuario_model->get_previsiones($clinicas['clinicas']);

					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'doctores/scripts.php';
					$data['grupos']=$this->usuario_model->get_grupos();	

					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					//$data['header'] = 'inc/header';
					//$data['lateral'] = 'inc/lateral';
					//$data['navbar'] = 'inc/navbar';
					//$data['footer'] = 'inc/footer';
					//$data['titulo'] = 'login';
					//$data['info']=$login;
					//$data['pagina_interna'] = 'usuario/pacientes/pacientes';
					//$this->load->view($this->_plantilla_admin, $data);
					$this->load->view("usuario/pacientes/pacientes",$data); 
			}

		}


	/*
		metodo para agregar pacientes
		a las clinicas
	*/
		public function agregar_pacientes(){

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			} else {
					$login=$this->session->userdata('autenticado');
					$clinica=$this->session->userdata('clinics');
					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);

					//aqui va 
					$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidopat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidomat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('rut', 'porfavor ingrese su Rut', 'required');
					$this->form_validation->set_rules('tfecha', 'porfavor ingrese su Fecha de Nacimiento', 'required');
					$this->form_validation->set_rules('sexo', 'porfavor ingrese su Sexo', 'required');
					$this->form_validation->set_rules('cel', 'porfavor ingrese su Numero de Celular', 'required');
					$this->form_validation->set_rules('prevision', 'porfavor ingrese su Previsión', 'required');

					if ($this->form_validation->run() == false) {
						//var_dump($this->form_validation->run());
					} else {
						
						$datos['rut_otro']=$_POST['rut'];//$this->input->post("rut");
						$datos['nombre']=$_POST['nombre'];//$this->input->post("nombre");
						$datos['apellido_paterno']=$_POST['apellidopat'];//$this->input->post("apellidopat");
						$datos['apellido_materno']=$_POST['apellidomat'];//$this->input->post("apellidomat");
						$datos['direccion']=$_POST['dir'];//$this->input->post("dir");
						$datos['celular']=$_POST['cel'];//$this->input->post("cel");
						$datos['telefono']=$_POST['tel'];//$this->input->post("tel");
						$datos['email']=$_POST['email'];//$this->input->post("email");
						$datos['sexo']=$_POST['sexo'];//$this->input->post("sexo");
						$datos['prevision']=$_POST['prevision'];//$this->input->post("prevision");
						$datos['fecha_nacimiento']=$_POST['tfecha'];//=$this->input->post("tfecha");
						$datos['profesion']=$_POST['prof'];//$this->input->post("prof");
						$datos['comuna']=$_POST['comuna'];;//$this->input->post("comuna");
						$datos['region']=$_POST['region'];//$this->input->post("region");
						$datos['provincia']=$_POST['prov'];//$this->input->post("prov");
						$datos['ciudad']=$_POST['ciudad'];//$this->input->post("ciudad");
						$datos['id_usr_creo']=$login['user_id'];
						$datos['fecha_creacion']=date("Y-m-d");
						$datos['id_clinica']=$clinica['clinicas'];
						$datos['activo']=0;
						$this->usuario_model->insert_pacientes($datos);
						//redirect(base_url('agenda/#pacientes'));
					}




					$data['comunas']=$this->usuario_model->get_comunas_mias();
					$data['regiones']=$this->usuario_model->get_regiones_mias();
					$data['provincia']=$this->usuario_model->get_provincias_mias();
					$data['previsiones']=$this->usuario_model->get_previsiones($login['id_clinica']);



					
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'Usuario/scripts.php';
					$data['grupos']=$this->usuario_model->get_grupos();	
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);


					
					$this->load->view("usuario/pacientes/agregar_pacientes", $data);
			}
		}

	/*
		metodo para cambiar status pacientes
		metodo agregado
	*/
	public function status_paciente(){
		if (!$this->session->has_userdata('autenticado')) {
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
		} else {
			$login=$this->session->userdata('autenticado');//variable de session del usuario
			$clinicas=$this->session->userdata('clinics');//variable de session de la clinica
			$datos=array();
			$id_paciente=$_POST['id_paciente'];
			if ($_POST['activar']==1) {
				$datos['activo']=1;
			} else {
				$datos['activo']=0;
			}
			$this->usuario_model->update_paciente($datos,$id_paciente);	
		}
	}


		
	/*
		metodo para eliminar pacientes pacientes
		a las clinicas
	*/
	public function eliminar_paciente(){
		if (!$this->session->has_userdata('autenticado')) {
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		} else {
			$datos=array();
			$datos['activo']=2;
			$this->usuario_model->update_paciente($datos,$_POST['id_paciente']);
			//$this->usuario_model->eliminar_paciente();
		}
	}


		/*
		metodo para editar pacientes
		a las clinicas
	*/
		
	public function editar_paciente(){
		
			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}
			else{
					$login=$this->session->userdata('autenticado');
					$clinica=$this->session->userdata('clinica');
					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);


					//aqui va 

					$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidopat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidomat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('rut', 'porfavor ingrese su Rut', 'required');
					//$this->form_validation->set_rules('dir', 'porfavor ingrese su Direción', 'required');
					$this->form_validation->set_rules('cel', 'porfavor ingrese su Numero de Celular', 'required');
					//$this->form_validation->set_rules('tel', 'porfavor ingrese su Numero de Telefonico', 'required');
					//$this->form_validation->set_rules('email', 'porfavor ingrese su email', 'required');
					$this->form_validation->set_rules('tfecha', 'porfavor ingrese su Fecha de Nacimiento', 'required');
					//$this->form_validation->set_rules('prof', 'porfavor ingrese su Profesión', 'required');
					$this->form_validation->set_rules('sexo', 'porfavor ingrese su Sexo', 'required');
					$this->form_validation->set_rules('prevision', 'porfavor ingrese su Previsión', 'required');
					//$this->form_validation->set_rules('region', 'porfavor ingrese su Región', 'required');
					/*$this->form_validation->set_rules('comuna', 'porfavor ingrese su Comuna', 'required');		
					
					$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');*/
					//$this->form_validation->set_rules('ciudad', 'porfavor ingrese su Ciudad', 'required');
					//$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');
					

					if ($this->form_validation->run() == false) {
				
							/*echo "falso";
							*die();*/

					}

					else{
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellidopat");
						$datos['apellido_materno']=$this->input->post("apellidomat");
						$datos['rut_otro']=$this->input->post("rut");
						$datos['direccion']=$this->input->post("dir");
						$datos['celular']=$this->input->post("cel");
						$datos['telefono']=$this->input->post("tel");
						$datos['email']=$this->input->post("email");
						$datos['fecha_nacimiento']=$this->input->post("tfecha");
						$datos['profesion']=$this->input->post("prof");
						$datos['sexo']=$this->input->post("sexo");
						$datos['prevision']=$this->input->post("prevision");
						$datos['region']=$this->input->post("region");
						$datos['comuna']=$this->input->post("comuna");
						$datos['ciudad']=$this->input->post("ciudad");
						$datos['provincia']=$this->input->post("prov");
						$datos['fecha_modificacion']=date("Y-m-d");
						$datos['id_usr_modifico']=$login['user_id'];





						if (!empty($_FILES['tarch']['name'])) {
											
							$config['upload_path'] =RUTA_PACIENTES;
							$config['allowed_types'] = 'gif|jpg|png|';		
							$config['max_size']    = '20000'; // 20Mb
							$new_name =$_FILES['tarch']['name'];
							$config['file_name'] = $new_name;
											
							$this->upload->initialize($config);

							if ($this->upload->do_upload('tarch'))
							{
											

								$file_data = $this->upload->data();
								$file_path =$file_data['file_name'];
								
								
							
						
									
								$datos['foto']=$file_path;
							
								
							 }


							 $datos['nombre']=$this->input->post("nombre");
								$datos['apellido_paterno']=$this->input->post("apellidopat");
								$datos['apellido_materno']=$this->input->post("apellidomat");
								$datos['rut_otro']=$this->input->post("rut");
								$datos['direccion']=$this->input->post("dir");
								$datos['celular']=$this->input->post("cel");
								$datos['telefono']=$this->input->post("tel");
								$datos['email']=$this->input->post("email");
								$datos['sexo']=$this->input->post("sexo");
								$datos['fecha_nacimiento']=$this->input->post("tfecha");
								$datos['profesion']=$this->input->post("prof");
								$datos['comuna']=$this->input->post("comuna");
								$datos['region']=$this->input->post("region");
								$datos['prevision']=$this->input->post("prevision");
								$datos['ciudad']=$this->input->post("ciudad");
								$datos['provincia']=$this->input->post("prov");
								$datos['fecha_modificacion']=date("Y-m-d");
								$datos['id_usr_modifico']=$login['user_id'];
							
											
						 }

						

						
						$this->usuario_model->update_paciente($datos,$_POST['id_paciente']);


						//redirect(base_url('Usuario/editar_paciente').'/'.$id_paciente);

						

					}





					$data['paciente']=$this->usuario_model->get_paciente($_POST['id_paciente']);
					$data['previsiones']=$this->usuario_model->get_previsiones($login['id_clinica']);
					$data['comunas']=$this->usuario_model->get_comunas_mias();
					$data['regiones']=$this->usuario_model->get_regiones_mias();
					$data['provincia']=$this->usuario_model->get_provincias_mias();
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'usuario/scripts.php';
					$data['grupos']=$this->usuario_model->get_grupos();	
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					
					//$data['header'] = 'inc/header';
					//$data['lateral'] = 'inc/lateral';
					//$data['navbar'] = 'inc/navbar';
					//$data['footer'] = 'inc/footer';
					//$data['titulo'] = 'login';
					//$data['info']=$login;

					//$data['pagina_interna'] = 'usuario/pacientes/editar_pacientes';
					//$data['titulo'] = 'login';
					//$this->load->view($this->_plantilla_admin, $data);
					$this->load->view("Usuario/pacientes/editar_pacientes",$data);
			}

		}
		
		/*
		metodo para ver  pacientes
		a las clinicas
	*/
		public function ver_paciente(){
			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			} else {
					$login=$this->session->userdata('autenticado');
					$clinica=$this->session->userdata('clinica');
					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);


					//aqui va 

					$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidopat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidomat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('rut', 'porfavor ingrese su Rut', 'required');
					//$this->form_validation->set_rules('dir', 'porfavor ingrese su Direción', 'required');
					$this->form_validation->set_rules('cel', 'porfavor ingrese su Numero de Celular', 'required');
					//$this->form_validation->set_rules('tel', 'porfavor ingrese su Numero de Telefonico', 'required');
					//$this->form_validation->set_rules('email', 'porfavor ingrese su email', 'required');
					$this->form_validation->set_rules('tfecha', 'porfavor ingrese su Fecha de Nacimiento', 'required');
					//$this->form_validation->set_rules('prof', 'porfavor ingrese su Profesión', 'required');
					$this->form_validation->set_rules('sexo', 'porfavor ingrese su Sexo', 'required');
					$this->form_validation->set_rules('prevision', 'porfavor ingrese su Previsión', 'required');
					//$this->form_validation->set_rules('region', 'porfavor ingrese su Región', 'required');
					/*$this->form_validation->set_rules('comuna', 'porfavor ingrese su Comuna', 'required');		
					
					$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');*/
					//$this->form_validation->set_rules('ciudad', 'porfavor ingrese su Ciudad', 'required');
					//$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');
					

					if ($this->form_validation->run() == false) {
				
							/*echo "falso";
							*die();*/

					}

					else{
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellidopat");
						$datos['apellido_materno']=$this->input->post("apellidomat");
						$datos['rut_otro']=$this->input->post("rut");
						$datos['direccion']=$this->input->post("dir");
						$datos['celular']=$this->input->post("cel");
						$datos['telefono']=$this->input->post("tel");
						$datos['email']=$this->input->post("email");
						$datos['fecha_nacimiento']=$this->input->post("tfecha");
						$datos['profesion']=$this->input->post("prof");
						$datos['sexo']=$this->input->post("sexo");
						$datos['prevision']=$this->input->post("prevision");
						$datos['region']=$this->input->post("region");
						$datos['comuna']=$this->input->post("comuna");
						$datos['ciudad']=$this->input->post("ciudad");
						$datos['provincia']=$this->input->post("prov");
						$datos['fecha_modificacion']=date("Y-m-d");
						$datos['id_usr_modifico']=$login['user_id'];





						if (!empty($_FILES['tarch']['name'])) {
											
							$config['upload_path'] =RUTA_PACIENTES;
							$config['allowed_types'] = 'gif|jpg|png|';		
							$config['max_size']    = '20000'; // 20Mb
							$new_name =$_FILES['tarch']['name'];
							$config['file_name'] = $new_name;
											
							$this->upload->initialize($config);

							if ($this->upload->do_upload('tarch'))
							{
											

								$file_data = $this->upload->data();
								$file_path =$file_data['file_name'];
								
								$datos['nombre']=$this->input->post("nombre");
								$datos['apellido_paterno']=$this->input->post("apellidopat");
								$datos['apellido_materno']=$this->input->post("apellidomat");
								$datos['rut_otro']=$this->input->post("rut");
								$datos['direccion']=$this->input->post("dir");
								$datos['celular']=$this->input->post("cel");
								$datos['telefono']=$this->input->post("tel");
								$datos['email']=$this->input->post("email");
								$datos['sexo']=$this->input->post("sexo");
								$datos['fecha_nacimiento']=$this->input->post("tfecha");
								$datos['profesion']=$this->input->post("prof");
								$datos['comuna']=$this->input->post("comuna");
								$datos['region']=$this->input->post("region");
								$datos['prevision']=$this->input->post("prevision");
								$datos['ciudad']=$this->input->post("ciudad");
								$datos['provincia']=$this->input->post("prov");
								$datos['fecha_modificacion']=date("Y-m-d");
								$datos['id_usr_modifico']=$login['user_id'];
							
						
									
								$datos['foto']=$file_path;
							

							 }
							 else{
											 
								$data['error']="La Convocatoria no se registro ";

								$data['messege']="El archivo"."  ".$_FILES['tarch']['name']."  "."no se subió correctamente ";

											
											 
								}

											
						 }

						

						
						$this->usuario_model->update_paciente($datos,$_POST['id_paciente']);


						redirect(base_url('usuario/ver_pacientes').'/'.$_POST['id_paciente']);

						

					}





					$data['paciente']=$this->usuario_model->get_paciente($_POST['id_paciente']);

					
					
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'usuario/scripts.php';
					$data['grupos']=$this->usuario_model->get_grupos();	
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					
					//$data['header'] = 'inc/header';
					//$data['lateral'] = 'inc/lateral';
					//$data['navbar'] = 'inc/navbar';
					//$data['footer'] = 'inc/footer';
					//$data['titulo'] = 'login';
					//$data['info']=$login;

					//$data['pagina_interna'] = 'usuario/pacientes/editar_pacientes';
					//$data['titulo'] = 'login';
					//$this->load->view($this->_plantilla_admin, $data);
					$this->load->view("usuario/pacientes/ver_pacientes",$data);
			}

		}


		/*
		Despliega la informacion de la clinica 
		que estas enrolado
	*/

		
		function informa_clinica(){

			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			}
			else{
					$login=$this->session->userdata('autenticado');
					$clinicas=$this->session->userdata('clinics');
					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);


					$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('dir', 'porfavor ingrese la dirección', 'required');
					$this->form_validation->set_rules('tel', 'porfavor ingrese telefono', 'required');
					$this->form_validation->set_rules('fax', 'porfavor ingrese fax', 'required');
					$this->form_validation->set_rules('email', 'porfavor ingrese correo', 'required');
					$this->form_validation->set_rules('tenant', 'porfavor ingrese tenant', 'required');
					$this->form_validation->set_rules('region', 'porfavor ingrese region', 'required');
					$this->form_validation->set_rules('comuna', 'porfavor ingrese su Comuna', 'required');		
					$this->form_validation->set_rules('ciudad', 'porfavor ingrese su Ciudad', 'required');
					$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');


					if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

					}
					else{
							$login=$this->session->userdata('autenticado');
							$clinica=$this->session->userdata('clinica');
							//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
							$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);



							if ($this->form_validation->run() == false) {
				
							//echo "falso";

							}
							else{

									$datos['nombre']=$this->input->post("nombre");
									$datos['telefono']=$this->input->post("tel");
									$datos['fax']=$this->input->post("fax");
									$datos['direccion']=$this->input->post("dir");
									$datos['correo']=$this->input->post("email");
									$datos['tenant']=$this->input->post("tenant");
									$datos['region']=$this->input->post("region");
									$datos['comuna']=$this->input->post("comuna");
									$datos['ciudad']=$this->input->post("ciudad");
									$datos['providencia']=$this->input->post("prov");

								

									if (isset($datos) and is_array($datos)) {
										# code...

										$this->usuario_model->editar($datos,$clinicas['clinicas']);

									}

							}

					
							

						}
					

					$data['pacientes']=$this->usuario_model->get_pacientes($clinicas['clinicas']);

					
					$data['informa']=$this->usuario_model->get_clinica_info($clinicas['clinicas']);


					
					
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'usuario/scripts.php';
					$data['grupos']=$this->usuario_model->get_grupos();	


					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['header'] = 'inc/header';
					$data['lateral'] = 'inc/lateral';
					$data['navbar'] = 'inc/navbar';
					$data['footer'] = 'inc/footer';
					$data['titulo'] = 'login';
					$data['info']=$login;
					$data['pagina_interna'] = 'usuario/clinicas/clinica_info';
					$this->load->view($this->_plantilla_admin, $data);
			}

		}


		

		/*
		Despliega los usuarios
	*/

		function Usuarios(){


			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			} else {
						$login=$this->session->userdata('autenticado');

						$clinicas=$this->session->userdata('clinics');
						//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
						$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);



						$data['usuarios']=$this->usuario_model->get_usuarios($clinicas['clinicas']);

						$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
						//$data['header'] = 'inc/header';
						//$data['lateral'] = 'inc/lateral';
						//$data['navbar'] = 'inc/navbar';
						//$data['footer'] = 'inc/footer';
						$data['titulo'] = 'login';
						$data['info']=$login;
						
						//$data['titulo'] = 'login';
						$this->load->view('usuario/usuarios/usuarios', $data);
						
			}

					
				
		}



		function elimina_usuario()
		{
			if (!$this->session->has_userdata('autenticado')) {
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
			} else {
				$datos=array();
				$datos['activo']=2;
				$id = $_POST['id'];
				$this->usuario_model->update_usuario($datos,$id);
				//$this->usuario_model->eliminar_paciente();
				
				
			}
		}
		

		/*
			CRUD DE USUARIOS METODO EDITAR
		*/
		function editar_usuario($id_paciente){


			if (!$this->session->has_userdata('autenticado')) {
				# code...
					$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());

			} else {
					$login=$this->session->userdata('autenticado');
					$clinica=$this->session->userdata('clinica');
					//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);


					//aqui va 

					$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidopat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('apellidomat', 'porfavor ingrese su nombre', 'required');
					$this->form_validation->set_rules('email', 'porfavor ingrese su correo', 'required');
					$this->form_validation->set_rules('pass', 'porfavor ingrese su Contraseña');
					$this->form_validation->set_rules('grupo', 'porfavor ingrese Estado del Usuario', 'required');
					
					$this->form_validation->set_rules('estado', 'porfavor ingrese Estado del Usuario', 'required');
					

					if ($this->form_validation->run() == false) {
				
							//echo "falso";

					} else {
						
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellidopat");
						$datos['apellido_materno']=$this->input->post("apellidomat");

						$datos['activo']=$this->input->post("estado");

						if ($this->input->post("pass")!=null) {
							# code...
							$datos['contrasena']=md5($this->input->post("pass"));
						}
						
						$datos['id_grupo']=$this->input->post("grupo");



						$this->usuario_model->update_usuario($datos,$id_paciente);


						redirect(base_url('Usuario/editar_usuario').'/'.$id_paciente);
						

					}





					$data['usuario']=$this->usuario_model->get_user($id_paciente);

					$data['usuarios']=$this->usuario_model->get_user_all($id_paciente);
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					$data['scripts'] = 'usuario/scripts.php';
					$data['grupos']=$this->usuario_model->get_grupos();	


					$data['header'] = 'inc/header';
					$data['lateral'] = 'inc/lateral';
					$data['navbar'] = 'inc/navbar';
					$data['footer'] = 'inc/footer';
					$data['titulo'] = 'login';
					$data['info']=$login;

					$data['pagina_interna'] = 'usuario/usuarios/editar_usuario';
					$data['titulo'] = 'login';
					$this->load->view($this->_plantilla_admin, $data);
			}

		}




		




		
	/*
		CRUD DE MEDICAMENTOS
	*/
    function medicinas(){
		if (!$this->session->has_userdata('autenticado')) {
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		} else {
			$login=$this->session->userdata('autenticado');
			$clinicas=$this->session->userdata('clinics');
			$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
			$data['medicinas']=$this->usuario_model->get_medicamentos($clinicas['clinicas']);
			$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
			//$data['header'] = 'inc/header';
			//$data['lateral'] = 'inc/lateral';
			//$data['navbar'] = 'inc/navbar';
			//$data['footer'] = 'inc/footer';
			//$data['titulo'] = 'Medicinas';
			//$data['info']=$login;
			//$data['pagina_interna'] = 'usuario/medicina/medicinas';
			//$data['titulo'] = 'login';
			//$this->load->view($this->_plantilla_admin, $data);
			$this->load->view('usuario/medicina/medicinas',$data); 
		}	
	}


	/*
		CRUD DE MEDICAMENTOS METODO AGREGAR
	*/
	function agregar_medicamentos_medico(){
		if (!$this->session->has_userdata('autenticado')) {
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		} else {
			$login=$this->session->userdata('autenticado');
			$clinicas=$this->session->userdata('clinics');
			$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
			$datos['codigo']= random_int(00001, 99999);
			$datos['nombre']=$_POST['nombre_medicamento'];
			$datos['nombre_fisticio']=$_POST['nombre_fisticio'];
			$datos['concentracion']=$_POST['concentracion'];
			$datos['presentacion']=$_POST['presentacion'];
			$datos['estado']=1;
			$datos['id_clinica']=$clinicas['clinicas'];
			$this->usuario_model->insert_medicamentos($datos);
			//redirect('agenda/#medicamentos');
		}
	}
	
	function agregar_medicamentos(){
		if (!$this->session->has_userdata('autenticado')) {
			# code...
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		} else {
			$login=$this->session->userdata('autenticado');
			$clinicas=$this->session->userdata('clinics');
			$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
			$this->form_validation->set_rules('nombre_medicamento', 'porfavor ingrese nombre del medicamento', 'required');
			$this->form_validation->set_rules('nombre_fisticio', 'porfavor ingrese nombre del medicamento', 'required');
			$this->form_validation->set_rules('concentracion', 'porfavor ingrese presentación', 'required');
			$this->form_validation->set_rules('presentacion', 'porfavor ingrese concentracion', 'required');

			if ($this->form_validation->run() == false) {
				//echo "falso";
			} else {
				$datos['codigo']= random_int(00001, 99999);
				$datos['nombre']=$_POST['nombre_medicamento'];
				$datos['nombre_fisticio']=$_POST['nombre_fisticio'];
				$datos['concentracion']=$_POST['concentracion'];
				$datos['presentacion']=$_POST['presentacion'];
				$datos['via_admon']=$_POST["via_admon"];
				$datos['estado']=1;
				$datos['id_clinica']=$clinicas['clinicas'];
				$this->usuario_model->insert_medicamentos($datos);
				redirect('agenda/#medicamentos');
		}
			$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
			//$data['header'] = 'inc/header';
			//$data['lateral'] = 'inc/lateral';
			//$data['navbar'] = 'inc/navbar';
			//$data['footer'] = 'inc/footer';
			//$data['titulo'] = 'login';
			$data['info']=$login;
			
			//$data['pagina_interna'] = 'usuario/medicina/agregar_medicina';
			//$data['titulo'] = 'login';
			//$this->load->view($this->_plantilla_admin, $data);
			$this->load->view('usuario/medicina/agregar_medicina', $data);
			
		}
	}


	/*
		CRUD DE MEDICAMENTOS METODO ELIMINAR
	*/

	function eliminar_medicina(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		} else {
			 $this->usuario_model->eliminar_medicina($_POST['id_medicamento']);
			
			 redirect('agenda/#medicamentos');
		}

	}


	/*
		CRUD DE MEDICAMENTOS METODO ELIMINAR
	*/

	function editar_medicamentos(){
		if (!$this->session->has_userdata('autenticado')) {
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		} else {
			$login=$this->session->userdata('autenticado');
			$clinicas=$this->session->userdata('clinics');
			$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);
			
			$this->form_validation->set_rules('codigo', 'porfavor ingrese el código del medicamento', 'required');
			$this->form_validation->set_rules('nombre_medicamento', 'porfavor ingrese nombre del medicamento', 'required');
			$this->form_validation->set_rules('nombre_fisticio', 'porfavor ingrese nombre del medicamento', 'required');
			$this->form_validation->set_rules('concentracion', 'porfavor ingrese presentación', 'required');
			$this->form_validation->set_rules('presentacion', 'porfavor ingrese concentracion', 'required');

			if ($this->form_validation->run() == false) {
				//echo "falso";
			} else {
				$datos['codigo']=$this->input->post("codigo");
				$datos['nombre']=$this->input->post("nombre_medicamento");
				$datos['nombre_fisticio']=$this->input->post("nombre_fisticio");
				$datos['concentracion']=$this->input->post("concentracion");
				$datos['presentacion']=$this->input->post("presentacion");
				$datos['via_admon']=$this->input->post("via_admon");
				$datos['estado']=$this->input->post("estado");
				$datos['id_clinica']=$clinicas['clinicas'];
				$this->usuario_model->update_medicina($datos, $this->input->post("id_medicamento"));
				
				redirect('agenda/#medicamentos');
				//redirect(base_url('Usuario/editar_medicamentos').'/'.$id_medicina);
			}


						
			$data['medicamento']=$this->usuario_model->get_medicina($_POST['id_medicamento']);
			$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
			//$data['header'] = 'inc/header';
			//$data['lateral'] = 'inc/lateral';
			//$data['navbar'] = 'inc/navbar';
			//$data['footer'] = 'inc/footer';
			//$data['titulo'] = 'login';
			$data['info']=$login;
			
			//$data['pagina_interna'] = 'usuario/medicina/editar_medicina';
			//$data['titulo'] = 'login';
			//$this->load->view($this->_plantilla_admin, $data);
			$this->load->view('usuario/medicina/editar_medicina', $data);


		}

	}

	/*
		CRUD DE PERMISOS AUN NO FUNCIONAN
	*/


	function permisos(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');

				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	
				//$data['grupo_clinica']=$this->usuario_model->get_grupos_by_clinica($clinicas['clinicas']);




				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['info']=$login;
				$data['pagina_interna'] = 'usuario/permisos/grupos';
				$this->load->view($this->_plantilla_admin, $data);

				
				
		}

	}

	function eliminar_permiso($id){
		if (!$this->session->has_userdata('autenticado')) {
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		}
		else{
			 $this->usuario_model->adm_eliminar_grupo($id);
			 redirect('Usuario/permisos');
		}
	}



	/*function agregar_permiso(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');

				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	


					$this->form_validation->set_rules('grupo', 'Verificado','required');

						if($this->form_validation->run()){
							$datos1['nombre_grupo']=$this->input->post('grupo');

							$bander=false;


							$datos['grupo_usuario']=$this->input->post('grupo');
							
							$datos['is_visualiza']=0;
						    $datos['is_edita']=0;
						    $datos['is_elimina']=0;
						    $datos['is_crear']=0;


							if (isset($_POST['select1_in']) and isset($_POST['select2_in']) and isset($_POST['select3_in']) and isset($_POST['select4_in']) ){

						    	$datos['is_visualiza']=1;
						    	$datos['is_edita']=1;
						    	$datos['is_elimina']=1;
						    	$datos['is_crear']=1;
						    	$datos['modulo']="Inicio";
						    	

						    	 $this->usuario_model->insertar_permiso($datos);

						    }
						

						    	$datos['modulo']="Inicio";

							    		if (isset($_POST['select1_in'])) {
							     	# code...
							     	$datos['is_crear']=1;
							     
							     
							     	//$datos['modulo']="Inicio";
							     	//$this->usuario_model->insertar_permiso($datos);
							     	
							     } 


							      if (isset($_POST['select2_in'])) {
							     	# code...
							     	
							     	$datos['is_edita']=1;
							     
							   
							     	//$datos['modulo']="Inicio";
							     	// $this->usuario_model->insertar_permiso($datos);
							     	
							     } 


							     if (isset($_POST['select3_in'])) {
							     	# code...
							     	
							     	$datos['is_visualiza']=1;
							     	
							     	//$datos['modulo']="Inicio";
							     	// $this->usuario_model->insertar_permiso($datos);
							     				     	
							     } 

							     if (isset($_POST['select4_in'])) {
							     	# code...
							     	
							     	$datos['is_elimina']=1;
							     	
							     	
							     	//$datos['modulo']="Inicio";
							     	// $this->usuario_model->insertar_permiso($datos);

							     }

							     $this->usuario_model->insertar_permiso($datos);
							    


						    








							if (isset($_POST['select1_pa']) and isset($_POST['select2_pa']) and isset($_POST['select3_pa']) and isset($_POST['select4_pa']) ){

						    	$datos['is_visualiza']=1;
						    	$datos['is_edita']=1;
						    	$datos['is_elimina']=1;
						    	$datos['is_crear']=1;
						    	$datos['modulo']="Pacientes";
						    	


						    	 $this->usuario_model->insertar_permiso($datos);

						    }
						    else{

						    	$datos['modulo']="Pacientes";

							    		if (isset($_POST['select1_pa'])) {
							     	# code...
							     	$datos['is_crear']=1;
							     	
							     
							     	//$datos['modulo']="Inicio";
							     	//$this->usuario_model->insertar_permiso($datos);
							     	
							     } 


							      if (isset($_POST['select2_pa'])) {
							     	# code...
							     	
							     	$datos['is_edita']=1;
							     	
							   
							     	//$datos['modulo']="Inicio";
							     	// $this->usuario_model->insertar_permiso($datos);
							     	
							     } 


							     if (isset($_POST['select3_pa'])) {
							     	# code...
							     	
							     	$datos['is_visualiza']=1;
							     	
							     	
							     	//$datos['modulo']="Inicio";
							     	// $this->usuario_model->insertar_permiso($datos);
							     				     	
							     } 

							     if (isset($_POST['select4_pa'])) {
							     	# code...
							     	
							     	$datos['is_elimina']=1;
							     	
							     	
							     	//$datos['modulo']="Inicio";
							     	// $this->usuario_model->insertar_permiso($datos);

							     }

							     $this->usuario_model->insertar_permiso($datos);
							    


						    }





						    	
						  
						    
						     

						     //$this->usuario_model->insert_grup($datos);
							

						}




				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['info']=$login;
				$data['scripts']='usuario/permisos/scripts';
				$data['pagina_interna'] = 'usuario/permisos/agregar_permisos';
				$this->load->view($this->_plantilla_admin, $data);

				
				
		}

	}

	


	


	function editar_permiso(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');

				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	


					$this->form_validation->set_rules('grupo', 'Verificado','required');


					



				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['info']=$login;
				$data['scripts']='usuario/permisos/scripts';
				$data['pagina_interna'] = 'usuario/permisos/editar_permisos';
				$this->load->view($this->_plantilla_admin, $data);

				
				
		}

	}*/


	/*
		CRUD DE PERMISOS AUN NO FUNCIONA
	*/


	function agregar_grupo(){
		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
					$clinicas=$this->session->userdata('clinics');
					

				$this->form_validation->set_rules('grupo', 'Verificado','required');

				if($this->form_validation->run()){
						$datos['nombre_grupo']=$this->input->post('grupo');
						
						//var_dump($datos);
						$this->usuario_model->insert_grup($datos);
						

				}
				else{
					die();
				}

				redirect(base_url("Usuario/permisos"));
		}
	}


	/*
		CRUD DE PERMISO AUN NO FUNCIONA
	*/
	function editar_grupo(){
		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
					$clinicas=$this->session->userdata('clinics');
					

				$this->form_validation->set_rules('grupo', 'Verificado','required');

				if($this->form_validation->run()){

						$grupo_id=$this->input->post('id_grupo');
						$datos['nombre_grupo']=$this->input->post('grupo');
						//$datos['id_clinica']=$clinicas['clinicas'];
						
						
						$this->usuario_model->update_grupo($grupo_id,$datos);

						

				}
				else{
					die();
				}

				redirect(base_url("Usuario/permisos"));
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

				redirect(base_url('Usuario/clinicas'));

			
		}
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['info']=$login;
				$data['user_id']=$login['user_id'];
				$data['scripts'] = 'usuario/scripts.php';
				$data['clinicas']=$this->usuario_model->get_clinicas();			
				$this->load->view("inc/header2",$data); 


					 	 $this->load->view("inc/navbar",$data); 

					    //include('inc/navbar.php');
					   	$this->load->view("inc/footer"); 
					   	$this->load->view("usuario/sin_clinica",$data);

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
				$data['scripts'] = 'usuario/scripts.php';
				$data['nombre_clinica']=$this->publico_model->get_clinica($login['id_clinica']);



				$this->load->view("inc/header2",$data); 


				$this->load->view("inc/navbar",$data); 

					    //include('inc/navbar.php');
				$this->load->view("inc/footer"); 
			 	$this->load->view("usuario/clinicas",$data); 
		}

	

	}


	/*
	DESPLIEGA LAS CONSULTAS DEL DIA 
	*/
	function consultas(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());
		} else {
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['info']=$login;
				$data['clinicas']=$this->usuario_model->adm_clinicas();
				//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);
				$data['consultas']=$this->usuario_model->get_consultas($login['user_id'],$clinica['clinicas']);

				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['scripts'] = 'usuario/scripts.php';
				//$this->load->view("inc/header",$data); 
				//$this->load->view("inc/navbar",$data); 
				//$this->load->view("inc/lateral",$data); 
				//include('inc/navbar.php');
				//$this->load->view("inc/footer"); 
			$this->load->view("usuario/consultas/consultas",$data); 
		}
	}


	//crud de agenda


	/*
	DESPLIEGA LAS CITAS DEL DIA 
	*/

	function citas(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				//$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);
				$data['info']=$login;
				$data['presentacion']=$this->usuario_model->get_prestacion();
				$data['doctores']=$this->usuario_model->get_doctores($clinica['clinicas']);
				$data['pacientes']=$this->usuario_model->get_pacientes($clinica['clinicas']);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);

				

				//$data['clinicas']=$this->usuario_model->adm_clinicas();
				//$data['consultas']=$this->usuario_model->get_consultas($login['user_id'],$clinica['clinicas']);

				
				//$data['scripts'] = 'usuario/scripts.php';
				//$this->load->view("inc/header",$data); 


				//$this->load->view("inc/navbar",$data); 

				//$this->load->view("inc/lateral",$data); 

					    //include('inc/navbar.php');
				//$this->load->view("inc/footer"); 
			 	$this->load->view("usuario/citas/citas",$data); 
		}

	}

	/* NO FUNCIONA*/
	function agenda(){
		if (!$this->session->has_userdata('autenticado')) {
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
		} else {
			$login=$this->session->userdata('autenticado');
			$clinica=$this->session->userdata('clinics');
			$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);
			$this->form_validation->set_rules('docs', 'Verificado','required');
			if ( $this->form_validation->run() == false ) {
					//echo "falso";
			} else {
				$doc=$this->input->post("docs");
				$fecha=date("d")."-".date("m")."-".date("Y");
				$data['pendientes']=$this->usuario_model->adm_consultas_pendientes($doc,$fecha);
				$data['espera']=$this->usuario_model->adm_consultas_espera($doc,$fecha);
				$data['consulta']=$this->usuario_model->adm_consultas_consulta($doc,$fecha);
				$data['cancelada']=$this->usuario_model->adm_consultas_cancelada($doc,$fecha);
				$data['finalizada']=$this->usuario_model->adm_consultas_finalizada($doc,$fecha);
			}
			$data['info']=$login;
			$clinica=$this->session->userdata('clinics');
			$data['doctores']=$this->usuario_model->get_doctores($clinica['clinicas']);
			$this->load->view("usuario/agenda/agenda",$data); 
		}
	}



	/*
	DESPLIEGA LAS CLINICAS REGISTRADAS
	*/

	function adm_clinicas(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['info']=$login;
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['clinicas']=$this->usuario_model->adm_clinicas();
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['scripts'] = 'usuario/scripts.php';

				
				$this->load->view("inc/header",$data); 


				$this->load->view("inc/navbar",$data); 

				$this->load->view("inc/lateral",$data); 

					    //include('inc/navbar.php');
				$this->load->view("inc/footer"); 
			 	$this->load->view("usuario/clinicas/clinicas",$data); 
		}
	
	}

	/*
	DESPLIEGA LOS HORARIOS DE LOS MEDICOS 
	SOLO PARA PERFIL DE ENFERMERAS
	*/
	function horarios(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		} else {
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['info']=$login;
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['clinicas']=$this->usuario_model->adm_clinicas();
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['doctores']=$this->usuario_model->get_clinica_doc($login['id_clinica']);
				$data['horarios']= $this->usuario_model->get_horarios();
				$data['scripts'] = 'usuario/scripts.php';

				# code...

					if (isset($_POST['id_medico']) and isset($_POST['descanzo_semana']) and isset($_POST['hora_fin']) and 
						isset($_POST['hora_inicio'])
						) {
						# code...

							$datos= array();

							$datos['id_medico']=$_POST['id_medico'];
							$datos['descanzo_semana']=$_POST['descanzo_semana'];
							$datos['hora_inicio']=$_POST['hora_inicio'];
							$datos['hora_fin']=$_POST['hora_fin'];

						//if (isset($datos)and is_array($datos) and count($datos)>0) {
							# code...
							$this->usuario_model->insert_horarios($datos);
						//}
					}

					
			

				$this->load->view("inc/header",$data); 


				$this->load->view("inc/navbar",$data); 

				$this->load->view("inc/lateral",$data); 

					    //include('inc/navbar.php');
				$this->load->view("inc/footer"); 
			 	$this->load->view("usuario/horarios/horarios",$data); 
		}
	
	}


	/*
	METODO PARA AGREGAR CLINICAS SOLO 
	PERFIL DE ADMIN Y MAESTRO
	*/

	function adm_agregar_clinica(){

		
		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinics');
				$data['info']=$login;
				//$data['clinicas']=$this->usuario_model->adm_clinicas();
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['scripts'] = 'usuario/scripts.php';

				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$this->load->view("inc/header",$data); 


				$this->load->view("inc/navbar",$data); 

				$this->load->view("inc/lateral",$data); 

					    //include('inc/navbar.php');
				$this->load->view("inc/footer"); 
			 	$this->load->view("usuario/clinicas/clinica_agregar",$data); 
		}

	}

	/*
	METODO PARA ELIMINAR CLINICAS SOLO 
	PERFIL DE ADMIN Y MAESTRO
	*/

	function adm_eliminar_clinica($id_clinica){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
			 $this->usuario_model->adm_eliminar_clinica($id_clinica);

			
			 redirect('Usuario/adm_clinicas');
		}

	}



	/*
	METODO PARA EDITAR CLINICAS SOLO 
	PERFIL DE ADMIN Y MAESTRO
	*/


	function adm_editar_clinica($id_clinica){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				$login=$this->session->userdata('autenticado');
				$clinicas=$this->session->userdata('clinics');


				$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
				$this->form_validation->set_rules('dir', 'porfavor ingrese la dirección', 'required');
				$this->form_validation->set_rules('tel', 'porfavor ingrese telefono', 'required');
				$this->form_validation->set_rules('fax', 'porfavor ingrese fax', 'required');
				$this->form_validation->set_rules('email', 'porfavor ingrese correo', 'required');
				$this->form_validation->set_rules('tenant', 'porfavor ingrese tenant', 'required');
				$this->form_validation->set_rules('region', 'porfavor ingrese region', 'required');
				$this->form_validation->set_rules('comuna', 'porfavor ingrese su Comuna', 'required');		
				$this->form_validation->set_rules('ciudad', 'porfavor ingrese su Ciudad', 'required');
				$this->form_validation->set_rules('prov', 'porfavor ingrese su Provincia', 'required');


				if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

				}
				else{
						$login=$this->session->userdata('autenticado');
						$clinica=$this->session->userdata('clinica');



						if ($this->form_validation->run() == false) {
			
						//echo "falso";

						}
						else{


								$datos['nombre']=$this->input->post("nombre");
								$datos['telefono']=$this->input->post("tel");
								$datos['fax']=$this->input->post("fax");
								$datos['direccion']=$this->input->post("dir");
								$datos['correo']=$this->input->post("email");
								$datos['tenant']=$this->input->post("tenant");
								$datos['region']=$this->input->post("region");
								$datos['comuna']=$this->input->post("comuna");
								$datos['ciudad']=$this->input->post("ciudad");
								$datos['providencia']=$this->input->post("prov");

							

								if (isset($datos) and is_array($datos)) {
									# code...

									$this->usuario_model->editar($datos,$id_clinica);

									redirect(base_url('Usuario/adm_clinicas'));

								}

						}

				
						

					}


				$data['pacientes']=$this->usuario_model->get_pacientes($clinicas['clinicas']);

				
				$data['informa']=$this->usuario_model->get_clinica_info($id_clinica);


				
				
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['scripts'] = 'usuario/scripts.php';
				$data['grupos']=$this->usuario_model->get_grupos();	

				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);

				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['info']=$login;
				$data['pagina_interna'] = 'usuario/clinicas/clinica_editar';
				$this->load->view($this->_plantilla_admin, $data);
		}

	}

	/*
	METODO PARA EDITAR PACIENTE
	*/

	function adm_edit_paciente(){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{

				$login=$this->session->userdata('autenticado');
				$clinica=$this->session->userdata('clinica');

				$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
				
				if ($this->form_validation->run() == false) {
			
						echo "falso";
						die();

				}

				else{
					$datos['rut_otro']=$this->input->post("rut");
					$datos['nombre']=$this->input->post("nombre");
					$datos['apellido_paterno']=$this->input->post("apellidopat");
					$datos['apellido_materno']=$this->input->post("apellidomat");
					$datos['direccion']=$this->input->post("dir");
					$datos['celular']=$this->input->post("cel");
					$datos['telefono']=$this->input->post("tel");
					$datos['email']=$this->input->post("email");
					$datos['sexo']=$this->input->post("sexo");
					$datos['fecha_nacimiento']=$this->input->post("tfecha");
					$datos['profesion']=$this->input->post("prof");
					$datos['comuna']=$this->input->post("comuna");
					$datos['region']=$this->input->post("region");
					$datos['prevision']=$this->input->post("prevision");
					$datos['ciudad']=$this->input->post("ciudad");
					$datos['provincia']=$this->input->post("prov");
					$datos['fecha_modificacion']=date("Y-m-d");
					$datos['id_usr_modifico']=$login['user_id'];
					$datos['fecha_creacion']=date("Y-m-d");

					var_dump($datos);
					die();


					
					$this->usuario_model->update_paciente($datos,$id_paciente);


					redirect(base_url('Usuario/editar_paciente').'/'.$id_paciente);
				}

		}
	}

	/*
	NO FUNCIONA SE PASO A AGENDA DE CITAS DEL DIA
	*/

	function pasar_pendiente($paciente){


		if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{//si esta logeado 


				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinicas=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas


				$this->usuario_model->pasar_pendiente($paciente);


				redirect(base_url('Usuario/agenda'));

	

		}

	}


	/*
	NO FUNCIONA SE PASO A AGENDA DE CITAS DEL DIA
	*/

	function pasar_espera($paciente){

		if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{//si esta logeado 


				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinicas=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas


				$this->usuario_model->pasar_espera($paciente);


				redirect(base_url('Usuario/agenda'));

	

		}

	}


	/*
	NO FUNCIONA SE PASO A AGENDA DE CITAS DEL DIA
	*/
	function pasar_consulta($paciente){

		if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{//si esta logeado 


				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinicas=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas


				$this->usuario_model->pasar_consulta($paciente);


				redirect(base_url('Usuario/agenda'));

	

		}

	}


	/*
	NO FUNCIONA SE PASO A AGENDA DE CITAS DEL DIA
	*/
	function cancelar_consulta($paciente){

		if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{//si esta logeado 


				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinicas=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas


				$this->usuario_model->cancelar_consulta($paciente);


				redirect(base_url('Usuario/agenda'));

	

		}

	}


	/*
	NO FUNCIONA SE PASO A AGENDA DE CITAS DEL DIA
	*/
	function terminar_consulta($paciente){

		if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{//si esta logeado 


				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinicas=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas


				$this->usuario_model->terminar_consulta($paciente);


				redirect(base_url('Usuario/agenda'));

	

		}

	}


	/*
	DESPLIEGA EL PERFIL DEL USUARIO
	$ID=EL ID_USUER DEL USUARIO EN SESSION
	*/

	function miperfil($id){

		if (!$this->session->has_userdata('autenticado')) {
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{

			$login=$this->session->userdata('autenticado');
			$clinicas=$this->session->userdata('clinics');
			$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinicas['clinicas']);

			
			$fecha=date("d-m-Y");

			
				$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
				$this->form_validation->set_rules('apellido_paterno', 'porfavor ingrese Apellido ', 'required');
				$this->form_validation->set_rules('apellido_materno', 'porfavor ingrese Apellido ', 'required');
				$this->form_validation->set_rules('username', 'porfavor ingrese Username ', 'required');
				$this->form_validation->set_rules('email', 'porfavor ingrese Correo', 'required');
				$this->form_validation->set_rules('pass', 'porfavor ingrese Contraseña Nueva');
				$this->form_validation->set_rules('tarch', 'Fecha de Inscripción');


				if ($this->form_validation->run() == false) {
			
						//echo "falso";

				}
				else{
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

						if ($this->upload->do_upload('tarch'))
						{
										

							$file_data = $this->upload->data();
							$file_path =$file_data['file_name'];
							
							$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellido_paterno");
						$datos['apellido_materno']=$this->input->post("apellido_materno");
						$datos['usuario']=$this->input->post("username");

						if ($this->input->post('pass')!='') {
						# code...
							
						$datos['contrasena']=md5($this->input->post('pass'));
						}
					
								
							$datos['foto']=$file_path;
						

						 }
						 else{
										 
							$data['error']="La Convocatoria no se registro ";

							$data['messege']="El archivo"."  ".$_FILES['tarch']['name']."  "."no se subió correctamente ";

										
										 
							}

										
					 }

			
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$this->usuario_model->update_perfil($id,$datos);

					 

					redirect(base_url('Usuario/miperfil/').$id);
					


				}
				

				$data['info']=$login;
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				$data['perfil']=$this->usuario_model->get_perfil($id);

				$data['scripts'] = 'usuario/scripts.php';
				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['pagina_interna'] = 'usuario/perfil/perfil';
				$this->load->view($this->_plantilla_admin, $data);
		}

				
	}


	/*
	METODO SOLO PARA ADMINS Y MASTER 
	SIRVE PARA AGREGAR NUEVOS USUARIOS EN EL 
	SISTEMA
	*/


	function agregar_usuario(){
		$login=$this->session->userdata('autenticado');
		
		$this->form_validation->set_rules('username', 'Ingrese un username', 'required');
		$this->form_validation->set_rules('nombre', 'Ingrese un nombre', 'required');
		$this->form_validation->set_rules('apellidopat', 'Apellido Paterno', 'required');
		$this->form_validation->set_rules('apellidoma', 'Apellido Materno', 'required');
		$this->form_validation->set_rules('email', 'Correo Electronico', 'required');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		$this->form_validation->set_rules('user', 'Grupo de Usuario', 'required');
		
		if ($this->form_validation->run()){
			//$email = $this->input->post("email");
					
			$password= $this->input->post("password");
			$contra=md5($password);

			$datos['usuario']=$this->input->post("username");
			$datos['nombre']=$this->input->post("nombre");
			$datos['apellido_paterno']=$this->input->post("apellidopat");
			$datos['apellido_materno']=$this->input->post("apellidoma");
			$datos['email']=$this->input->post("email");
			$datos['rut']=$this->input->post('rut');
			$datos['contrasena']=$contra;
			$datos['id_grupo']=$this->input->post("user");
			$datos['fecha_creacion']=date("Y-m-d");
			$datos['activo'] = 1;
			$datos['id_clinica'] = $login['id_clinica'];
		
			$this->usuario_model->insert_user($datos);
			redirect(base_url());
			

		}
		
		$data['grupos']=$this->usuario_model->get_grupos();
		$data['titulo'] = 'login';
		$this->load->view('usuario/usuarios/agregar_usuario', $data);
		
	}





    function escapar($str)
	{
		return mysqli_real_escape_string($this->db->conn_id, $str);
	}
				
				
	function nocero($str)
	{
			if($str <> 0){
			return true;
			}else{
			$this->form_validation->set_message('nocero', 'Debe seleccionar %s ');
			return false;
			}
	}
				
				
function porciento($str) {
	if($str >= 0 and $str <=100){
		return true;
		}else{
			$this->form_validation->set_message('porciento', 'El valor del campo debe estar entre 0 y 100');
			return false;
		}
}


function get_pacientes(){
	if (!$this->session->has_userdata('autenticado')) {
		$this->session->sess_destroy();//para destruir sesion
		redirect(base_url());
	} else {
		$datos=array();
		$login=$this->session->userdata('autenticado');
		$clinica=$this->session->userdata('clinics');
		$pacientes=$this->usuario_model->get_pacientes($clinica['clinicas']);
		

		foreach ($pacientes as $key) {
			# code...
			$datos[]=$key;
		}

		echo json_encode($datos);
	}
}


//OBTIENE EL JSON DE CITAS POR MEDICO
function get_citas_medico($id_medico=-1,$fecha=-1){
		$login=$this->session->userdata('autenticado');
		$clinica=$this->session->userdata('clinics');
		$citas=$this->usuario_model->get_Medicos(base64_decode($_POST['id_medico']), base64_decode($_POST['fecha']));
		echo json_encode($citas);
}

//OBTIENE EL JSON DE CITAS POR PACIENTE
function get_citas_paciente($id_paciente=-1){
		$login=$this->session->userdata('autenticado');
		$clinica=$this->session->userdata('clinics');
		$citas=$this->usuario_model->get_citas_paciente(base64_decode($_GET['id_paciente']));
		echo json_encode($citas);
}


//OBITENE EL JSON DE CITAS HECHAS POR MEDICO
function get_citas_hechas(){
		$login=$this->session->userdata('autenticado');
		$clinica=$this->session->userdata('clinics');
		$citas=$this->usuario_model->get_citas_hechas(base64_decode($_POST['id_medico']));
		echo json_encode($citas);
}
//OBTIENE EL JSON DE LAS CITAS POR CLINICA
function get_citas_clinica(){
		$login=$this->session->userdata('autenticado');
		$clinica=$this->session->userdata('clinics');
		$citas=$this->usuario_model->get_citas_clinica(base64_decode($_POST['id_clinica']));
		echo json_encode($citas);
}




//METODOS PARA EL MIGRAR PACIENTES POR CSV

function migra_pacientes(){
	if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				
				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinica=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas
				

				   // Define as configurações para o upload do CSV
						$config['upload_path'] = RUTA_MIGRACION_PACIENTE;
						$config['allowed_types'] = 'csv';
						$config['max_size'] = '1000';

							$this->upload->initialize($config);

							if ($this->upload->do_upload('tarch'))
						{		$id_clinica=$this->input->post("nombre");
								
								$datos=array();
								$file_data = $this->upload->data();
								$file_path =  RUTA_MIGRACION_PACIENTE.$file_data['file_name'];

								$csv_array = $this->csvimport->get_array($file_path);

								foreach ($csv_array as $row) {
									# code...
									$datos['rut_otro']=$row['rut_otro'];//$this->input->post("rut");
									$datos['nombre']=$row['nombre'];//$this->input->post("nombre");
									$datos['apellido_paterno']=$row['apellido_paterno'];//$this->input->post("apellidopat");
									$datos['apellido_materno']=$row['apellido_materno'];//$this->input->post("apellidomat");
									$datos['direccion']=$row['direccion'];//$this->input->post("dir");
									$datos['celular']=$row['celular'];//$this->input->post("cel");
									$datos['telefono']=$row['telefono'];//$this->input->post("tel");
									$datos['email']=$row['email'];//$this->input->post("email");
									$datos['sexo']=$row['sexo'];//$this->input->post("sexo");
									$datos['fecha_nacimiento']=$row['fecha_nacimiento'];//=$this->input->post("tfecha");
									$datos['profesion']=$row['profesion'];//$this->input->post("prof");
									$datos['prevision']=$row['prevision'];//$this->input->post("prevision");
									$datos['comuna']=$row['comuna'];;//$this->input->post("comuna");
									$datos['provincia']=$row['provincia'];//$this->input->post("prov");
									$datos['region']=$row['region'];//$this->input->post("region");
									$datos['ciudad']=$row['ciudad'];//$this->input->post("ciudad");
									$datos['id_usr_creo']=$login['user_id'];
									$datos['fecha_creacion']=date("Y-m-d");
									$datos['id_clinica']=$id_clinica;
									$datos['activo']=0;

									
									if (isset($datos) and is_array($datos) and count($datos)>0) {
							# code...
									if ($this->usuario_model->migrar_paciente($datos)) {
										# code...
										
									}
									
									$data['exito']="La importación fue un exitó";

									

									}
									else{
										$data['error']="La importación no fue exitosa intente de nuevo ";
									}

									
								}
						}
						else{
							
							
							
						}



					
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['info']=$login;
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				//$data['perfil']=$this->usuario_model->get_perfil($id);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['clinicas']=$this->usuario_model->get_clinicas();
				$data['scripts'] = 'usuario/scripts.php';
				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['pagina_interna'] = 'usuario/migraciones/pacientes';
				
				$this->load->view($this->_plantilla_admin, $data);
	}

}

//METODOS PARA EL MIGRAR MEDICINAS POR CSV
function migra_medicinas(){
	if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				
				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinica=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas
				

				   // Define as configurações para o upload do CSV
						$config['upload_path'] = RUTA_MIGRACION_MEDICINA;
						$config['allowed_types'] = 'csv';
						$config['max_size'] = '1000';

							$this->upload->initialize($config);

							if ($this->upload->do_upload('tarch'))
						{		$id_clinica=$this->input->post("nombre");
								$nombre_clinica=$this->usuario_model->get_clinica($id_clinica);
								
								$datos=array();
								$file_data = $this->upload->data();
								//$file_data['file_name']
								$file_path =  RUTA_MIGRACION_MEDICINA.$file_data['file_name'];

								$csv_array = $this->csvimport->get_array($file_path);

								foreach ($csv_array as $row) {
									

									$datos['codigo']=$row['codigo'];
									$datos['nombre']=$row['nombre'];
									$datos['nombre_fisticio']=$row['nombre_fisticio'];
									$datos['concentracion']=$row['concentracion'];
									$datos['farmautica']=$row['farmautica'];
									$datos['presentacion']=$row['presentacion'];

									if ($row['estado']=="activo") {
										# code...
										$datos['estado']=1;
									}
									else{
										$datos['estado']=0;
									}

									$datos['id_clinica']=$id_clinica;
									


									
									if (isset($datos) and is_array($datos) and count($datos)>0) {
							# code...
									if ($this->usuario_model->migrar_medicinas($datos)) {
										# code...
										
									}
									
									$data['exito']="La importación fue un exitó";

									

									}
									else{
										$data['error']="La importación no fue exitosa intente de nuevo ";
									}

									
								}
						}
						



					
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['info']=$login;
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				//$data['perfil']=$this->usuario_model->get_perfil($id);
				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['clinicas']=$this->usuario_model->get_clinicas();
				$data['scripts'] = 'usuario/scripts.php';
				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['pagina_interna'] = 'usuario/migraciones/medicinas';
				
				$this->load->view($this->_plantilla_admin, $data);
	}

}
//METODOS PARA EL MIGRAR MEDICOS POR CSV
function migra_medicos(){
	if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				
				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinica=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas
				

				   // Define as configurações para o upload do CSV
						$config['upload_path'] = RUTA_MIGRACION_MEDICOS;
						$config['allowed_types'] = 'csv';
						$config['max_size'] = '1000';

							$this->upload->initialize($config);

							if ($this->upload->do_upload('tarch'))
						{		$id_clinica=$this->input->post("nombre");
								$nombre_clinica=$this->usuario_model->get_clinica($id_clinica);
								$grupo=$this->input->post("grupos");
								
								$datos=array();
								$dates=array();
								$file_data = $this->upload->data();
								//$file_data['file_name']
								$file_path =  RUTA_MIGRACION_MEDICOS.$file_data['file_name'];

								$csv_array = $this->csvimport->get_array($file_path);

								foreach ($csv_array as $row) {

									$datos['nombre']=$row['nombre'];
									$datos['apellido_paterno']=$row['apellido_paterno'];
									$datos['apellido_materno']=$row['apellido_materno'];
									$datos['usuario']=$row['usuario'];
									$datos['rut']=$row['rut'];
									$datos['email']=$row['email'];
									$datos['id_grupo']=$grupo;
									$datos['contrasena']=md5("emedic10");
									$datos['foto']="icon.png";
									$datos['fecha_creacion']=date('Y-m-d');
									$datos['fecha_modificacion']=date('Y-m-d');
									$datos['activo']=1;
									$datos['id_clinica']=$id_clinica;
									

									

									


									
									if (isset($datos) and is_array($datos) and count($datos)>0) {
							# code...
									if ($this->usuario_model->migrar_medicos($datos)) {
										# code...


										
									}

									$this->usuario_model->put_clinica($datos['usuario']);
										
									
									$data['exito']="La importación fue un exitó";

									

									}
									else{
										$data['error']="La importación no fue exitosa intente de nuevo ";
									}

									
								}
						}
						



					
				$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
				$data['info']=$login;
				$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
				//$data['perfil']=$this->usuario_model->get_perfil($id);

				$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
				$data['clinicas']=$this->usuario_model->get_clinicas();
				$data['grupos']=$this->usuario_model->get_personal();
				$data['scripts'] = 'usuario/scripts.php';
				$data['header'] = 'inc/header';
				$data['lateral'] = 'inc/lateral';
				$data['navbar'] = 'inc/navbar';
				$data['footer'] = 'inc/footer';
				$data['titulo'] = 'login';
				$data['pagina_interna'] = 'usuario/migraciones/medicos';
				
				$this->load->view($this->_plantilla_admin, $data);
	}

}



//METODOS PARA EL MIGRAR MEDICOS POR CSV
function migra_citas(){
	if (!$this->session->has_userdata('autenticado')) {//valida si no esta logeado 
			# code...
				$this->session->sess_destroy();//para destruir sesion
				redirect(base_url());

		}
		else{
				
				$login=$this->session->userdata('autenticado');//variable que trae la seccion del usuario

				$clinica=$this->session->userdata('clinics');//variable de seccion que guarda en que clinica estas
				

				   // Define as configurações para o upload do CSV
						$config['upload_path'] = RUTA_MIGRACION_CITAS;
						$config['allowed_types'] = 'csv';
						$config['max_size'] = '1000';

							$this->upload->initialize($config);

							if ($this->upload->do_upload('tarch'))
						{		$id_clinica=$this->input->post("clinica");
								$id_medico=$this->input->post("medico");
								$id_prestacion=$this->input->post("presentacion");
								
								
								$datos=array();
								$dates=array();
								$file_data = $this->upload->data();
								//$file_data['file_name']
								$file_path =  RUTA_MIGRACION_CITAS.$file_data['file_name'];

								$csv_array = $this->csvimport->get_array($file_path);

								foreach ($csv_array as $row) {

									
									$datos['id_medico']=$id_medico;
									$datos['rut_paciente']=$row['rut_paciente'];
									$datos['id_prestacion']=$id_prestacion;

									$date=date_create($row['fecha']);
									$fecha_prog= date_format($date,"d-m-Y");
									$datos['fecha']=$fecha_prog;
									$datos['hora']=$row['hora'];
									$datos['pagado']=$row['pagado'];
									$datos['comentario']=$row['comentario'];
									$datos['observacion']=$row['observacion'];
									$datos['cancelada']=$row['cancelada'];
									$datos['pendiente']=$row['pendiente'];
									$datos['finalizada']=$row['finalizada'];
									$datos['espera']=$row['espera'];
									$datos['consulta']=$row['consulta'];
									$datos['espera_examen']=$row['espera_examen'];
									$datos['id_clinica']=$id_clinica;
									$datos['tipo']=$row['tipo'];
									
									if (isset($datos) and is_array($datos) and count($datos)>0) {
							# code...
									$this->usuario_model->migrar_citas($datos); 
						
									

									//$this->usuario_model->put_clinica($datos['usuario']);
										
									
									$data['exito']="La importación fue un exitó";

									

									}
									else{
										$data['error']="La importación no fue exitosa intente de nuevo ";
									}

									
								}
						}
						



						
					$data['listOfUsers']=$this->usuario_model->adm_get_user_chat($clinica['clinicas']);
					$data['info']=$login;
					$data['modulos']=$this->usuario_model->get_menu($login['id_grupo']);
					//$data['perfil']=$this->usuario_model->get_perfil($id);
					$data['presentacion']=$this->usuario_model->get_prestacion();
					$data['medicos']=$this->usuario_model->get_Medicos_cita();
			
					$data['perfil']=$this->usuario_model->get_perfil($login['user_id']);
					$data['clinicas']=$this->usuario_model->get_clinicas();
					$data['grupos']=$this->usuario_model->get_personal();
					$data['scripts'] = 'usuario/scripts.php';
					$data['header'] = 'inc/header';
					$data['lateral'] = 'inc/lateral';
					$data['navbar'] = 'inc/navbar';
					$data['footer'] = 'inc/footer';
					$data['titulo'] = 'login';
					$data['pagina_interna'] = 'usuario/migraciones/citas';
					
					$this->load->view($this->_plantilla_admin, $data);
		}

	}




}




 ?>