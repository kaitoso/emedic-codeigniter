<?php

/**
 * Agenda class
 * 
 * @extends CI_Controller
 	@Ing.LuisCobian
 	@Ing.PedroFernandez
 */
class Agenda extends CI_Controller {
	//Global variable  
    public $outputData;     //Holds the output data for each view
    public $loggedInUser;
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		
		//$this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->database();
        $this->load->library('session');
        $this->load->model('doc_model');
        $this->load->model('usuario_model');
        $this->outputData['listOfUsers']    = $this->usuario_model->getUsersChat();
       
        @session_start();
        $this->load->library('ci_chat');
        if( !isset( $_SESSION['username'] )  || !isset( $_SESSION['user_id'] )  ){
            $_SESSION['username'] = $this->session->userdata('username');
            $_SESSION['user_id'] = $this->session->userdata('user_id');
        }
	}


	/*
		DESPLIEGA EL INDEX DEL CONTROLADOR
		*/
	
	
	public function index(){
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

			$data['scripts'] = 'usuario/scripts.php';
			$this->load->view("inc/header",$data); 
			$this->load->view("inc/navbar",$data); 
			$this->load->view("inc/lateral",$data); 
			$this->load->view("usuario/agenda/index",$data); 
			$this->load->view("inc/footer"); 
			$this->load->view("inc/scripts_agenda"); 
		}
	}


	/*WEB SERVICES PARA EL STATUS DEL DOCTOR*/
	public function status() {

		$result = $this->db->get_where('usuarios', array('id_grupo' => 3));
	 	$data = array('consulta'=>$result);

	 	$medicosPacientes = array('doctors' => $data);

		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('agenda/status',$medicosPacientes);
		$this->load->view('chat/chat', $this->outputData);
		$this->load->view('footer');
	}

	/*WEB SERVICES PARA CARGAR PACIENTES*/
	public function loadPacientes(){//en este metodo igual pcargo el campo por si las moscas

		$this->db->select('pacientes.nombre,
							pacientes.apellido_paterno,
							pacientes.apellido_materno,
							pacientes.id,pacientes.citado,pacientes.activo status');
        //$this->db->from('pacientes');
        $this->db->where('pacientes.activo',1);
        $queryCustom = $this->db->get("pacientes");

        $data = array('pacientes' => $queryCustom);



      
        return $data;

	}


	/*WEB SERVICES PARA INSERTAR ABONOS DE LA TABLA DEPOSITOS*/

	public function put_abonos(){
		/*este motodo te inserta en la tabla depositos para ir quitando a la suma 
			de la cita ya cuando llegue a 0 el resto enviar al metodo put_pagos
		*/
		$data = array(
			'id_cita' => $_POST['id_cita'],
            'deposito' => $_POST['deposito_cita'],
			'resto' => $_POST['resto'],
			'tipo' => $_POST['tipo_pago'],
			'no_documento' => $_POST['no_documento'],
			'comentario' => $_POST['comentario_pago']
        );
        var_dump($data);
		//var_dump($datos);
		$this->db->insert('depositos',$data);
		//echo $this->db->last_query();
	}


	/*WEB SERVICES PARA INSERTAR PAGO*/

	public function put_pagos(){
		//cuando llegue a cero el deposito mandar por ajax method post los siguientes valores para insertar
		//a pagos
		$data = array(
            'id_cita' => $_POST['id_cita'],
            'monto' => $_POST['deposito_cita'],
            'resto' => $_POST['resto'],
			'tipo' => $_POST['tipo_pago'],
			'no_documento' => $_POST['no_documento'],
			'comentario' => $_POST['comentario_pago']
        );
		        
		$this->db->select('pagos.id_cita');
		$this->db->where('id_cita',$_POST['id_cita']);
		//$this->db->order_by('id','desc');
		//$this->db->limit(1);
		var_dump($data);

		if ($query=$this->db->get('pagos')) {
			//var_dump($result);
			if($query->num_rows()>0) {
				$result=$query->row()->id_cita;
	            $this->db->where('id_cita', $result);
	            $this->db->update('pagos', $data);
	            //echo $this->db->last_query();
			} else {
				//$result=0;
				$this->db->insert('pagos', $data);
				//echo $this->db->last_query();
			}
		}
			
        
		
	}

	/*WEB SERVICES PARA INSERTAR LA CITA */
	public function put_citas_consultas(){
		$data = array(
            'id_cita' => $_POST['id_cita'],
            'anamnesis' => $_POST['anamnesis'],
            'examen_fisico' => $_POST['examen_fisico'],
			'diagnostico' => $_POST['diagnostico'],
			'indicaciones' => $_POST['indicaciones']
        );


        if ($this->db->insert('citas_consultas',$data)) {

        			//$datos['funciono']="Success";

        			//echo json_encode($datos);
        	}
        	else{
        		//$datos['funciono']="Error";

        		//	echo json_encode($datos);
        	}

        	//echo json_encode($data);
       

	}
	
	
	// REGRESA DATOS DE ULTIMO MEDICAMENTO AGREGADO A LA BASE
	public function ultimo_medicamento(){
		$datos=array();		
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		if($query=$this->db->get('cat_medicinas')){
			
			if($query->num_rows()>0){
				
				$consulta=$query->result();
				
				if(isset($consulta) and is_array($consulta) and count($consulta)>0){
					foreach($consulta as $key){
						
						$datos['medicamentos']=$key;
						
						
					}
				}
				echo json_encode($datos);
			}
		}
	}


	/*WEB SERVICES PARA INSERTAR LAS RECETAS*/

	public function put_citas_recetas(){
		
		$datos=array();

		$data = array(
            'id_cita' => $_POST['id_cita'],
            'id_medicamento' => $_POST['id_medicamento'],
            'cantidad' => $_POST['cantidad'],
            'indicaciones' => $_POST['indicaciones'],
			'resultados' => $_POST['resultados'],
			
        );

         if (is_array($data) and isset($data) and count($data)>0 and !is_null($data)) {


        	# code...

        	if ($this->db->insert('citas_recetas',$data)) {

        			//$datos['funciono']="Success";

        			//echo json_encode($datos);
        	}
        	else{
        		$datos['funciono']="Error";

        			//echo json_encode($datos);
        	}
        	
        }
  
 	}
 	/*WEB SERVICES QUE DESPLIEGA LAS RECETAS QUE ESTAN ACTIVAS*/
 	public function get_recetas_citas(){
		$this->db->where('id_cita',$_GET['id_cita']);
		$this->db->order_by('id','desc');
		if ($query=$this->db->get('citas_recetas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...
				$recetas=$query->result();
				$i = 0;
				$inc_r = 0;
				foreach ($recetas as $key) {
					# code...
					$id_medicamento_receta = explode( " | ",$key->id_medicamento);
					//$medicamento_receta = $id_medicamento_receta;
					$cantidad_receta = explode( " | ",$key->cantidad);
					$indicaciones_receta = explode( " | ",$key->indicaciones);
					
					echo "<div id='receta_".$inc_r."'>
							<div class='pull-right' style='position:absolute;right:5px;top:50%;transform:translateY(-50%);width:30px;'>
								<a href='javascript:void(0)' class='btn btn-link btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>
							    <a href='../plantilla2/pages/receta.php' class='btn btn-link btn-sm' target='_blank'><span class='glyphicon glyphicon-print'></span></a>
						    </div>";
					foreach($indicaciones_receta as $i=>$key) {
						if($key!=''){
							echo "<div class='receta_grupo'>
										<span class='hidden' value='".$id_medicamento_receta[$i]."'>".$id_medicamento_receta[$i]."</span>
										<span>".$this->usuario_model->get_medicamentos_one($id_medicamento_receta[$i])."</span><br>
									    <span>".$cantidad_receta[$i]."</span><br>
									    <span>".$indicaciones_receta[$i]."</span><br>	
									  </div>";
						}
					}
					echo "</div>";
					$inc_r++;	
					$i++;
				}
			}
			
		}
	}

	
	/*WEB SERVICES PARA DESPLEGAR LOS MEDICAMENTOS DE LA CITA*/
	public function get_medicamentos_citas(){

		if (isset($_GET['id_cita'])) {
			# code...
			$id_cita=$_GET['id_cita'];
		}
		$datos=array();

		$this->db->select('id_medicamento');

		$this->db->where('id_cita',$id_cita);

		if ($query=$this->db->get('citas_recetas')) {
			# code...
			if ($query->num_rows()>0) {
				# code...

				return $query->result();

				

			}
		}

		return false;
	}





	/*WEB SERVICES PARA DESPLEGAR EL ULTIMO ABONO DE LA CITA*/

	public function get_ultimo_abono(){
		//ORDER BY id DESC LIMIT 1
		/*trae el ultimo restante de la cantidad de arriba 

		sr usted tiene que tomar el ultimo restante y ponerlo como 
		a pagar y irlo restando hasta que llegue a 0
		*/
		
		/*$this->db->select_sum('deposito');
		$result = $this->db->get('depositos')->row();  
		return $result->amount;*/
		
		$result = 0;
		$this->db->select('depositos.id_cita');
		//$this->db->select('depositos.deposito');
		$this->db->select_sum('depositos.deposito');
		//$this->db->select('depositos.resto');
		$this->db->where('id_cita',$_POST['id_cita']);
		$this->db->order_by('id','desc');
		//$this->db->limit(1);

		if ($query=$this->db->get('depositos')) {
			if ($query->num_rows()>0) {
				$result=$query->row()->deposito;
			} else {
				return false;
			}
		}
		echo $result;
	}



		/*trae  toda las citas por id_paciente detalle
		completo de la cita
		*/

	function get_citasPacientes(){	
		$this->db->select('citas.*');
		$this->db->select('prestaciones.nombre prestacion');
		$this->db->select('usuarios.nombre medico');
		//$paciente=$this->input->get('id_paciente');
		$this->db->where('id_paciente',$_POST['id_paciente']);
		$this->db->where('citas.cancelada',0);
		$this->db->where('citas.finalizada',0);
		$this->db->join('prestaciones','prestaciones.id = citas.id_prestacion','left');
		$this->db->join('usuarios','usuarios.id = citas.id_medico','left');
		if ($query=$this->db->get('citas')) {
			if ($query->num_rows()>0) {
				$citas=$query->result();
				$datos=array();
				if (isset($citas) and is_array($citas) and count($citas)>0) {
					foreach ($citas as $key ) {
						$datos[]=$key;
					}
					echo json_encode($datos);
				}
			}
			else{
				echo 0;
			}
		}
	}
	/*WEB SERVICES PARA DESPLEGAR LA LISTA DE DEPOSITOS DE LA CITA*/
	public function lista_depositos_por_cita(){
		$this->db->where('id_cita',$_POST['id_cita']);
		if ($query=$this->db->get('depositos')) {
			if ($query->num_rows()>0) {
				$depositos=$query->result();
				foreach ($depositos as $key) {
					echo "<tr>";
						echo "<td>".$key->tipo."</td>";
						echo "<td>".$key->deposito."</td>";
						echo "<td>".$key->no_documento."</td>";
						echo "<td>".$key->comentario."</td>";
						echo "<td>";
							echo "<center>
									<a href='javascript:void(0)' class='btn btn-danger btn-sm' onclick='eliminar_pago(".$key->id.",".$_POST['id_cita'].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>
								</center>";
						echo "</td>";
					echo "</tr>";
				}
			} else {
				echo '<tr><td class="text-center" colspan="5">No se han realizado pagos asociados a esta consulta.</td></tr>';
			}
		}
	}
	

	/*WEB SERVICES PARA EL LLENADO DEL PACIENTE*/
	public function llenar_datos_paciente(){
	
		//señor aqui cargo el campo que ocupa para bloquear el paciente
		$this->db->select('pacientes.rut_otro rut_otro,
						   pacientes.email email');
							
        $result = $this->db->get_where('pacientes', array('id' => $_POST['id_paciente']));
        $result->num_rows();
	 	$data = array('pacientes' => $result);
	 	$datosPaciente = '';
	 	foreach ($data['pacientes']->result() as $fila) {
		 	$datosPaciente .= $fila->rut_otro.','.$fila->email;
	 	}
	 	
	 	echo $datosPaciente;
	}


	/*WEB SERVICES PARA DESPLEGAR LAS ALERTAS POR MEDICO*/
	/*public function ago($time) {
	    $periodos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año", "década");
	    $duraciones = array("60","60","24","7","4.35","12","10");
	    $now = time();
	    $diferencia = $now - $time;
	 
	    for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
	        $diferencia /= $duraciones[$j];
	    }
	    $diferencia = round($diferencia);
	 
	    if($diferencia != 1) {
	        if($j != 5){
	            $periodos[$j].= "s";
	        }else{
	            $periodos[$j].= "es";
	        }
	    }
	 
	   return "hace $diferencia $periodos[$j]";
	}*/
	
	public function alertas_por_medico(){
		$this->db->select('*');
		$this->db->from('alertas AS A');
		$this->db->select('M.nombre motivo');
		$this->db->select('C.observacion observacion');
		$this->db->select('P.foto foto');
		$this->db->join('motivos_cancelacion AS M','M.id = A.motivo_cancelacion','INNER');
		$this->db->join('citas AS C','C.id = A.id_cita','INNER');
		$this->db->join('pacientes AS P','P.id = A.id_paciente','INNER');
		$this->db->where('A.id_medico', $_GET['id_medico']);
		$this->db->or_where('P.id','A.id_paciente');
		
		
		
		//var_dump($this->db->get());
		if($query = $this->db->get()) {
			$contador = $query->num_rows();
			if($contador != 0){
				$alertas=$query->result();
				$tooltip = "<ul class='media-list pull-right'>
		                            <li class='dropdown-header'>Notificaciones(".$contador.")</li>";
		                            //var_dump($alertas);
				foreach ($alertas as $key) {
					$periodos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año", "década");
					$duraciones = array("60","60","24","7","4.35","12","10");
				    $now = time();
					$diferencia = $now - $key->fecha_cancelada." ".$key->hora_cancelada.":00";
					for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
				        $diferencia /= $duraciones[$j];
				    }
				    $diferencia = round($diferencia);
				 
				    if($diferencia != 1) {
				        if($j != 5){
				            $periodos[$j].= "s";
				        }else{
				            $periodos[$j].= "es";
				        }
				    }
		    
					$tooltip .= "<li class='media cont_not'>
		                                <a href='javascript:;'>
		                                    <div class='media-left'><img src='../img/users/".$key->foto."' class='media-object' alt=''></div>
		                                    <div class='media-body'>
		                                        <h6 class='media-heading'>".$key->motivo."</h6>
		                                        <p>".$key->observación."</p>
		                                        <div class='text-muted f-s-11' id='naw_time'>Hace ".$diferencia." ".$periodos[$j]."</div>
		                                    </div>
		                                </a>
		                            </li>";
				}
				$tooltip.="<li class='dropdown-footer text-center'>
		                               <a href='javascript:;'>Ver más</a>
		                         </li>
							</ul>";
				echo $tooltip;
			}else{
				$tooltip = "<ul class='media-list'>
		                            <li class='dropdown-header'>Notificaciones (0)</li>
		                            <li class='media text-center'><a href='javascript:;'>No hay notificaciones para mostrar</a></li>
		                        </ul>";
				echo $tooltip;
			}
		}
	}
	
	
	/*WEB SERVICES PARA DESPLEGAR LAS ALERTAS POR PACIENTE*/
	public function alertas_por_paciente(){
		$this->db->select('alertas.*');
		$this->db->select('motivos_cancelacion.nombre motivo');
		$this->db->where('id_paciente',$_POST['id_paciente']);
		$this->db->join('motivos_cancelacion','motivos_cancelacion.id=alertas.motivo_cancelacion','left');
		if ($query=$this->db->get("alertas")) {
			# code...
			$contador = $query->num_rows();
			$alertas=$query->result();
			$tooltip = "<ul>";
			foreach ($alertas as $key) {
				# code...
				$tooltip .= "<li>".$key->fecha_cancelada."-: ".$key->motivo."</li>";
			}

			 $tooltip.="</ul>";

			 echo $contador."|".$tooltip;
		}
	}


	/*WEB SERVICES PARA DESPLEGAR LOS DIAS LABORALES DE LOS MEDICOS*/

	public function dias_laborales_medico(){
		$id_medico = base64_decode($_POST['id_medico']);
		$dias_citas = base64_decode($_POST['fecha']);
		$result = $this->db->get_where('horarios', array('id_medico' => $id_medico));
        $data = array('horarios' => $result);
        $semana_laboral = $data['horarios']->result()[0]->descanzo_semana;
		$dias = explode(",", $semana_laboral);
		$dias_totales = ['Do','Lu','Ma','Mi','Ju','Vi','Sa'];
		$diasLaboralesTotales = array_diff($dias_totales,$dias); //compara los dos arreglos de dias y devuelve los que no son laborales
        $disabled='[';
        foreach ($diasLaboralesTotales as $key) {
        	if ($key =="Do") {
        		$disabled = $disabled.'0,';
        	}elseif($key=="Lu") {
        		$disabled=$disabled.'1,';
        	}elseif($key=="Ma") {
        		$disabled=$disabled.'2,';
        	}elseif($key=="Mi") {
        		$disabled=$disabled.'3,';
        	}elseif($key=="Ju") {
        		$disabled=$disabled.'4,';
        	}elseif($key=="Vi") {
        		$disabled=$disabled.'5,';
        	}elseif($key=="Sa") {
        		$disabled=$disabled.'6,';
        	}elseif($key=="") {
        		$disabled=$disabled.'7';
        	}
        }
        $disabled2 = substr($disabled, 0, -1);
        $disabled3 = $disabled2."]";
        $calendario = "$('#calendarioDia').datepicker('destroy');
				        $('#calendarioDia').datepicker({
						    	language: 'es',
					        todayHighlight: true,
					        daysOfWeekDisabled: ".$disabled3.",
					        startDate: '0',
					        endDate: ''
					    }).on('changeDate', function(e) {
							select_dia_horario(".$id_medico.", ".$dias_citas.");
						    e.stopImmediatePropagation();
						});";
		echo $calendario;
	}

	/*WEB SERVICES LAS PRESTACIONES*/
	public function prestaciones_medico(){
		$id_medico = base64_decode($_POST['id_medico']);
		$prestaciones_medico = $this->carga_prestaciones_por_medico($id_medico);
		$data = '';
		foreach ($prestaciones_medico['prestaciones_medico']->result() as $fila) {
			$data .= '<option value="'.$fila->id.'">'.$fila->nombre.'</option>';
		}
		//print_r($prestaciones_medico['prestaciones_medico']->result());
		echo $data;
	}


	


	/*WEB SERVICES PARA DESPLEGAR LAS PRESTACIONES POR DOCTOR*/
	
	public function carga_prestaciones_por_medico($id_medico){
		$this->db->select('prestaciones.nombre , prestaciones.id, prestaciones.costo');
		$this->db->from('prestaciones');
		$this->db->join('doctoresprestaciones', 'doctoresprestaciones.id_prestacion = prestaciones.id');
		$this->db->where('doctoresprestaciones.id_medico', $id_medico);
		$this->db->order_by("doctoresprestaciones.is_default", "desc");
		$g = $this->db->get();
		$data = array('prestaciones_medico' => $g);
        return $data;
	}
	
	/*WEB SERVICES PARA DESPLEGAR LAS CITAS DEL DIA*/
	public function carga_citas_por_dia($id_medico,$fecha){
		if (is_numeric($fecha)) {
			$fecha = date('d-m-Y');
		}
		$result = $this->db->get_where('citas', array('fecha' => $fecha,'id_medico'=>$id_medico, 'tipo' => 'normal','cancelada' =>0));
        $data = array('citas_del_dia' => $result);
        return $data;
	}

	/*WEB SERVICES PARA DESPLEGAR LOS SOBRECUPOS DEL DIA*/
	public function carga_sobrecupos_por_dia($id_medico,$fecha){
		if (is_numeric($fecha)) {
			$fecha = date('d-m-Y');
		}
		$result = $this->db->get_where('citas', array('fecha' => $fecha,'id_medico'=>$id_medico, 'tipo' => 'sobrecupo','cancelada' =>0));
        $data = array('citas_del_dia' => $result);
        return $data;
	}

	/*WEB SERVICES PARA DESPLEGAR LOS SOBRECUPOS POR MEDICOS*/
	public function carga_horario_sobrecupo_por_medico(){
		$id_medico = base64_decode($_POST['id_medico']);
		$result = $this->db->get_where('horarios',array('id_medico'=>$id_medico));
        $data = array('horarios_medico' => $result);
        if (empty($data['horarios_medico']->result())) {
        	die();
        }
        $inicio = $data['horarios_medico']->result()[0]->hora_inicio;
		$inicio_array = explode(":", $inicio);
		$fin = $data['horarios_medico']->result()[0]->hora_fin;
		$fin_array = explode(":", $fin);
		function echo_timelist_sobrecupo ($i, $j, $comentario) {
			$fecha_agenda = base64_decode($_POST['fecha']);
			$hora_local =mktime(date('H'),date('i')); 
			$hora=getdate($hora_local);
			$hora_exacta = $hora['hours'];
			if($hora_exacta <= 9 ) {
				$hora_exacta = '0'.$hora_exacta;
			}
			$minuto_exacto = $hora['minutes'];
			if($minuto_exacto <= 9 ) {
				$minuto_exacto = '0'.$minuto_exacto;
			}
			$hora_actual = $hora_exacta.':'.$minuto_exacto;
			echo '<option ';
							if (date("d-m-Y") == base64_decode($fecha_agenda) && str_pad($i,2,'0',STR_PAD_LEFT).':'.str_pad($j,2,'0',STR_PAD_LEFT)<=$hora_actual){
								echo 'class="hidden"';
							}
				echo 'value="'.str_pad($i,2,'0',STR_PAD_LEFT).':'.str_pad($j,2,'0',STR_PAD_LEFT).'">'.str_pad($i,2,'0',STR_PAD_LEFT).':'.str_pad($j,2,'0',STR_PAD_LEFT).'</option>';
		}
		for ($i = $inicio_array[0]; $i <= $fin_array[0]; $i++){
		  for ($j = 0; $j <= 45; $j+=15){
		  		echo_timelist_sobrecupo($i, $j,"");
		  }
		}
		echo_timelist_sobrecupo($fin_array[0], $fin_array[1],"");
	}

	
	public function lista_citas_medico() {
		$login=$this->session->userdata('autenticado');
		if($login['id_grupo']==="1"){
			$_GET['id_medico'] = $login['user_id'];
		}
	    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.pendiente pendiente,
							citas.espera_examen espera_examen,
							citas.tipo tipo,
							citas.id_medico id_medico,
							citas.rut_paciente rut_paciente,
							citas.pagado pagado,
							prestaciones.costo costo_prestacion,
							prestaciones.nombre nombre_prestacion,
							pacientes.id id_paciente,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.apellido_materno apellido_materno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_GET['id_medico'],'pendiente'=>1, 'cancelada'=>0));

		$result = $this->db->get('usuarios');
		$citas_dia = array('reporte_citas'=>$queryCustom);

	    	//------------------
	
	    	//------------------

        $data = '';
		if (!empty($citas_dia['reporte_citas']->result())) {
			foreach ($citas_dia['reporte_citas']->result() as $fila) {
				$data .= '<tr style="background-color: #fcf8e3 !important;">
									<td>'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</td>
									<td>'.$fila->hora.'</td>
									<td>'.$fila->comentario.'</td>
									<td>'.$fila->rut_otro.'</td>
									<td>'.$fila->tipo.'</td>';
									
			$data .= '</tr>';
			}
		} else {
			$data .= '<tr>
	                           <td colspan="7"><center>No hay citas este día para el médico</center></td>
	                        </tr>';
		}
        echo $data;
	}

