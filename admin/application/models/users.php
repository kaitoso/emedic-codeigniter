<?php 

class users extends CI_Model
{
	   


	   function get_login($username,$pass){

		
		$this->db->where('usuario',$username);
		//
		$this->db->where('contrasena',$pass);

		

		if ($query=$this->db->get('usuarios')) {


			# code...
			return $query->row();


		}
		else{
			return false;
		}


	}

	function get_user($id=''){

		$this->db->where('id',$id);
		//
		

		

		if ($query=$this->db->get('usuarios')) {


			# code...
			return $query->row();


		}
		else{
			return false;
		}
	}
	

	function get_grupos(){

		if ($query=$this->db->get('grupo_usuarios')) {
			# code...

			return $query->result();

		}
	}


	function get_clinicas(){

		if ($query=$this->db->get('clinicas')) {
			# code...

			return $query->result();

		}
	}





	    function get_clinicas_one($id_user){

	    	$this->db->join('usuarios','usuarios.id=clinica_users.id_user','left');
	    	$this->db->join('clinicas','clinicas.id=clinica_users.id_clinica','left');
	    	$this->db->where('id_user',$id_user);
	    	if ($query=$this->db->get('clinica_users')) {
	    		# code...
	    		return $query->result();
	    	}
	    	else{
	    		return false;
	    	}

	    }



	    function insert_user($data){


	    	if (isset($data) and is_array($data)) {
	    		# code...
	    		$this->db->insert('usuarios', $data); 
	    	
	    	}

			
	    }



	    function insert_clinicas($data){


	    	if (isset($data) and is_array($data)) {
	    		# code...
	    		$this->db->insert('clinica_users', $data); 
	    	
	    	}

			
	    }



}



 ?>