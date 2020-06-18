<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');

/**
 * Usuario_model class.
 * @Ing.LuisCobian
 *	@Ing.PedroFernandez
 * @extends CI_Model usuario y enfermeras
 */
class Usuario_model extends CI_Model {

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


	/* HACE EL LOGIN DE LOS USUARIOS
	 */
	 function ulogin($username,$pass){

		
		$this->db->where('usuario',$username);
		//
		$this->db->where('contrasena',$pass);

		

		if ($query=$this->db->get('usuarios')) {


			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}

			else{
				return false;
			}
			


		}
		else{
			return false;
		}


	}


	/* OBTIENE EL USUARIO
	 */

	function get_user($id=''){


		

		$this->db->where('usuarios.id',$id);
		//
		if ($query=$this->db->get('usuarios')) {

			$usuario=$query->row();



			 return $usuario;
	 	 }
			
			# code...
			

		else{
			return false;
		}
	}



	/* OBTIENE TODOS LOS USUARIOS
	 */

	function get_user_all($id=''){


		

		$this->db->where('usuarios.id',$id);
		//
		if ($query=$this->db->get('usuarios')) {

			$usuario=$query->result();


			if (isset($usuario) and is_array($usuario)) {
				# code...


				foreach ($usuario as $key) {
						# code...

					$key->grupo=$this->usuario_model->get_grupo($key->id_grupo);
				}
			 }

			 return $usuario;
	 	 }
			
			# code...
			

		else{
			return false;
		}
	}
	


	/* OBTIENE TODOS LOS GRUPOS
	 */
	function get_grupos(){

		if ($query=$this->db->get('grupo_usuarios')) {
			# code...
			$grupos=$query->result();

			if (isset($grupos) and is_array($grupos)) {

				foreach ($grupos as $key) {
					$key->total=$this->usuario_model->get_total_grup($key->id);
					//$key->clinicas=$this->usuario_model->get_grupos_by_clinica($id_clinica);
					# code...
				}

			}




			return $grupos;

		}
	}


	
	/* OBTIENE LOS GRUPOS
		POR ID_GRUPO
	 */

	function get_grupo($id_grupo){


		$this->db->where('id',$id_grupo);

		if ($query=$this->db->get('grupo_usuarios')) {

			return $query->row();

		}
	}

	/* OBTIENE LOS CLINICAS
		POR ID_CLINICA
	 */
	function get_clinicas($id_clinica=''){

		if ($query=$this->db->get('clinicas')) {
			# code...

			return $query->result();

		}
	}


	/* OBTIENE LOS CLINICAS
		POR ID_CLINICA
	 */
	function get_personal($id_clinica=''){

		if ($query=$this->db->get('grupo_usuarios')) {
			# code...

			return $query->result();

		}
	}

	/* OBTIENE LA CLINICA
		POR USUARIO
	 */
	function get_clinica($id_user)
	{

		$this->db->join('clinicas','clinicas.id=clinica_users.id_clinica','left');
	   	
	   $this->db->where('id_clinica',$id_user);
	   if ($query=$this->db->get('clinica_users')) {
	    		# code...
	    	return $query->row();
	   }
		    else{
		    	return false;
		    }

	  }

	  	/* OBTIENE LA INFORMACION CLINICA
		POR USUARIO
	 */


	    function get_clinica_info($id_user){

	   	
	    $this->db->where('id',$id_user);
	    if ($query=$this->db->get('clinicas')) {
	    		# code...
	    		return $query->row();
	    }
		    else{
		    	return false;
		    }

	    }

	  
	  /* OBTIENE LA CLINICA
		POR USUARIO
	 */

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
//getss


	     /* OBTIENE EL TOTOAL DE PACIENTES 
		POR CLINICA
	 */

	 function get_total_pacientes_card($id_clinica){

		 $this->db->where('id_clinica',$id_clinica);
		 $this->db->where('activo !=',2);
	 	$this->db->select("count(*) as total");
	 	if ($query=$this->db->get('pacientes')) {
	 		# code...
	 		return $query->row();
	 	}
	 	else{
	 		return false;
	 	}
	 }

	 function get_total_pacientes($id_clinica){

		$this->db->where('id_clinica',$id_clinica);
		$this->db->select("count(*) as total");
		if ($query=$this->db->get('pacientes')) {
			# code...
			return $query->row();
		}
		else{
			return false;
		}
	}

	   /* OBTIENE EL TOTOAL DE CITAS 
		POR CLINICA
	 */

	  function get_total_citas($id_medico,$id_clinica){
	  	$this->db->where('id_clinica',$id_clinica);
	 	$this->db->where('id_medico',$id_medico);
	 	$this->db->select("count(*) as total");
	 	if ($query=$this->db->get('citas')) {
	 		# code...
	 		return $query->row();
	 	}
	 	else{
	 		return false;
	 	}
	 }

	   /* OBTIENE EL TOTOAL DE CITAS HOY
		POR CLINICA
		POR MEDICO
		POR FECHA
	 */
	 function get_total_citas_hoy($id_medico,$fecha,$id_clinica){

	 	$this->db->where('id_medico',$id_medico);
	 	$this->db->where('fecha',$fecha);
	 	$this->db->where('id_clinica',$id_clinica);
	 	$this->db->select("count(*) as total");
	 	if ($query=$this->db->get('citas')) {
	 		# code...
	 		return $query->row();
	 	}
	 	else{
	 		return false;
	 	}
	 }


	  /* OBTIENE LAS CONSULTAS DE  HOY
		POR CLINICA
		POR MEDICO
		
	 */

	function get_consultas($id_medico,$id_clinica){
	 	$this->db->join('usuarios','usuarios.id=citas.id_medico','right');
	 	//$this->db->join('pacientes','pacientes.id=citas.id_paciente','left');
	 	//$this->db->where('id_medico',$id_medico);
	 	

	 	$this->db->where('finalizada',1);

	 	$this->db->where('citas.id_clinica',$id_clinica);

	 	if ($query=$this->db->get('citas')) {
	 		# code...
	 		$citas=$query->result();

	 		if (isset($citas) and is_array($citas)) {
	 			# code...
	 				foreach ($citas as $key) {
	 					# code...
	 					$key->paciente=$this->usuario_model->get_paciente($key->rut_paciente);
	 				}
	 		}

	 		return $citas;
	 	}

	 	else{
	 		return false;
	 	}

	 }


	 /*OBTIENE EL TOTAL DE GRUPOS POR ID_GRUPO */

	 function get_total_grup($id=''){
		$this->db->select("count(*) as total");
		$this->db->from('usuarios');
		$this->db->where('id_grupo',$id);
		if ($query=$this->db->get()) {
			
			return $query->row();
		}
		else{
			return false;
		}
	}


	 /*OBTIENE EL TOTAL DE MODULOS */


	function get_modulos(){
		
		if ($query=$this->db->get('cat_modulos')) {
			
			return $query->result();
		}
		else{
			return false;
		}
	}

	
	 /*OBTIENE EL TOTAL DE PACIENTES Cambio metodo*/

	function get_pacientes($id_clinica=-1 , $bandera=-1){
		$this->db->select('pacientes.*');
		$this->db->select('cat_previsiones.nombre as previsions');
		$this->db->where('pacientes.id_clinica',$id_clinica);
		
		if ($bandera>0) {
			//se va a mostrar solo en la lista de pacientes
			# code...
			$this->db->where('pacientes.activo',1);
			$this->db->or_where('pacientes.activo',0);

		}


		else{
			//se va a mostrar solo en agenda y lista de pacientes
			# code...
			$this->db->where('pacientes.activo',0);
		}
		
		$this->db->join('cat_previsiones','cat_previsiones.id=pacientes.prevision','right');
			
		
		if ($query=$this->db->get('pacientes')) {
			# code...
			$pacientes=$query->result();

			if (isset($pacientes) and is_array($pacientes)) {
				# code...
				foreach ($pacientes as $key) {
					# code...
					$key->alertas=$this->usuario_model->get_alertas($key->id);
				}
				return $pacientes;
			}
		}
		else{
			return false;
		}

	}

	 /*OBTIENE LAS ALERTAS */
	function get_alertas($id_paciente){
		
		$this->db->where('id_paciente',$id_paciente);

		if ($query=$this->db->get('alertas')) {
			# code...
			return $query->result();
		}
		else{
			return false;
		}

	}

	 /*NO FUNCIONA AUN*/
	function get_menu($id_user){

		

		if ($id_user==3) {
			
			//$this->db->join('cat_modulos','cat_modulos.id=permisos.id_modulo','left');	    	
	    	//$this->db->where('grupo_usuario',$id_user);

	    	if ($query=$this->db->get('cat_modulos')) {
	    		return $query->result();
	    	}
	    	else{
	    		return false;
	    	}
		}
		else{
			//$this->db->join('cat_modulos','cat_modulos.id=permisos.id_modulo','left');	    	
	    	$this->db->where('grupo_usuario',$id_user);

	    	if ($query=$this->db->get('permisos')) {
	    		return $query->result();
	    	}
	    	else{
	    		return false;
	    	}
		  }		
	}

	 /*OBTIENE LOS USARIOS*/
	function get_usuarios($id_clinica){
		   
			$this->db->where('id_clinica',$id_clinica);
			
			
		//$this->db->query("select * from clinica_users where id_user in (select usuarios.id from usuarios where usuarios.activo <> 2) And clinica_users.id_clinica =1");
			
			if ($query=$this->db->get('clinica_users')) {
				$usuarios=$query->result();
                     
				if (isset($usuarios) and is_array($usuarios)) {
					# code...
					foreach ($usuarios as $key) {
						# code...
						 
						// if ($usuario['activo'] != 2) {
							
							$key->users=$this->usuario_model->get_usuario($key->id_user);

							$key->clinicas=$this->usuario_model->get_clinica_info($key->id_clinica);
						// }else{

						// }
					
					}


				}

				return $usuarios;
			}
			else{
				return false;
			}
	}



	/* HACE EL LOGIN DE LOS USUARIOS
	 */
	function get_login($username,$pass){

		
		$this->db->where('usuario',$username);
		//
		$this->db->where('contrasena',$pass);

		

		if ($query=$this->db->get('usuarios')) {


			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->row();
			}

			else{
				return false;
			}
			


		}
		else{
			return false;
		}


	}

		

	 /*OBTIENE EL USUARIO*/
	function get_usuario($id_user){

			$this->db->where('id',$id_user);
            $this->db->where('activo !=', 2);
			if ($query=$this->db->get('usuarios')) {
				# code...

				$usuarios=$query->result();
				# code...
				if (isset($usuarios) and is_array($usuarios)) {
					# code...
					foreach ($usuarios as $key) {
						# code...
						
						$key->grupo=$this->usuario_model->get_grupo_one($key->id_grupo);
					}


				}

				return $usuarios;
			}
			else{
				return false;
			}

	}

	 /*OBTIENE GRUPO POR ID_USER*/
	function get_grupo_one($id){

			$this->db->where('id',$id);

			if ($query=$this->db->get('grupo_usuarios')) {

				$usuarios=$query->result();
				# code...
				return $query->row();
			}
			else{
				return false;
			}

	}

	 /*OBTIENE INFO DE PACIENTES POR EL ID_PACIENTE*/
	function get_paciente($id_paciente){
			$this->db->select('pacientes.*');
			$this->db->select('cat_previsiones.id as id_prevision*');
			$this->db->select('cat_previsiones.nombre as previsions');
			$this->db->where('pacientes.id',$id_paciente);
			$this->db->join('cat_previsiones','cat_previsiones.id=pacientes.prevision','right');
			
			if($query=$this->db->get('pacientes')){
				return $query->row();
			}
			else{
				return false;
			}
	
	}




	 /*OBTIENE LOS MEDICAMENTOS POR ID_CLINICA*/

	function get_medicamentos($id_clinica){
			$this->db->where('id_clinica',$id_clinica);
			if($query=$this->db->get('cat_medicinas')){
				return $query->result();
			}
			else{
				return false;
			}
	}


	 /*OBTIENE INFO DE MEDICAMENTOS POR EL ID_MEDICAMENTO*/
	function get_medicamentos_one($id_medicamento){
		$this->db->select('nombre');
		$this->db->select('nombre_fisticio');
		$this->db->select('concentracion');
		$this->db->select('presentacion');
		$result = $this->db->get_where('cat_medicinas', array('id' => $id_medicamento));
		$contador = $result->num_rows();
		$data = array('medicamentos_receta' => $result);
		foreach ($data['medicamentos_receta']->result() as $fila)  {
			return  $fila->nombre.' / '.$fila->concentracion.' '.$fila->presentacion.' / '.$fila->nombre_fisticio;
        }
	}

	/*OBTIENE INFO DE MEDICAMENTOS POR EL ID_MEDICAMENTO*/

	function get_medicina($id_medicina){
			$this->db->where('id',$id_medicina);

			if ($query=$this->db->get('cat_medicinas')) {
				# code...

				return $query->row();
			}
	}
	/*OBTIENE PRESTACIONES*/
	function get_prestacion(){
		if ($query=$this->db->get('prestaciones')) {
			# code...
			return $query->result();
		}
		else{
			return false;
		}
	}


	/*OBTIENE INFO DE DOCTORES POR ID_CLINICA*/

	function get_doctores($id_clinica){
		$this->db->join('usuarios','usuarios.id=clinica_users.id_user','right');
		$this->db->where('id_grupo',1);
		$this->db->where('clinica_users.id_clinica',$id_clinica);

		if ($query=$this->db->get('clinica_users')) {
			# code...
			return $query->result();
		}
		else{
			return false;
		}
	}

	/*OBTIENE COMUNAS POR CATALOGO*/
	function get_comunas_mias(){
		$this->db->select('comuna_nombre');
		$this->db->select('comuna_id');
		$this->db->select('provincia_id');

		if ($query=$this->db->get("cat_comunas")) {

			
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}

		return false;
	}


	/*OBTIENE REGIONES POR CATALOGO*/

	function get_regiones_mias(){
		$this->db->select('region_nombre');
		$this->db->select('region_id');
		

		if ($query=$this->db->get("cat_regiones")) {

			
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}

		return false;
	}

	/*OBTIENE PROVINCIAS POR CATALOGO*/

	function get_provincias_mias(){
		$this->db->select('provincia_nombre');
		$this->db->select('provincia_id');
		$this->db->select('region_id');

		if ($query=$this->db->get("cat_provincias")) {

			
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}

		return false;
	}

	//OBTIENE LOS MEDICOS Y SUS HORARIOS CON CITAS DEACUERDO A
	//ID_MEDICO = MEDICO
	//FECHA=FECHA DE LA CITA
	function get_Medicos($id_medico=-1,$fecha=-1){


		$this->db->select('nombre');
		$this->db->select('id');
		$this->db->where('id',$id_medico);

		if ($query=$this->db->get('usuarios')) {
			# code...

			if ($query->num_rows()>0) {
				
				$usuarios=$query->result();

				if (is_array($usuarios) and isset($usuarios) and count($usuarios)>0) {

					foreach ($usuarios as $key) {
					# code...

						$key->horarios=$this->usuario_model->get_horariosmedicos($id_medico);
						$key->citas=$this->usuario_model->get_citasMedico($id_medico,$fecha);
					}

					return $usuarios;
				}
			}
		}

	}



	//OBTIENE LOS MEDICOS  
	function get_Medicos_cita(){


		
		$this->db->where('id_grupo',1);

		if ($query=$this->db->get('usuarios')) {
			# code...

			if ($query->num_rows()>0) {
				
				$usuarios=$query->result();


					return $usuarios;
				
			}
		}

	}

	function get_horarios(){
		
        return $query=$this->db->get('horarios')->result();

	}

	/*OBTIENE LOS HORARIOS POR MEDICO*/
	
	function  get_horariosmedicos($id_medico=-1){

		$this->db->where('horarios.id_medico',$id_medico);

		if ($query=$this->db->get('horarios')) {
			# code...

			if ($query->num_rows()>0) {
				# code...

				return $query->row();
			}
		}

	}


	/*OBTIENE LAS CITAS HECHAS POR EL MEDICO*/
	function get_citasMedico($id_medico=-1,$fecha=-1){

		//$this->db->join('usuarios','usuarios.id=citas.id_medico','right');
		$this->db->where('citas.id_medico',$id_medico);
		$this->db->where('citas.finalizada',0);
		$this->db->where('citas.cancelada',0);
		$this->db->where('citas.fecha',$fecha);		

		if ($query=$this->db->get('citas')) {
			# code...

			if ($query->num_rows()>0) {
				# code...

				$citas=$query->result();

				if (isset($citas) and is_array($citas) and count($citas)>0) {
					# code...

					foreach ($citas as $key ) {
					# code...
						$key->consultas=$this->usuario_model->get_consultas_api($key->id);
						$key->recetas=$this->usuario_model->get_recetas_api($key->id);
						$key->archivos=$this->usuario_model->get_archivos_api($key->id);
					}
				}
				

					return $citas;	
			}
		}



	}

	function get_consultas_api($id_cita=-1){
		$this->db->where('id_cita',$id_cita);
		if ($query=$this->db->get("citas_consultas")) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
			return false;
		}
	}


	function get_recetas_api($id_cita=-1){
		$this->db->where('id_cita',$id_cita);
		if ($query=$this->db->get("citas_recetas")) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$recetas=$query->result();
				if (is_array($recetas) and isset($recetas) and count($recetas)>0) {
					# code...
					foreach ($recetas as $key) {
						# code...


						//$string_val = $key->id_medicamento;
						//$parts = array_filter(explode(' | ', $string_val));


						$key->medicamentos=$this->usuario_model->get_medicamentos_clinica();//($parts,-1);

					}

				}
				
				return $recetas;
			}
			return false;
		}
	}


	function get_archivos_api($id_cita=-1){
		$this->db->where('id_cita',$id_cita);
		if ($query=$this->db->get("citas_archivos")) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
			return false;
		}
	}

	/*OBTIENE LAS CITAS HECHAS POR MEDICO*/
	function get_citas_hechas($id_medico=-1){
			$this->db->where('id_medico',$id_medico);
			$this->db->where('finalizada',1);
			$datos=array();
			if ($query=$this->db->get('citas')) {
				# code...
				if ($query->num_rows()) {
					# code...
					$consulta=$query->result();
					if (isset($consulta) and is_array($consulta) and count($consulta)>0) {
						# code...
						foreach ($consulta as $key) {
							# code...
							$key->consultas=$this->usuario_model->get_consultas_api($key->id);
							$key->recetas=$this->usuario_model->get_recetas_api($key->id);
							$key->archivos=$this->usuario_model->get_archivos_api($key->id);
						}
					}

					return $consulta;
				}
			}


	}
	
	
	/*OBTIENE LAS CITAS HECHAS POR ID_PACIENTE*/
	function get_citas_paciente($id_paciente=-1){
			$this->db->where('id_paciente',$id_paciente);
			$this->db->where('finalizada',1);
			$datos=array();
			if ($query=$this->db->get('citas')) {
				# code...
				if ($query->num_rows()) {
					# code...
					$consulta=$query->result();
					if (isset($consulta) and is_array($consulta) and count($consulta)>0) {
						# code...
						foreach ($consulta as $key) {
							# code...
							$key->consultas=$this->usuario_model->get_consultas_api($key->id);
							$key->recetas=$this->usuario_model->get_recetas_api($key->id);
							$key->archivos=$this->usuario_model->get_archivos_api($key->id);
						}
					}

					return $consulta;
				}
			}
	}

	/*OBTIENE EL NOMBRE DE LA CLINICA CON EL ID_CLINICA ANEXANDO 
		LAS CITAS QE TIENE LA CLINICA
	*/
	function get_citas_clinica($id_clinica=-1){
		$this->db->select('clinicas.id');
		$this->db->select('clinicas.nombre');
		
		$this->db->where('id',$id_clinica);
		if ($query=$this->db->get('clinicas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$clinica=$query->result();
				foreach ($clinica as $key ) {
					# code...
					$key->citas=$this->usuario_model->get_clinicas_citas($key->id);
				}
				return $clinica;
			}
		}
			
	}



	/*OBTIENE LAS CITAS POR ID_CLINICA*/
	function get_clinicas_citas($id_clinica=-1){
		$this->db->where('id_clinica',$id_clinica);
			
			$datos=array();
			if ($query=$this->db->get('citas')) {
				# code...
				if ($query->num_rows()) {
					# code...
					$consulta=$query->result();
					if (isset($consulta) and is_array($consulta) and count($consulta)>0) {
						# code...
						foreach ($consulta as $key) {
							# code...
							$key->consultas=$this->usuario_model->get_consultas_api($key->id);
							$key->recetas=$this->usuario_model->get_recetas_api($key->id);
							$key->archivos=$this->usuario_model->get_archivos_api($key->id);
						}
					}

					return $consulta;
				}
			}

	}

	/* OBTIENE LOS MEDICAMENTOS DE LA CLINICA*/ 
	function get_clinica_medicamentos($id_clinica=-1){
		$this->db->where('clinicas.id',$id_clinica);
		if ($query=$this->db->get('clinicas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$clinicas=$query->result();
				if (is_array($clinicas) and is_array($clinicas) and count($clinicas)>0) {
					# code...
					foreach ($clinicas as $key ) {
						# code...
						$key->medicamentos=$this->usuario_model->get_medicamentos_clinica(-1,$key->id);
					}

				}
				return $clinicas;
			}
		}
	}
	/* OBTIENE LOS MEDICAMENTOS Por id_medicamento o id_clinica*/
	function get_medicamentos_clinica($id_medicamento=-1,$id_clinica=-1){
		if ($id_medicamento>0) {
			# code..
			$this->db->where('cat_medicinas.id',$id_medicamento);
		}

		if ($id_clinica>0) {
			# code...
			$this->db->where('cat_medicinas.id_clinica',$id_clinica);
		}

		if ($query=$this->db->get('cat_medicinas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}
	}

	function get_previsiones($id_clinica=-1){

		$this->db->where('id_clinica',$id_clinica);
		if ($query=$this->db->get('cat_previsiones')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				return $query->result();
			}
		}

	}


	/*  ------------- METODOS DE INSERT ------ */ 
	 
	 function insert_clinica($data){

			if (is_array($data) and isset($data)) {
				# code...

				$this->db->insert('clinica_users', $data); 
			}
	 }


	   function insert_user($data){
            
			 
		
	    	if (isset($data) and is_array($data)) {
	    		$this->db->like('rut',$data['rut']);

	    		if ($query=$this->db->get('usuarios')) {
	    			# code...
	    			if ($query->num_rows()>0) {
	    				# code...
	    				return false;
	    			}
	    			else{
					$this->db->insert('usuarios', $data);

					$usuario = $this->db->where('usuarios.rut', $data['rut']);
					// $this->db->get('usuarios');
					// $relacionUserClinica['id_user'] = $usuario['id'];
					// $relacionUserClinica['id_clinica'] = $data['id_clinica'];
					$relacionUserClinica['id_user'] = $this->db->insert_id();
					$relacionUserClinica['id_clinica'] = $data['id_clinica'];
					$this->insert_clinica($relacionUserClinica);
	    			}
	    		}

	    	
	    	}

			
	   }

		function insert_grup($data){

				if (is_array($data) and isset($data)) {
					# code...

					$this->db->insert('grupo_usuarios', $data); 
				}
				
		}

		function insert_pacientes($data){

				if (is_array($data) and isset($data)) {
					# code...
					$this->db->like('rut_otro',$data['rut_otro']);

					if ($query=$this->db->get('pacientes')) {
						# code...
						if ($query->num_rows()>0) {
							# code...
							return false;
						}
						else{
							$this->db->insert('pacientes', $data);
						}
					}
				

					
				}
		}


		function insert_medicamentos($data){
				if (is_array($data) and isset($data)) {
					# code...
					$this->db->insert('cat_medicinas', $data); 
				}
		}



		function insertar_permiso($data){



				if (is_array($data) and isset($data)) {
					# code...

					$this->db->insert('permisos', $data); 

					
				}
		}



		function insert_documento($data){
			if (is_array($data) and isset($data)) {
				$this->db->insert('citas_archivos', $data); 
			}
		}


		function insert_horarios($data){
		    	if (isset($data) and is_array($data)) {
	    			$this->db->where('id_medico', $data['id_medico']);
				$this->db->delete('horarios');
				//$this->db->where('id_fin', $id);
				$this->db->insert('horarios', $data);
		    	}
	    }

		/*  ------------- FIN DE METODOS DE INSERT ------ */ 




		/*  ------------- METODOS DE EDITADO ------ */ 
		function update_paciente($datos,$id_paciente){
			$this->db->where('id', $id_paciente);
			$this->db->update('pacientes',$datos);
			//echo $this->db->last_query();

		}


		function update_usuario($datos,$id_paciente){

			$this->db->where('id', $id_paciente);
			$this->db->update('usuarios',$datos);
			

		}


		function update_medicina($datos,$id_paciente){

			$this->db->where('id', $id_paciente);
			$this->db->update('cat_medicinas',$datos);
			

		}



		function update_grupo($id_grupo,$datos){

			$this->db->where('id', $id_grupo);
			$this->db->update('grupo_usuarios',$datos);

			//echo $this->db->last_query();
			

		}



		function update_perfil($id_paciente,$datos){

			$this->db->where('id', $id_paciente);
			$this->db->update('usuarios',$datos);

			

		}



		function editar($datos,$id_paciente){

			$this->db->where('id', $id_paciente);
			$this->db->update('clinicas',$datos);

		}


		/*  -------------  FIN METODOS DE EDITADO ------ */ 



		/*  ------------- METODOS DE SALTO DE STATUS DE CITAS DE HOY ------ */ 

		function pasar_pendiente($id_paciente){

			$this->db->where('id_paciente', $id_paciente);
			$datos['espera']=0;
			$datos['pendiente']=1;
			$datos['cancelada']=0;
			$datos['consulta']=0;
			$datos['finalizada']=0;
			$this->db->update('citas',$datos);

		}

		function pasar_espera($id_paciente){

			$this->db->where('id_paciente', $id_paciente);
			$datos['espera']=1;
			$datos['pendiente']=0;
			$datos['cancelada']=0;
			$datos['consulta']=0;
			$datos['finalizada']=0;
			$this->db->update('citas',$datos);

		}


		function pasar_consulta($id_paciente){

			$this->db->where('id_paciente', $id_paciente);
			$datos['espera']=0;
			$datos['pendiente']=0;
			$datos['cancelada']=0;
			$datos['consulta']=1;
			$datos['finalizada']=0;
			$this->db->update('citas',$datos);

		}


		function cancelar_consulta($id_paciente){

			$this->db->where('id_paciente', $id_paciente);
			$datos['espera']=0;
			$datos['pendiente']=0;
			$datos['cancelada']=1;
			$datos['consulta']=0;
			$datos['finalizada']=0;
			$this->db->update('citas',$datos);

		}



		function terminar_consulta($id_paciente){

			$this->db->where('id_paciente', $id_paciente);
			$datos['espera']=0;
			$datos['pendiente']=0;
			$datos['cancelada']=0;
			$datos['consulta']=0;
			$datos['finalizada']=1;
			$this->db->update('citas',$datos);

		}

		function eliminar_paciente($id_paciente){

			$this->db->where('id', $id_paciente);
			$this->db->delete('pacientes');

			
		}

		function eliminar_usuarios($id_paciente){

			$this->db->where('id', $id_paciente);
			$this->db->delete('usuarios');
	
		}



		function eliminar_medicina($id_medicina){

			$this->db->where('id', $id_medicina);
			$this->db->delete('cat_medicinas');
			
		}

		/*  ------------- FIN METODOS DE SALTO DE STATUS DE CITAS DE HOY ------ */ 

		/*  ------------- METODOS DE ADMIN CRUD DE CLINICAS ------ */ 

		function adm_clinicas(){
			
			if ($query=$this->db->get('clinicas')) {
				# code...
				return $query->result();
			}
			else{
				return false;
			}
		}


		function adm_eliminar_clinica($id_clinica){

			$this->db->where('id', $id_clinica);
			$this->db->delete('clinicas');
			
		}


		function adm_eliminar_grupo($id_clinica){

			$this->db->where('id', $id_clinica);
			$this->db->delete('grupo_usuarios');
			
		}
		/*  ------------- METODOS DE ADMIN CRUD DE CLINICAS ------ */ 

		// --------------------------------------------------------------------
			/**
			* Get Users
			*
			* @access	private
			* @param	array	conditions to fetch data
			* @return	object	object with result set
			*/
			public function getUsersChat($conditions=array(), $fields='') {
			 
				if(count($conditions)>0) 
				$this->db->where($conditions);
				$this->db->from('usuarios');
				$this->db->order_by("id", "asc");
			 
			 
				if($fields!='')
				$this->db->select($fields);
				else 
				$this->db->select('*');
			 
				$result = $this->db->get();
			 
				return $result;
			 
			 
			}//End of getUsers Function


			function adm_get_user_chat($id_clinica){

				$this->db->select('nombre,id,usuario,apellido_paterno,apellido_materno,foto');
				
				$this->db->where('id_clinica',$id_clinica);


				if ($query=$this->db->get('usuarios')) {
					# code...
					return $query->result();
				}
				else{
					return false;
				}
			}


			function adm_consultas_pendientes($id_medico='',$fecha=''){
				$this->db->join('pacientes','pacientes.id=citas.id_paciente','left');
				$this->db->where("id_medico",$id_medico);
				$this->db->where("pendiente",1);
				$this->db->where("fecha",$fecha);


				if ($query=$this->db->get("citas")) {
					# code...
					return $query->result();
				}
				else{
					return false;
				}
			}


			function adm_consultas_espera($id_medico='',$fecha=''){
				$this->db->join('pacientes','pacientes.id=citas.id_paciente','left');
				$this->db->where("id_medico",$id_medico);
				$this->db->where("espera",1);
				$this->db->where("fecha",$fecha);


				if ($query=$this->db->get("citas")) {
					# code...
					return $query->result();
				}
				else{
					return false;
				}
			}


			function adm_consultas_consulta($id_medico='',$fecha=''){
				$this->db->join('pacientes','pacientes.id=citas.id_paciente','left');
				$this->db->where("id_medico",$id_medico);
				$this->db->where("consulta",1);
				$this->db->where("fecha",$fecha);


				if ($query=$this->db->get("citas")) {
					# code...
					return $query->result();
				}
				else{
					return false;
				}
			}



			function adm_consultas_cancelada($id_medico='',$fecha=''){
				$this->db->join('pacientes','pacientes.id=citas.id_paciente','left');
				$this->db->where("id_medico",$id_medico);
				$this->db->where("cancelada",1);
				$this->db->where("finalizada",0);

				if ($query=$this->db->get("citas")) {
					# code...
					return $query->result();
				}
				else{
					return false;
				}
			}


			function adm_consultas_finalizada($id_medico='',$fecha=''){
				$this->db->join('pacientes','pacientes.id=citas.id_paciente','left');
				$this->db->where("id_medico",$id_medico);
				$this->db->where("finalizada",1);

				if ($query=$this->db->get("citas")) {
					# code...
					return $query->result();
				}
				else{
					return false;
				}
			}

			function adm_motivos(){
				if ($query=$this->db->get("motivos_cancelacion")) {
					# code...
					if ($query->num_rows()>0) {
						# code...
						return $query->result();
					}
				}

				return false;
			}
			
			function get_perfil($id=-1){
				$this->db->where('id',$id);

				if ($query=$this->db->get('usuarios')) {
					# code...
					if ($query->num_rows()>0) {
						# code...
						return $query->row();
					}
				}

				return false;
			}

			function get_clinica_doc($id_clinica){
				
					# code...
					$this->db->where('id_clinica',$id_clinica);
				

				$this->db->where('id_grupo',1);
				

				if ($query=$this->db->get('usuarios')) {
					# code...
					if ($query->num_rows()>0) {
						# code...

						return $query->result();
					}
				}
				return false;
			}


			function migrar_paciente($datos=-1){

					$this->db->like('rut_otro', $datos['rut_otro']);
					$this->db->delete('pacientes');
			

					//$this->db->where('id_fin', $id);
					$this->db->replace('pacientes', $datos);

			}


			function migrar_medicinas($datos=-1){

					$this->db->like('codigo', $datos['codigo']);
					$this->db->delete('cat_medicinas');
			

					//$this->db->where('id_fin', $id);
					$this->db->replace('cat_medicinas', $datos);

			}


			function migrar_medicos($datos=-1){

					$this->db->like('usuario', $datos['usuario']);
					$this->db->delete('usuarios');
			

					//$this->db->where('id_fin', $id);
					$this->db->replace('usuarios', $datos);

			}

				function migrar_citas($datos=-1){

					$this->db->insert('citas', $datos);


				}

			function put_clinica($usuario){
				$this->db->select('usuarios.id');
				$this->db->select('usuarios.id_clinica');

				$this->db->like('usuario',$usuario);

				if ($query=$this->db->get('usuarios')) {
					# code...
					if ($query->num_rows()>0) {
						# code...
						$usuario=$query->result();
						if (isset($usuario) and is_array($usuario) and count($usuario)) {
							# code...
							$datos=array();
							foreach ($usuario as $key) {
								# code...
								$datos['id_user']=$key->id;
								$datos['id_clinica']=$key->id_clinica;
							}

							$this->usuario_model->migrar_clinica_user($datos);
							
							
						}
					}
				}

				
			}


			function migrar_clinica_user($datos=-1){

					$this->db->like('id_user', $datos['id_user']);
					$this->db->delete('clinica_users');
			

					//$this->db->where('id_fin', $id);
					$this->db->replace('clinica_users', $datos);

			}

	
	
}
