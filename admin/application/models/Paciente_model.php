<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
/**
* 
@Ing.LuisCobian
 	@Ing.PedroFernandez
*/
class Paciente_model extends CI_Model
{
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

	function get_login($email,$pass){
		$this->db->where('pass',$pass);
		$this->db->where('email',$email);
		

		if ($query=$this->db->get('pacientes')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
					return $query->result();
			}
		

		}

		return false;
	}

	function get_doctores($id_clinica=-1){

			$this->db->select('usuarios.id id_medico');
			$this->db->select('usuarios.nombre medico');
			$this->db->select('prestaciones.nombre prestacion');
			$this->db->select('prestaciones.costo costo');

			
				# code...
				$this->db->where('usuarios.id_clinica',$id_clinica);
				$this->db->where('usuarios.id_grupo',1);
				//$this->db->where('doctoresprestaciones.id_grupo',1);	
			

			$this->db->join('usuarios','usuarios.id=doctoresprestaciones.id_medico','left');



			$this->db->join('prestaciones','prestaciones.id=doctoresprestaciones.id_prestacion','left');

			if ($query=$this->db->get('doctoresprestaciones')) {
				# code...

				if ($query->num_rows()>0) {
					# code...
					return $query->result();
				}
			}
			
	}


	function get_horarios($id_medico=-1){

			

			if ($id_medico>0) {
				# code...
				$this->db->where('id',$id_medico);
				
			}

			if ($query=$this->db->get('horarios')) {
				# code...

				if ($query->num_rows()>0) {
					# code...
					return $query->result();
				}
			}
			
	}


	function agendar_cita($id=-1,$data,$datos){

		if (!$id) {
            $this->db->insert('citas', $data);
            $this->db->where('id',$data['id_paciente']);
            $this->db->update('pacientes', $datos);
        } else {
            $this->db->where('id', $id);
            $this->db->update('citas', $data);
        }
	}


	function get_horarios_doc($id_medico=-1){

			$this->db->select('hora_fin');

			if ($id_medico>0) {
				# code...
				$this->db->where('id',$id_medico);
				
			}

			if ($query=$this->db->get('horarios')) {
				# code...

				if ($query->num_rows()>0) {
					# code...
					return $query->row();
				}
			}

			return false;
			
	}

}








 ?>