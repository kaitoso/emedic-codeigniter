<?php

/**
* 
*/	
class chat extends CI_Controller {
	/* 
	@Ing.LuisCobian
 	@Ing.PedroFernandez

	*/
    //Global variable  
    public $outputData;     //Holds the output data for each view

	function __construct(){
        parent::__construct();
        //$this->_plant = "template/admin_lte.php";//el nav y head			
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('ci_chat');

		//$this->load->library('grocery_CRUD');
		//$this->load->model('grocery_crud_model');
		$this->load->library('session');
		$this->load->model('usuario_model');
		$login=$this->session->userdata('autenticado');
		//$this->load->library('tooltip_gcrud');  //load the library
		$this->outputData['listOfUsers']    = $this->usuario_model->adm_get_user_chat($login['id_clinica']);

		//$variable="ok";
    }
	public function index() {	

		if($this->session->has_userdata('autenticado')){
				$clinica=$this->session->userdata('clinics');

				$login=$this->session->userdata('autenticado');
			 $clinica=$this->session->userdata('clinics');
			$data['info']=$login;
	        $data['listOfUsers']=$this->usuario_model->adm_get_user_chat($login['id_clinica']);

	       



	      

	       
	        $this->load->view('chat/chat',$data);
		}
		else{
			$this->session->sess_destroy();//para destruir sesion
					redirect(base_url());
		}

		
	}
}