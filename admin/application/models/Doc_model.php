<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');

/**
* 
@Ing.LuisCobian
 	@Ing.PedroFernandez
*/
class Doc_model extends  CI_Model
{

/* ---------MODELO PARA PERFIL DE DOCTORES ----------*/
	
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


	/* DESPLIEGA LAS CITAS 

		ID_USER=POR USUARIO
		ESTADO = EL STATUS DE LA CITA
	 */

	function get_citas($id_user=-1,$estado=-1){
		$this->db->select('citas.*');
		$this->db->select('pacientes.nombre as persona');
		$this->db->select('pacientes.rut_otro as rut');
		$this->db->select('prestaciones.nombre tipo');
		$this->db->join('prestaciones','prestaciones.id=citas.id_prestacion','LEFT');
		$this->db->join('pacientes','pacientes.id=citas.id_paciente','LEFT');
		$this->db->where('citas.id_medico',$id_user);

		switch ($estado) {
			case 1:
				# code...
			$this->db->where('citas.pendiente',1);


			if ($query=$this->db->get('citas')) {
					
					if ($query->num_rows()>0) {
						# code...
						return $query->result();
					}
			}
				break;


			case 2:
				# code...
			$this->db->where('citas.espera',1);


				if ($query=$this->db->get('citas')) {
					
					if ($query->num_rows()>0) {
						# code...
						return $query->result();
					}
				}
				break;

			case 3:
				# code...
			$this->db->where('citas.consulta',1);


				if ($query=$this->db->get('citas')) {
					
					if ($query->num_rows()>0) {
						# code...
						return $query->row();
					}
				}
				break;


			case 4:
				# code...
			$this->db->where('citas.finalizada',1);
			$this->db->or_where('citas.cancelada',1);

			if ($query=$this->db->get('citas')) {
			
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}
			
			break;
			
			default:
				# code...
				break;
		}

		
	}


	/* DESPLIEGA EL TOTAL DE DINERO
		RECAUDADO DEL DIA

		ID_MEDICO=POR MEDICO
		FECHA = FECHA DEL DIA
		ID_CLINICA=POR LA CLINICA 
	 */
	function get_total_dinero($id_medico,$fecha,$id_clinica){
		$this->db->join('citas','citas.id=pagos.id_cita','LEFT');
		$this->db->join('usuarios','usuarios.id=citas.id_medico','LEFT');
	 	$this->db->where('citas.id_medico',$id_medico);
	 	$this->db->where('citas.fecha',$fecha);
	 	$this->db->where('citas.id_clinica',$id_clinica);
	 	$this->db->select("SUM(monto) as total");
	 	if ($query=$this->db->get('pagos')) {
	 		return $query->row();
	 	} else {
	 		return false;
	 	}
	 }


	 /* DESPLIEGA LOS MEDICAMENTOS */

	 function get_medicamentos($id_clinica=-1){
	 	$this->db->where('id_clinica',$id_clinica);
	 	if ($query=$this->db->get("cat_medicinas")) {
	 		if ($query->num_rows()>0) {
	 			return $query->result();
	 		}
	 	}
	 	return false;
	 }



	 /* AGREGA UN NUEVO MEDICAMENTO DESDE RECETA
	 */

	 function nuevo_medicamento($datos){
	 	$this->db->where('nombre',$datos['nombre']);
	 	$this->db->where('nombre_fisticio',$datos['nombre_fisticio']);
	 	if ($query=$this->db->get('cat_medicinas')) {
	 		if ($query->num_rows()>0) {
	 			return false;
	 		} else {

	 			if (is_array($datos) and isset($datos)) {
					$this->db->insert('cat_medicinas', $datos); 
				}
	 		}
	 	}
	 }


 	function get_documentos($id=-1){
 		$this->db->where('id_cita',$id);
 		if ($query=$this->db->get('citas_archivos')) {
			if ($query->num_rows()>0) {
				$documentos=$query->result();
				$datos=array();
				if (isset($documentos) and is_array($documentos) and count($documentos)>0) {
					foreach ($documentos as $key ) {
						$datos[]=$key;
					}
					echo json_encode($datos);
				}
			} else {
				echo 0;
			}
		}
	}

