<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
			$this->load->library('email');
			$this->load->model('usuario_model');
			$this->load->helper('form');
			$this->load->library('upload');
			$this->load->library('form_validation');
			//$this->load->library('tooltip_gcrud');  //load the library

			$variable="ok";
		}
	 
	public function index()
	{

			
			$data['pagina_interna'] = 'inicio/login';
			$data['titulo'] = 'login';
			$this->load->view($this->_plantilla, $data);
		
	}


	    

}
