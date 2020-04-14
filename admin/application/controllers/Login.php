<?php 


/**
* 
@Ing.LuisCobian
 	@Ing.PedroFernandez
*/
class Login extends CI_Controller
{
	/*METODO PARA EL LOGUEO*/
	function __construct()
		{
			parent::__construct();
			
			$this->_modulo_id = "LOGIN";
			$this->_plantilla = "inicio/template/head";//el nav y head

			///$this->_plant = "template/admin_lte.php";//el nav y head			
			$this->load->database();
			$this->load->helper('url');

			//$this->load->library('grocery_CRUD');
			//$this->load->model('grocery_crud_model');
			$this->load->model('usuario_model');
			$this->load->library('email');
			$this->load->library('upload');
			$this->load->library('form_validation');
			//$this->load->library('tooltip_gcrud');  //load the library

			//$variable="ok";
		}

		/* METODO QUE HACE EL LOGUEO */

		function login(){

			$this->form_validation->set_rules('email', 'Ingrese username ', 'required|alpha_numeric');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('inicio/login');
			}

			else{

				$email = $this->input->post("email");
						
				$password= $this->input->post("password");
				$contra=md5($password);
				
				$user=$this->usuario_model->get_login($email,$contra);

				if ($user!=false) {
					$datos['clinicas']=$this->usuario_model->get_clinicas_one($user->id);
					$datos['user_id']=$user->id;
					$datos['username']=$user->usuario;
					$datos['nombre']=$user->nombre;
					$datos['login']=true;
					$datos['id_grupo']=$user->id_grupo;
					$datos['id_clinica']=$user->id_clinica;
					$datos['foto']=$user->foto;
					$this->session->set_userdata('autenticado', $datos);

					//$this->session->set_userdata($datos);

					if ($user->id_grupo==1) {
						echo 'clinicas-medico/';
						//echo 'consultorio/';
					} else {
						echo 'clinicas/';
					}
				} else {
					echo 'invalid';
				}

					
					//var_dump($datos);

				
			}
			

		}

		/* METODO QUE HACE EL REGISTRO DE USARIOS */
	     function register(){

			$this->form_validation->set_rules('username', 'Ingrese nombre de usuario', 'required');
			$this->form_validation->set_rules('nombre', 'Ingrese un nombre', 'required');
			$this->form_validation->set_rules('apellidopat', 'Apellido Paterno', 'required');
			$this->form_validation->set_rules('apellidoma', 'Apellido Materno', 'required');
			$this->form_validation->set_rules('email', 'Correo Electronico', 'required');
			$this->form_validation->set_rules('password', 'Contrase«Ða', 'required');
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
				$datos['contrasena']=$contra;

				$datos['id_grupo']=$this->input->post("user");
				
			
					
					$this->usuario_model->insert_user($datos);
					redirect(base_url());
				

			}
			
			$data['grupos']=$this->usuario_model->get_grupos();
			$data['pagina_interna'] = 'inicio/register';
			$data['titulo'] = 'login';
			$this->load->view($this->_plantilla, $data);
			
		}



			/* METODO DE DESLOGUEO */
			 function log_out(){
			
			$this->session->sess_destroy();//para destruir sesion
			redirect(base_url());
			
			}



}
 ?>