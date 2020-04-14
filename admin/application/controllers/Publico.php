<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
@Ing.LuisCobian
 	@Ing.PedroFernandez
*/
class Publico extends  CI_Controller 
{
	
	function __construct()
		{
			parent::__construct();
			
			$this->_modulo_id = "LOGIN";
			$this->_plantilla = "inicio/template/head";//el nav y head

			///$this->_plant = "template/admin_lte.php";//el nav y head			
			$this->load->database();
			$this->load->helper('url');
			$this->load->helper('string');
			//$this->load->library('grocery_CRUD');
			//$this->load->model('grocery_crud_model');
			$this->load->library('email');
			$this->load->model('usuario_model');
			$this->load->model('publico_model');
			$this->load->helper('form');
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('session');
			$this->load->library('email');
			$this->load->library('upload');
			$this->load->library('form_validation');
			//$this->load->library('tooltip_gcrud');  //load the library

			$variable="ok";
		}

		public function paciente($id_clinica=-1){


					$this->form_validation->set_rules('nombre', 'porfavor ingrese su nombre', 'required');
					
					//$this->form_validation->set_rules('isapre', 'porfavor ingrese su Correo', 'required');
					

					if ($this->form_validation->run() == false) {
				
							//echo "falso";

						$datos['Error']="Registro no completado";
						//echo  json_encode($datos);
						
					}

					else{
						$datos['rut_otro']=$this->input->post("rut");
						$datos['nombre']=$this->input->post("nombre");
						$datos['apellido_paterno']=$this->input->post("apellidopat");
						$datos['apellido_materno']=$this->input->post("apellidomat");
						$datos['id_clinica']=1;
						$datos['celular']=$this->input->post("cel");
						$datos['telefono']=$this->input->post("tel");
						$datos['email']=$this->input->post("email");
						$datos['isapre']=$this->input->post('isapre');
						$datos['fecha_creacion']=date("Y-m-d");
						$datos['id_clinica']=$id_clinica;//$this->input->post("id_clinica");
						$datos['token']=random_string('alnum', 8);
						
						if ($this->usuario_model->insert_pacientes($datos)) {
							# code...
							$datas['success']="Registro completado";
							//echo  json_encode($datas);
							
						}

						//$this->usuario_model->insert_pacientes($datos);

						
						redirect(base_url("Publico/cita".'/'.$datos['nombre'].'/'.$id_clinica));

						
					}

				$data['id_clinica']=$id_clinica;
				$data['clinica']=$this->publico_model->get_clinica($id_clinica);

				

				$this->load->view("inc_public/header2",$data); 


			 $this->load->view("inc_public/navbar",$data); 


			 $this->load->view("public/agregar_pacientes",$data); 

				
			$this->load->view("inc_public/footer",$data); 

		}


		public function cita($nombre=-1,$id_clinica=-1){
			
			$this->form_validation->set_rules('especialidad', 'porfavor selecione especialidad', 'required');
			$this->form_validation->set_rules('doctor', 'porfavor selecione doctor', 'required');
			$this->form_validation->set_rules('fecha', 'porfavor selecione fecha', 'required');
			$this->form_validation->set_rules('hora', 'porfavor selecione hora', 'required');
			$this->form_validation->set_rules('paciente', 'porfavor ingrese su nombre', 'required');
			$this->form_validation->set_rules('contacto', 'porfavor ingrese su telefono', 'required');

			
			if ($this->form_validation->run() == false) {
				
							//echo "falso";

			}
			else{
				$datos['id_medico']=$this->input->post("doctor");			
				$datos['id_paciente']=0;
				$datos['id_prestacion']=$this->input->post("especialidad");
				$datos['fecha']=$this->input->post("fecha");
				$datos['hora']=$this->input->post("hora");
				$datos['status_id']=0;
				$datos['comentario']="Citado por web";
				$datos['motivo_cancelacion']="";
				$datos['cancelada']=0;
				$datos['pendiente']=1;
				$datos['finalizada']=0;
				$datos['espera']=0;
				$datos['consulta']=0;
				$datos['espera_examen']=0;
				$datos['id_clinica']=$id_clinica;
				$datos['tipo']="web";

				if (isset($datos) and is_array($datos) and count($datos)>0) {
					# code...
					if ($this->publico_model->insert_cita($datos)) {
						# code...

						redirect(base_url('publico'));
					}
					
				}

				

			}


			$data['especialidad'] =$this->publico_model->get_proviciones();

			
			$data['clinica']=$this->publico_model->get_clinica($id_clinica);

				

				$this->load->view("inc_public/header2",$data); 


			 $this->load->view("inc_public/navbar",$data); 

			

			 $this->load->view("public/agendar_cita",$data); 

				
			$this->load->view("inc_public/footer",$data); 
			//$this->load->view($this->_plantilla, $data);
		}


		public function get_doctores($id_prestacion=-1){
			//$id_prestacion=$_POST['id_prestacion'];

			$data['doctores']=$this->publico_model->get_doctores($id_prestacion);

			foreach ($data['doctores'] as $fila ) {
				# code...

				echo  json_encode(array('doctores' => $fila));
			}
			//var_dump($data['doctores']);
		}


		public function finalizada($id_clinica=-1){

			$data['clinica']=$this->publico_model->get_clinica($id_clinica);
			
			$this->load->view("inc_public/header2",$data); 


			 $this->load->view("inc_public/navbar",$data); 


			 $this->load->view("public/finalizada",$data); 

				
			$this->load->view("inc_public/footer",$data); 
		}



}






 ?>