//----------------------------------------------------------------PINTAR TABLAS STATUSES----------------------------------------
    public function citas_pendientes_hoy(){
		$login=$this->session->userdata('autenticado');
		if($login['id_grupo']==="1"){
			$_GET['id_medico'] = $login['user_id'];
		}
	    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.pendiente pendiente,
							citas.espera_examen espera_examen,
							citas.tipo tipo,
							citas.id_medico id_medico,
							citas.rut_paciente rut_paciente,
							citas.pagado pagado,
							prestaciones.costo costo_prestacion,
							prestaciones.nombre nombre_prestacion,
							pacientes.id id_paciente,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.apellido_materno apellido_materno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_GET['id_medico'],'pendiente'=>1, 'cancelada'=>0));

		$result = $this->db->get('usuarios');
		$citas_dia = array('citas_del_dia'=>$queryCustom);

	    	//------------------
	
	    	//------------------

        $data = '';
		if (!empty($citas_dia['citas_del_dia']->result())) {
			foreach ($citas_dia['citas_del_dia']->result() as $fila) {
				$data .= '<tr style="background-color: #fcf8e3 !important;" class="cn_cita">
									<td>'.$fila->id.'</td>
									<td>';
										if ( $fila->tipo == 'normal' ) {
											$data .='<label class="label label-success">Normal</label>'; 
										} else {
											$data .='<label class="label label-warning">Sobrecupo</label>';
										}
										if ( $fila->espera_examen ==1 ) {
											$data.='&nbsp;<label class="label label-danger">Espera por examen</label>';
										}
									$data .='</td>
									<td>'.$fila->hora.'</td>
									<td>'.$fila->comentario.'</td>
									<td>'.$fila->rut_otro.'</td>
									<td>'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</td>';
									if( $login['id_grupo'] != 1 ) {
										$data .='<td>
															<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_espera(\''.$fila->id.'\',\'1\',\''.$fila->id_medico.'\');">Enviar a espera</button>
															&nbsp;<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalCancelar" onclick="abre_modal_cancela('.$fila->id_medico.','.$fila->id_paciente.','.$fila->id.',\''.$fila->hora.'\',1)"><i class="fa fa-times" aria-hidden="true"></i></button>
															&nbsp;<button type="button"';
									    if( $fila->pagado != 1) { 
										    $data .= 'class="btn btn-warning btn-sm"';
										} else {
											$data .= 'class="btn btn-success btn-sm"';
										}
										$data .= ' float-right" data-toggle="modal" data-target="#modalPago" onclick="abre_modal_pagar_consulta('.$fila->id.',\''.$fila->hora.'\',\''.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'\',\''.$fila->nombre_prestacion.'\',\''.$fila->costo_prestacion.'\')" title="Pagar consulta"><i class="fa fa-usd" aria-hidden="true"></i></button>
										</td>';
									}
			$data .= '</tr>';
			}
		} else {
			$data .= '<tr>
	                           <td colspan="7"><center>No hay citas pendientes para este doctor</center></td>
	                        </tr>';
		}
        echo $data;
	}

	public function citas_espera_hoy(){
		$login=$this->session->userdata('autenticado');
	    	$this->db->select('citas.id id, 
								citas.hora hora,
								citas.comentario comentario,
								citas.tipo tipo,
								citas.espera_examen espera_examen,
								citas.id_medico id_medico,
								citas.rut_paciente rut_paciente,
								citas.pagado pagado,
								prestaciones.costo costo_prestacion,
								prestaciones.nombre nombre_prestacion,
								pacientes.id id_paciente,
								pacientes.nombre nombre,
								pacientes.apellido_paterno apellido_paterno,
								pacientes.apellido_materno apellido_materno,
								pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_GET['id_medico'],'espera'=>1,'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);
	
	    	//------------------
	
        $data = '';
		if (!empty($citas_dia['citas_del_dia']->result())) {
			foreach ($citas_dia['citas_del_dia']->result() as $fila) {
				$data .= '<tr class="cn_cita">
									<td>'.$fila->id.'</td>
									<td>';
										if ( $fila->tipo == 'normal' ) {
											$data .='<label class="label label-success">Normal</label>'; 
										} else {
											$data .='<label class="label label-warning">Sobrecupo</label>';
										}
										
										if ( $fila->espera_examen ==1 ) {
											$data.='&nbsp;<label class="label label-danger">Pendiente por examen</label>';
										}
									$data.='</td>
									<td>'.$fila->hora.'</td>
									<td>'.$fila->comentario.'</td>
									<td>'.$fila->rut_otro.'</td>
									<td>'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</td>
									<td>
									    <button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_pendiente(\''.$fila->id.'\',\'0\',\''.$fila->id_medico.'\');">Regresar a pendiente</button>
									    <button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_consulta(\''.$fila->id.'\',\'2\',\''.$fila->id_medico.'\');">Enviar a consulta</button>';
									    	if( $login['id_grupo'] != 1 ) {
										    	$data .= '&nbsp;<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalCancelar" onclick="abre_modal_cancela('.$fila->id_medico.','.$fila->id_paciente.','.$fila->id.',\''.$fila->hora.'\',1)"><i class="fa fa-times" aria-hidden="true"></i></button>';
									    		$data .= '&nbsp;<button type="button" ';
										    if( $fila->pagado != 1) { 
											    $data .= 'class="btn btn-warning btn-sm"';
											} else {
												$data .= 'class="btn btn-success btn-sm"';
											}
											$data .= ' float-right" data-toggle="modal" data-target="#modalPago" onclick="abre_modal_pagar_consulta('.$fila->id.',\''.$fila->hora.'\',\''.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'\',\''.$fila->nombre_prestacion.'\',\''.$fila->costo_prestacion.'\')" title="Pagar consulta"><i class="fa fa-usd" aria-hidden="true"></i></button>';
										}
									$data .= '</td>
								</tr>';
			}
		} else {
			$data .= '<tr>
	                           <td colspan="7"><center>No hay citas en espera para este doctor</center></td>
	                        </tr>';
		}
        echo $data;
	}

	public function citas_espera_examen_hoy(){
		$login=$this->session->userdata('autenticado');
	    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.tipo tipo,
							citas.espera_examen espera_examen,
							citas.id_medico id_medico,
							citas.rut_paciente rut_paciente,
							prestaciones.costo costo_prestacion,
							prestaciones.nombre nombre_prestacion,
							pacientes.id id_paciente,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.apellido_materno apellido_materno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_GET['id_medico'],'espera_examen'=>1, 'consulta' =>0,'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    		//------------------

        $data = '';
		if (!empty($citas_dia['citas_del_dia']->result())) {
			foreach ($citas_dia['citas_del_dia']->result() as $fila) {
				$data .= '<tr class="cn_cita">
									<td>'.$fila->id.'</td>
									<td>';
										if ( $fila->tipo == 'normal' ) {
											$data .='<label class="label label-success">Normal</label>'; 
										} else {
											$data .='<label class="label label-warning">Sobrecupo</label>';
										}
										
										if ( $fila->espera_examen ==1 ) {
											$data.='&nbsp;<label class="label label-danger">Pendiente por examen</label>';
										}
									$data.='</td>
									<td>'.$fila->hora.'</td>
									<td>';
				                        if ($fila->comentario=="---") {
											# code...
											$data .= "&nbsp;";
										} else {
											$data .= $fila->comentario;
										}

	                                $data .='</td>
									<td>'.$fila->rut_otro.'</td>
									<td>'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</td>
									<td>
									    <button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_consulta(\''.$fila->id.'\',\'2\',\''.$fila->id_medico.'\');">Enviar a consulta</button>
									</td>
								</tr>';
			}
		} else {
			$data .= '<tr>
	                           <td colspan="7"><center>No hay citas en espera para este doctor</center></td>
	                        </tr>';
		}
        echo $data;
	}

	public function citas_consulta_hoy(){
		$login=$this->session->userdata('autenticado');


    		$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.id_medico id_medico,
							citas.rut_paciente rut_paciente,
							citas.pagado pagado,
							citas.espera_examen espera_examen,
							citas.tipo tipo,
							prestaciones.costo costo_prestacion,
							prestaciones.nombre nombre_prestacion,
							pacientes.id id_paciente,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.apellido_materno apellido_materno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_GET['id_medico'],'consulta'=>1,'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    	//------------------

        $data = '';
		if (!empty($citas_dia['citas_del_dia']->result())) {
			foreach ($citas_dia['citas_del_dia']->result() as $fila) {
				$data .= '<tr class="cn_cita">
									<td>'.$fila->id.'</td>
									<td>';
										if ( $fila->tipo == 'normal' ) {
											$data .='<label class="label label-success">Normal</label>'; 
										} else {
											$data .='<label class="label label-warning">Sobrecupo</label>';
										}
										if ( $fila->espera_examen ==1 ) {
											$data.='&nbsp;<label class="label label-danger">Pendiente por examen</label>';
										}
										if( $fila->pagado != 1) { 
										    $data .= '&nbsp;<label class="label label-warning">Pago pendiente</label>';
										} else {
											$data .= '&nbsp;<label class="label label-success">Pagado</label>';
										}
					$data .= '</td>
									<td>'.$fila->hora.'</td>
									<td>'.$fila->comentario.'</td>
									<td>'.$fila->rut_otro.'</td>
									<td>'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</td>';
										if( $login['id_grupo'] != 2 ) {
											$data .= '<td>
																<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_espera_examen(\''.$fila->id.'\',\'1\',\''.$fila->id_medico.'\');">Pendiente por Examen</button>
															    <button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_terminada('.$fila->id_paciente.','.$fila->id.',\'3\','.$fila->id_medico.');">Terminar Consulta</button>
															</td>'; 
										}	
				 $data .= '</tr>';
								  		
			}
		} else {
			$data .= '<tr>
								<td colspan="7"><center>No hay citas en consulta para este doctor</center></td>
							</tr>';
		}

        echo $data;

	}

	public function cita_consultorio(){
		$login=$this->session->userdata('autenticado');
		$datos['medicamentos']=$this->doc_model->get_medicamentos($login['id_clinica']);
    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.id_medico id_medico,
							citas.rut_paciente rut_paciente,
							citas.pagado pagado,
							citas.espera_examen espera_examen,
							citas.tipo tipo,
							prestaciones.costo costo_prestacion,
							prestaciones.nombre nombre_prestacion,
							pacientes.id id_paciente,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.apellido_materno apellido_materno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_GET['id_medico'],'consulta'=>1,'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    	//------------------

        $data = '';
		if (!empty($citas_dia['citas_del_dia']->result())) {
			foreach ($citas_dia['citas_del_dia']->result() as $fila) {
				$data .= '<div class="menu_sup">
                            <div class="btn-group text-center pull-right m-t-0">
                                <button type="button"  class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_historial_citas" onclick="consultas_anteriores(\''.$fila->id_paciente.'\')"><i class="fa fa-eye" aria-hidden="true"></i> Consultas anteriores</button>
                                <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_pacientes" onclick="ver_paciente(\''.$fila->id_paciente.'\')"><i class="fa fa-eye" aria-hidden="true"></i> Datos del paciente</button>
                                <!--a href="#" class="btn btn-success btn-sm">
                                    Buscar paciente
                                </a-->
                            </div>
                        </div>
                        <h3 class="m-t-0">Paciente en consulta</h3>
                        <form class="form-inline">
                        		<div class="hidden">
                                <p class="form-control-static" id="id_medico">'.$fila->id_medico.'</p>
                            </div>
                        	    <div class="form-group m-r-15 hidden">
                                <label for="cPaciente">ID Cita: </label>
                                <p class="form-control-static" id="cIDcita">'.$fila->id.'</p>
                            </div>
                            <div class="form-group m-r-15">
                                <label for="cPaciente">Paciente: </label>
                                <p class="form-control-static" id="cPaciente">'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</p>
                            </div>
                            <div class="form-group m-r-15">
                                <label for="cRut">Rut: </label>
                                <p class="form-control-static" id="cRut">'.$fila->rut_otro.'</p>
                            </div>

                            <div class="form-group m-r-15">
                                <label for="cTipo">Tipo agenda: </label>
                                <p class="form-control-static" id="cTipo">';
										if ( $fila->tipo == 'normal' ) {
											$data .='<label class="label label-success">Normal</label>'; 
										} else {
											$data .='<label class="label label-warning">Sobrecupo</label>';
										}
										if ( $fila->espera_examen == 1 ) {
											$data.='&nbsp;<label class="label label-danger">Pendiente por examen</label>';
										}
										if( $fila->pagado != 1) { 
										    $data .= '&nbsp;<label class="label label-warning">Pago pendiente</label>';
										} else {
											$data .= '&nbsp;<label class="label label-success">Pagado</label>';
										}
									$data .= '</p>
                            </div>
                            <div class="form-group m-r-15">
                                <label for="cPrestacion">Prestación: </label>
                                <p class="form-control-static" id="cPrestacion">'.$fila->nombre_prestacion.'</p>
                            </div>
                            <div class="form-group m-r-15">
                                <label for="cObservacion">Observaciones: </label>
                                <p class="form-control-static" id="cObservacion">';
			                        if ($fila->comentario=="---") {
										# code...
										$data .= "&nbsp;";
									} else {
										$data .= $fila->comentario;
									}

                                $data .='</p>
                            </div>
                        </form>
                        <p>&nbsp;</p>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#consultas" data-toggle="tab">Consulta</a></li>
                            <li><a href="#recetas" data-toggle="tab">Recetas</a></li>
                            <li><a href="#certificados" data-toggle="tab">Certificados</a></li>
                            <li><a href="#adjuntos" data-toggle="tab">Documentos adjuntos</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
                                <div class="card-body">
                                    <form class="form-horizontal">
                                            <div class="form-group">
                                                <label for="cAnamnesis" class="col-sm-2 control-label">Anamnesis: </label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="3" id="cAnamnesis" placeholder="Anamnesis del paciente"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cExamenFisico" class="col-sm-2 control-label">Examen físico: </label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="3" id="cExamenFisico" placeholder="Examen físico del paciente"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cDiagnostico" class="col-sm-2 control-label">Diagnóstico: </label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="3" id="cDiagnostico" placeholder="Escribir el diagnóstico del paciente"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="cDiagnostico" class="col-sm-2 control-label">Indicaciones: </label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="3" id="cIndicacionesCita" placeholder="Escribir las indicaciones del paciente"></textarea>
                                                    <a href="#" class="btn btn-success btn-sm pull-right m-t-15">
                                                        Imprimir indicaciones
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="recetas" role="tabpanel" aria-labelledby="recetas-tab">
                                <form class="form-horizontal">
                                            <div class="row">
                                                <div class="col-sm-4 m-b-15" id="med_medicamento">
                                                    <label for="cMedicamento">Medicamento: </label>
                                                    <input type="text" class="form-control" id="nombre_medicamento" name="nombre_medicamento" style="display:none" placeholder="Paracetamol">
                                                    <select class="form-control" id="cMedicamento" onchange="select_medicamentos(this.value);" data-live-search="true">
                                                        <option value="0">== Seleccionar medicamento ==</option>';
                                                        foreach ($datos['medicamentos'] as $key ) {
                                                        	$data.='<option value="'.$key->id.'">'.$key->nombre." &#47 ".$key->concentracion." ".$key->presentacion." &#47 ".$key->nombre_fisticio.'</option>';
                                                        }
                                                    $data.='</select>
                                                </div>
                                                <div class="col-sm-4 m-b-15" id="med_presentacion">
                                                    <label for="cPresentacion">Presentación: </label>
                                                    <input class="form-control" id="cPresentacion" type="text" value="" placeholder="== Seleccionar medicamento ==" disabled>
                                                </div>
                                                <div class="col-sm-2 m-b-15" id="med_concentracion" hidden>
                                                    <label for="cGenerico">Concentración: </label>
                                                    <input class="form-control" id="cConcentracion" type="text" value="" placeholder="60mg">
                                                </div>
                                                <div class="col-sm-3 m-b-15" id="med_generico">
                                                    <label for="cGenerico">Nombre genérico: </label>
                                                    <input class="form-control" id="cGenerico" type="text" value="" placeholder="== Seleccionar medicamento ==" disabled>
                                                </div>
                                                <div class="col-sm-1 m-b-15" id="med_cantidad">
                                                    <label for="cCantidad">Cantidad: </label>
                                                    <input class="form-control" id="cCantidad" type="number" value="1">
                                                </div>
                                                <div class="col-sm-11 m-b-15" id="med_indicaciones">
                                                    <label for="cIndicaciones">Indicaciones: </label>
                                                    <textarea class="form-control" rows="3" id="cIndicaciones" placeholder="Escribir las indicaciones del medicamento"></textarea>
                                                </div>
                                                <div class="col-sm-1 m-b-15">
                                                    <label>&nbsp;</label>
                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm" style="width: 100%;min-height:62.73px" onclick="agrega_medicamentos_receta()">Agregar<br>
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </div>
                                                <hr>
                                                <div class="col-sm-12 m-b-15">
                                                    <div class="row">
                                                        <div id="cont_rec_izq" class="col-sm-5">
                                                            <div id="receta_lista">
                                                            	<p id="na_medicamento" style="color:red;text-align:center;">No se han agregado medicamentos</p>
                                                            </div>
                                                        </div>
                                                        <div id="rec_izq_der" class="col-sm-2">
                                                            <div class="btn-group">
                                                            	<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width: 100%;" onclick="pasar_receta()">
			                                                        <span class="glyphicon glyphicon-chevron-right"></span>
			                                                    </a>
                                                            </div>
                                                        </div>
                                                        <div id="cont_rec_der" class="col-sm-5">
                                                            <p id="na_recetas" style="color:red;text-align:center;">No hay recetas pendientes</p>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="btn-group pull-right">
                                                                <!--a href="javascript:void(0)" class="btn btn-primary btn-sm">
                                                                    Configurar recetas
                                                                </a-->
                                                                <!--a id="recetaPrint_id" href="javascript:void(0)" class="btn btn-success btn-sm" onclick="javascript:window.imprimir_receta();">
                                                                    Imprimir recetas
                                                                </a-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-sm-12 m-b-15">
                                                    <label for="cResultados">Informe de resultados: </label>
                                                    <textarea class="form-control" rows="3" id="cResultados"></textarea>
                                                    <a href="#" class="btn btn-success btn-sm pull-right m-t-15">
                                                        Imprimir resultados
                                                    </a>
                                                </div>
                                            </div>
                                    </form>
                            </div>
                            <div class="tab-pane fade" id="certificados" role="tabpanel" aria-labelledby="certificados-tab">
                            cert
                            </div>
                            <div class="tab-pane fade" id="adjuntos" role="tabpanel" aria-labelledby="adjuntos-tab">
                                <div class="card-body">
                                	<button class="btn btn-primary btn-sm pull-right m-b-10" data-toggle="modal" data-target="#modal_add_docs"><i class="fa fa-paperclip" aria-hidden="true"></i>&nbsp; Adjuntar documento</button>
                                	<div class="clearfix">&nbsp;</div>
                                    <table id="tabla-adjuntos" class="table table-striped table-bordered table-responsive table-sm" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            	<th>Nombre</th>
                                                <th>Documento</th>
                                                <th>Fecha/Hora</th>
                                                <th>Descripción</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="div_adjuntos"></tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="btn-group pull-right">
								<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_espera_examen(\''.$fila->id.'\',\'1\',\''.$fila->id_medico.'\');">Pendiente por Examen</button>
								<button type="submit" class="btn btn-primary btn-sm float-left" onclick="pasar_terminada('.$fila->id_paciente.','.$fila->id.',\'3\','.$fila->id_medico.');">Terminar Consulta</button>
							</div>
                        </div>';		
			}
		} else {
			$data .= '<center style="color:red;"><h5>No hay pacientes en su agenda</h5></center>';
		}

        echo $data;

	}
	/*WEB SERVICES PARA ACTUALIZAR PACIENTES*/
	public function actualiza_paciente() {
        $data = array(
            'rut_otro' => $_POST['rut_otro'],
            'nombre' => $_POST['nombre'],
            'apellido_paterno' => $_POST['apellido_paterno'],
			'apellido_materno' => $_POST['apellido_materno'],
			'direccion' => $_POST['direccion'],
			'celular' => $_POST['celular'],
			'telefono' => $_POST['telefono'],
			'edad' => $_POST['edad'],
			'sexo' => $_POST['sexo'],
			'prevision' => $_POST['prevision'],
			'fecha_nacimiento' => $_POST['fecha_nacimiento'],
			'profesion' => $_POST['profesion'],
			'comuna' => $_POST['comuna'],
			'region' => $_POST['region'],
			'provincia' => $_POST['provincia'],
			'ciudad' => $_POST['ciudad'],
			'fecha_modificacion' => date("Y-m-d H:i:s")
        );		
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('pacientes', $data);

        return redirect('/agenda/', 'refresh');
    }    
    


    /*WEB SERVICES PARA DESPLEGAR LAS CITAS CANCELADAS DEL APARTADO CITAS DE HOY*/
	public function citas_terminadas_canceladas_hoy(){

	    	$this->db->select('citas.id id, 
								citas.hora hora,
								citas.comentario comentario,
								citas.observacion observacion,
								citas.id_medico id_medico,
								citas.cancelada cancelada,
								citas.tipo tipo,
								pacientes.id id_paciente,
								pacientes.nombre nombre,
								pacientes.apellido_paterno apellido_paterno,
								pacientes.apellido_materno apellido_materno,
								pacientes.rut_otro rut_otro');
	        $this->db->join('pacientes','citas.rut_paciente = pacientes.rut_otro');


	       // $this->db->or_where("cancelada",1);
	       // $queryCustom =$this->db->get_where('citas', array('fecha' => date('d-m-Y'), 'id_medico'=>$_POST['id_medico'], 'finalizada'=>1, 'cancelada'=>1));

	        $this->db->where("fecha",date('d-m-Y'));
	        $this->db->where("id_medico",$_GET['id_medico']);
	        $this->db->where("finalizada",1);
	        $this->db->or_where("cancelada",1);

	        $queryCustom=$this->db->get('citas');

	       
	
			$result = $this->db->get('usuarios');
		 	$citas_dia = array('citas_del_dia'=>$queryCustom);
	
	    	//------------------

        $data = '';
		if (!empty($citas_dia['citas_del_dia']->result())) {
			foreach ($citas_dia['citas_del_dia']->result() as $fila) {
						$data .= '<tr  class="cn_cita">
										<td>'.$fila->id.'</td>
										<td>';
											if ( $fila->tipo == 'normal' ) {
												$data .='<label class="label label-success">Normal</label>'; 
											} else {
												$data .='<label class="label label-warning">Sobrecupo</label>';
											}
										$data .= '</td>
										<td>'.$fila->hora.'</td>
										<td>';
											if ( $fila->cancelada == 0 ) {
												$data .= '<span><strong>'.$fila->comentario.'</strong></span>'; 
											} else {
												$data .= '<span style="color:red;"><strong>'.$fila->observacion.'</strong></span>';
											}
										$data .= '</td>
										<td>'.$fila->rut_otro.'</td>
										<td>'.$fila->nombre.' '.$fila->apellido_paterno.' '.$fila->apellido_materno.'</td>
										<td>';
											if ( $fila->cancelada == 1 ) {
												$data .='<span style="color:red;"><strong>Cancelada</strong></span>';
											} else {
												$data .='<span><strong>Terminada</strong></span>'; 
											}
										$data .= '</td>
									</tr>';
				
			}
		} else {
			$data .= '<tr>
						       <td colspan="7"><center>No hay citas en canceladas o terminadas para este doctor</center></td>
						    </tr>';
		}

        echo $data;

	}
	/* ------------------ METODOS PARA SALTAR DE STATUS DE UNA CITA ----- */
	public function pasar_espera() {
        $data = array(
            'espera' => 1,
            'pendiente' => 0,
            'cancelada' => 0,
            'consulta' => 0,
            'finalizada' => 0
        );		
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('citas', $data);

        return redirect('/agenda/', 'refresh');
    }
    
    public function pasar_espera_examen() {
        $data = array(
            'espera' => 1,
            'espera_examen' => 1,
            'pendiente' => 0,
            'cancelada' => 0,
            'consulta' => 0,
            'finalizada' => 0
        );		
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('citas', $data);

        return redirect('/agenda/', 'refresh');
    }
    
	public function pasar_pendiente() {
        $data = array(
            'espera' => 0,
            'pendiente' => 1,
            'cancelada' => 0,
            'consulta' => 0,
            'finalizada' => 0
        );		
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('citas', $data);

        return redirect('/agenda/', 'refresh');
    }
    
    public function pasar_consulta() {
        $data = array(
            'espera' => 0,
            //'espera_examen' => 0,
            'pendiente' => 0,
            'cancelada' => 0,
            'consulta' => 1,
            'finalizada' => 0
        );		
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('citas', $data);

        return redirect('/agenda/', 'refresh');
    }
    
    public function pasar_terminada() {
        $data = array(
            'espera' => 0,
            'pendiente' => 0,
            'cancelada' => 0,
            'consulta' => 0,
            'finalizada' => 1
        );		
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('citas', $data);

       // $this->update_citado_paciente($_POST['id_paciente']);

        return redirect('/agenda/', 'refresh');
    }
    
    public function pasar_cancelada() {
        $data = array(
            'espera' => 0,
            'pendiente' => 0,
            'cancelada' => 1,
            'consulta' => 0,
            'finalizada' => 0,
            'observacion' => $_POST['observacion']
        );


        
        $this->db->where('id', $_POST['id']);
        $this->db->update('citas', $data);

       // $this->update_citado_paciente($_POST['id_paciente']);
        
        $result = $this->db->get_where('citas', array('id' => $_POST['id']));
		$data_cita = array('datos_cita' => $result);
        $data_alerta = array(
		    'motivo_cancelacion' => $_POST['motivo_cancelacion'],
		    'id_paciente' => $data_cita['datos_cita']->result()[0]->id_paciente,
		    'id_medico' => $data_cita['datos_cita']->result()[0]->id_medico,
		    'id_cita' => $data_cita['datos_cita']->result()[0]->id,
		    'fecha_cancelada' => $data_cita['datos_cita']->result()[0]->fecha,
		    'hora_cancelada' => $data_cita['datos_cita']->result()[0]->hora
	    	);
		$this ->db->insert('alertas', $data_alerta);

        //return redirect('/agenda/', 'refresh');
    }


    /* ------------------ FIN DE METODOS PARA SALTAR DE STATUS DE UNA CITA ----- */

    public function update_citado_paciente($id_paciente=-1){
    		$datos['citado']=0;
    		$this->db->where('id', $id_paciente);
			$this->db->update('pacientes',$datos);

    }

    /*public function cancelar_cita($id = 0,$fecha) {
    		$id=$_POST['id'];
    		$fecha=$_POST['fecha'];
        	$data = array(
	        	'id' => $_POST['id'],
	        	'espera' => 0,
            'pendiente' => 0,
            'cancelada' => 1,
            'consulta' => 0,
            'finalizada' => 0,
	        'motivo_cancelacion' => $_POST['motivo_cancelacion']
        	);
        
        if (!$id) {
            $this->db->insert('citas', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('citas', $data);

            $result = $this->db->get_where('citas', array('id' => $id));
			$data_cita = array('datos_cita' => $result);

            $data_alerta = array(
	            'motivo' => $_POST['motivo_cancelacion'],
	            'id_paciente' => $data_cita['datos_cita']->result()[0]->id_paciente,
	            'fecha_cancelada' => $data_cita['datos_cita']->result()[0]->fecha,
	            'hora_cancelada' => $data_cita['datos_cita']->result()[0]->hora
        	);

            $this ->db->insert('alertas', $data_alerta);
        }
        return redirect('/agenda/', 'refresh');
    }*/


    /* ------------------ WEB SERVICES PARA GUARDAR CITAS ----- */


	public function guardar_cita($id = 0) {//aqui inserto en la tabla de pacientes el citado al hacer la cita
		$clinicas=$this->session->userdata('clinics');
		$comentario="";
		if (empty($_POST['comentario'])) {
			# code...
			$comentario="---";
		}
		else {
			# code...
			$comentario=$_POST['comentario'];
		}
		

        	$data = array(
            'rut_paciente' => $_POST['rut_paciente'],
            'id_medico' => $_POST['id_medico'],
			'fecha' => base64_decode($_POST['fecha']),
			'hora' => $_POST['hora'],

			'comentario'=>$comentario,
			'id_prestacion'=> $_POST['id_prestacion'],
			'tipo'=>"normal",
			'pendiente'=>1,
			'finalizada'=>0,
			'espera'=>0,
			'consulta'=>0,
			'id_clinica'=>$clinicas['clinicas']
        );

        	$datos=array(
        	'citado'=> 1 //paciente citado estatus = 1

        	);
        
        if (!$id) {
            $this->db->insert('citas', $data);
            $this->db->where('id',$data['id_paciente']);
            //$this->db->update('pacientes', $datos);
        } else {
            $this->db->where('id', $id);
            $this->db->update('citas', $data);
        }
        return redirect('/agenda/', 'refresh');
    }


    /* ------------------ WEB SERVICES PARA GUARDAR SOBRECUPOS ----- */

    
    public function guarda_sobrecupo($id = 0) {//aqui inserto en la tabla de pacientes el citado al hacer sobrecoupo
	    $clinicas=$this->session->userdata('clinics');

	    $comentario="";
		if (empty($_POST['comentario'])) {
			# code...
			$comentario="---";
		}
		else {
			# code...
			$comentario=$_POST['comentario'];
		}
        	$data = array(
            'rut_paciente' => $_POST['rut_paciente'],
            'id_medico' => $_POST['id_medico'],
			'fecha' => base64_decode($_POST['fecha']),
			'hora' => $_POST['hora'],
			'comentario' =>$comentario,
			'id_prestacion'=> $_POST['id_prestacion'],
			'tipo'=>"sobrecupo",
			'pendiente'=>1,
			'finalizada'=>0,
			'espera'=>0,
			'consulta'=>0,
			'id_clinica'=>$clinicas['clinicas']
        );
        
        if (!$id) {
            $this->db->insert('citas', $data);
            $datos=array(
        		'citado'=>1,
        	);
			$this->db->where('id',$data['id_paciente']);
            //$this->db->update('pacientes', $datos);
        } else {
            $this->db->where('id', $id);
            $this->db->update('citas', $data);
        }
        return redirect('/agenda/', 'refresh');
    }


    /* ------------------ WEB SERVICES PARA ENVIAR CORREO ----- */


	public function send_mail() {
		
		//Load email library
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'pfernandezp91@gmail.com';
		$config['smtp_pass']    = '***pfp-05071991***';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or text
		$config['validation'] = TRUE; // bool whether to validate email or not      
		$this->email->initialize($config);
	
	
	
        $from_email = 'clinica@emedic.cl';
        $to_email = $_POST['email'];
        
        $this->email->from($from_email, 'Clínica');
        $this->email->to($to_email);
        $this->email->subject('Notificación de cita médica');
        $this->email->message($_POST["message"]);
        //Send mail
        if (!$this->email->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Mensaje enviado";
		}
    }

    public function eliminar_pago(){
		$this->db->where('id', $_POST['id_pago']);
		$this->db->delete('depositos');
    }


    public function update_email(){
    	$datos=array();
    	$datos['id']=$_POST['id_paciente'];
    	$datos['email']=$_POST['email'];

    	$this->db->where('id',$datos['id']);
    	$this->db->update('pacientes',$datos);
    }


    //OBTIENE EL JSON DE los medicamentos por clinica
	function get_medicamentos_cita($id_clinica=-1){
			$login=$this->session->userdata('autenticado');
			$clinica=$this->session->userdata('clinics');
			$citas=$this->usuario_model->get_clinica_medicamentos(base64_decode($_GET['id_clinica']));
			echo json_encode($citas);
	}
    

}