	function eliminar_documento($id=-1){
		$this->db->where('id', $id);
		$this->db->delete('citas_archivos');
	}

	function get_prestaciones(){
		if ($query=$this->db->get('prestaciones')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}
	}

	function get_prestaciones_doc($id_medico=-1){
		$this->db->select('doctoresprestaciones.*');
		$this->db->select('prestaciones.nombre as prestacion');
		$this->db->select('prestaciones.costo as costo');
		$this->db->where('id_medico',$id_medico);
		//$this->db->order_by('id', 'asc');
		$this->db->join('prestaciones','prestaciones.id=doctoresprestaciones.id_prestacion','LEFT');
		if ($query=$this->db->get('doctoresprestaciones')) {
			if ($query->num_rows()>0) {
				$prestaciones=$query->result();
				$datos=array();
				if (isset($prestaciones) and is_array($prestaciones) and count($prestaciones)>0) {
					foreach ($prestaciones as $key ) {
						$datos[]=$key;
					}
					echo json_encode($datos);
				}
			} else {
				echo 0;
			}
		}
	}

	function get_receta_imprimir($id_cita=-1){

		$this->db->where('id',$id_cita);
		if ($query=$this->db->get('citas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$receta=$query->result();

				if (isset($receta) and is_array($receta) and count($receta)) {
					# code...
					foreach ($receta as $key) {
						# code...

						$key->paciente=$this->doc_model->get_paciente_receta($key->rut_paciente);
						$key->medico=$this->doc_model->get_medico_receta($key->id_medico);
						$key->clinica=$this->doc_model->get_clinica_receta($key->id_clinica);
						$key->medicamentos=$this->doc_model->get_medicamentos_receta($key->id);
						$key->prestacion=$this->doc_model->get_prestacion_receta($key->id_prestacion);
					}

					return $receta;
				}
			}
		}


	}

	function get_paciente_receta($rut_paciente=-1){
		$this->db->where('rut_otro',$rut_paciente);
		if ($query=$this->db->get('pacientes')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}
		}

	}

	function get_medico_receta($id_medico=-1){

		$this->db->where('id',$id_medico);
		if ($query=$this->db->get('usuarios')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}
		}

	}


	function get_clinica_receta($id_clinica=-1){

		$this->db->where('id',$id_clinica);
		if ($query=$this->db->get('clinicas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}
		}

	}





	function get_medicamentos_receta($id_cita=-1){
		$this->db->where('id_cita',$id_cita);
		if ($query=$this->db->get('citas_recetas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$medicamentos=$query->result();
				
				if (isset($medicamentos) and is_array($medicamentos) and count($medicamentos)) {
					# code...
					foreach ($medicamentos as $key) {
						# code...
						
						$info=explode("|", $key->id_medicamento);
						$key->medicina=$this->doc_model->infomarcion_medicina($info[0]);

					}

					return $medicamentos;
				}
			}
		}

	}

	function infomarcion_medicina($id_medicamento=-1){
		$this->db->where('id',$id_medicamento);
		if ($query=$this->db->get('cat_medicinas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...

				return $query->row();
			}
		}

	}

	function get_prestacion_receta($id_prestacion=-1){
		$this->db->where('id',$id_prestacion);
		if ($query=$this->db->get('prestaciones')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}
		}
	}

	



	
	function insert_prestacion($datos=-1 , $id_medico=-1){
		if ($this->db->insert('prestaciones',$datos)) {
			$this->db->like('nombre', $datos['nombre']);
			if ($query=$this->db->get('prestaciones')) {
				if ($query->num_rows()>0) {
					$prestacion=$query->result();
					foreach ($prestacion as $key ) {
						$resultado=array();
						$resultado['id_medico']=$id_medico;
						$resultado['id_prestacion']=$key->id;
						$this->db->insert('doctoresprestaciones',$resultado);
					}
				}
			}
		}

	}
	
	function select_prestacion($id_prestacion=-1 , $id_medico=-1){
		$resultado['id_prestacion'] = $id_prestacion;
		$resultado['id_medico'] = $id_medico;
		if($this->db->insert('doctoresprestaciones',$resultado)){
			echo 'ok';
		} else {
			echo 'error';
		}
	}

}





 ?>