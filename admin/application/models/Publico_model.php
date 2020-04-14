<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');

/**
* 
@Ing.LuisCobian
 	@Ing.PedroFernandez
*/
class Publico_model  extends  CI_Model
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


	/*  ------------- METODOS  DE LA AGENDA ONLINE ------ */ 

	public function get_proviciones(){
		$this->db->select("id");

		$this->db->select("nombre");

		if ($query=$this->db->get("prestaciones")) {
			# code...
				if ($query->num_rows()>0) {
					# code...
					return	$query->result();
				}

		}

		return false;

	}

	public function get_doctores($id_prestacion=-1){
		$this->db->select("usuarios.id");
		$this->db->select("usuarios.nombre");
		$this->db->select('usuarios.id_clinica');
		
		$this->db->where('usuarios.id_grupo',1);

		if ($query=$this->db->get("usuarios")) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$medicos=$query->result();

				if (isset($medicos) and is_array($medicos) and count($medicos)>0) {
					# code...}

					foreach ($medicos as $key) {
						# code...
						$key->prestacion=$this->publico_model->prestaciones($key->id);
						$key->horarios=$this->publico_model->horarios($key->id);
						$key->clinica=$this->publico_model->clinicas($key->id_clinica);
					}

					return $medicos;
				}


			}
		}

		return false;


	}

	public function prestaciones($id_medico){
			$this->db->select('prestaciones.id');
			$this->db->select('prestaciones.nombre');

			$this->db->where('doctoresprestaciones.id_medico',$id_medico);
			$this->db->join('prestaciones','prestaciones.id=doctoresprestaciones.id_prestacion','left');

			if ($query=$this->db->get('doctoresprestaciones')) {
				# code...
					if ($query->num_rows()>0) {
						# code...
						return $query->row();
					}
			}
	}

	public function horarios($id_medico){

		$this->db->where('id_medico',$id_medico);

		if ($query=$this->db->get('horarios')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}
		}
	}


	 function insert_cita($data){

			if (is_array($data) and isset($data)) {
				# code...

				$this->db->insert('citas', $data); 
			}
	 }

	 function get_clinica($id_clinica=-1){

	 		if ($id_clinica>0) {
	 			# code...
	 			$this->db->where('id',$id_clinica);
	 		}

	 		

	 		if ($query=$this->db->get('clinicas')) {
	 			# code...

	 			if ($query->num_rows()>0) {
	 				# code...
	 				return $query->row();
	 			}
	 		}
	 }

	 function get_especialidad($especialidad=-1,$medico=-1,$clinica=-1){

	 
	 		# code...
		 	$this->db->select("usuarios.id");
			$this->db->select("usuarios.nombre");
			$this->db->select('usuarios.id_clinica');
			
			
			
			

			# code...
			if (count($medico)>0) {
					# code...
					$this->db->like('usuarios.nombre',$medico);
			}


			if (count($especialidad)>0) {
					# code...
					$this->db->like('prestaciones.nombre',$especialidad);
			}


			if (count($clinica)>0) {
					# code...
					$this->db->like('clinicas.nombre',$clinica);
			}

			
			

			$this->db->join('clinicas','clinicas.id=usuarios.id_clinica','LEFT');

			$this->db->join('doctoresprestaciones','doctoresprestaciones.id_medico=usuarios.id','LEFT');

			$this->db->join('prestaciones','prestaciones.id=doctoresprestaciones.id_prestacion','LEFT');

			
				if ($query=$this->db->get("usuarios")) {
					# code...
					if ($query->num_rows()>0) {
						# code...
						$medicos=$query->result();

						if (isset($medicos) and is_array($medicos) and count($medicos)>0) {
							# code...}

							foreach ($medicos as $key) {
								# code...
								$key->prestacion=$this->publico_model->prestaciones($key->id);
								$key->horarios=$this->publico_model->horarios($key->id);
								$key->clinica=$this->publico_model->clinicas($key->id_clinica);
								
								
							}

							return $medicos;
						}
					}
				}
	 		

		
		}


	 function  clinicas($id_clinica=-1){
	 	$this->db->select('clinicas.nombre');
	 	$this->db->select('clinicas.id');

	 	$this->db->where('id',1);
	 	if ($query=$this->db->get('clinicas')) {
	 		# code...
	 		if ($query->num_rows()>0) {
	 			# code...
	 			return $query->row();
	 		}
	 	}
	 }


}


 ?>