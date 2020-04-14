<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
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
        $this->load->model('usuario_model');
        $this->outputData['listOfUsers']    = $this->usuario_model->getUsersChat();
        @session_start();
        $this->load->library('ci_chat');
        if( !isset( $_SESSION['username'] )  || !isset( $_SESSION['user_id'] )  ){
            $_SESSION['username'] = $this->session->userdata('username');
            $_SESSION['user_id'] = $this->session->userdata('user_id');
        }
	}
	
	
	public function index() {
		$pacientes = $this->loadPacientes();

		$result = $this->db->get_where('usuarios', array('id_grupo' => 3));
	 	$data = array('consulta'=>$result);

	 	$medicosPacientes = array('doctors' => $data, 'pacients' => $pacientes);

		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('agenda/index',$medicosPacientes);
		$this->load->view('chat/chat', $this->outputData);
		$this->load->view('footer');
	}

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

	public function loadPacientes(){

		$this->db->select('pacientes.nombre,
							pacientes.apellido_paterno,
							pacientes.apellido_materno,
							pacientes.id');
        $this->db->from('pacientes');
        $queryCustom = $this->db->get();

        $data = array('pacientes' => $queryCustom);
        return $data;

	}

	public function llenar_datos_paciente(){

		$result = $this->db->get_where('pacientes', array('id' => $_POST['id_paciente']));

        $data = array('pacientes' => $result);

        echo $data['pacientes']->result()[0]->rut_otro;

	}

	public function alertas_por_paciente(){

		$result = $this->db->get_where('alertas', array('id_paciente' => $_POST['id_paciente']));

		$contador = $result->num_rows();

        $data = array('alertas' => $result);
        $tooltip = "<ul>";
        foreach ($data['alertas']->result() as $fila) 
        {
        	$tooltip .= "<li>".$fila->fecha_cancelada."-: ".$fila->motivo."</li>";
        }
        $tooltip.="</ul>";

        echo $contador."|".$tooltip;

	}

	public function modalEditarPaciente(){
		$result = $this->db->get_where('pacientes', array('id' => $_POST['id_paciente']));

        $data = array('consulta' => $result);

        $modal = '';

        foreach ($data['consulta']->result() as $fila) {

        $modal .= '<div class="modal fade" id="modalEditarPaciente" tabindex="10" role="dialog" aria-labelledby="modalEditaPacienteTitle" aria-hidden="true">
											    <div class="modal-dialog modal-lg" role="document">
												    <div class="modal-content">
												        <div class="modal-header">
													        <h5 class="modal-title" id="modalEditaPacienteTitle">Editar paciente</h5>
													        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												        </div>
												        <div class="modal-body">
												        <form action="usuario/adm_edit_paciente" method="POST">
												        <div class="form-row">
																	<div class="form-group col-md-4">
																		<label for="nombre">Nombre</label>
																		<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan" value="'.$fila->nombre.'">
																		<input type="hidden" class="form-control" id="id" name="id" placeholder="" value="'.$fila->id.'">
																	</div>
																	<div class="form-group col-md-4">
																		<label for="aPaterno">Apellido paterno</label>
																		<input type="text" class="form-control" id="aPaterno" name="apellido_paterno" placeholder="Perez" value="'.$fila->apellido_paterno.'">
																	</div>
																	<div class="form-group col-md-4">
																		<label for="aMaterno">Apellido materno</label>
																		<input type="text" class="form-control" id="aMaterno" name="apellido_materno" placeholder="Santander" value="'.$fila->apellido_materno.'">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-4">
																		<label for="rut_otro">RUT/otro</label>
																		<input type="text" class="form-control" id="rut_otro" name="rut_otro"  value="'.$fila->rut_otro.'">
																	</div>
																	<div class="form-group col-md-4">
																		<label for="direccion">Dirección</label>
																		<input type="text" class="form-control" id="direccion" name="direccion"  value="'.$fila->direccion.'">
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label for="celular">Celular</label>
																		<input type="text" class="form-control" id="celular" name="celular"  value="'.$fila->celular.'">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="telefono">Teléfono</label>
																		<input type="text" class="form-control" id="telefono" name="telefono"  value="'.$fila->telefono.'">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-4">
																		<label for="f_nacimiento">Fecha de nacimiento</label>
																		<div class="input-group date">
																		    <input type="text" class="form-control" id="f_nacimiento" name="fecha_nacimiento"  value="'.$fila->fecha_nacimiento.'">
																		</div>
																	</div>
																	<div class="form-group col-md-4">
																		<label for="sexo">Género</label>
																		<select class="form-control" id="sexoEdit'.$fila->id.'" name="sexo">
																			<option>-- SEXO --</option>
																			<option value="Masculino">Masculino</option>
																			<option value="Femenino">Femenino</option>
																	    </select>
																	    <script>
																			$(function() {
																			    var element = document.getElementById("sexoEdit'.$fila->id.'");
    																			element.value = "'.$fila->sexo.'";
																			});
																		</script>
																	</div>
																	<div class="form-group col-md-4">
																		<label for="prevision">Previsión</label>
																		<select class="form-control" id="previsionEdit'.$fila->id.'" name="prevision">
																			<option>-- PREVISIÓN --</option>
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																	    </select>
																	    <script>
																			$(function() {
																			    var element = document.getElementById("previsionEdit'.$fila->id.'");
    																			element.value = "'.$fila->prevision.'";
																			});
																		</script>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="profesion">Profesión</label>
																		<input type="text" class="form-control" id="profesion" name="profesion"placeholder="Ingeniería Civil Metalúrgica" value="'.$fila->profesion.'">
																	</div>
																	
																	<div class="form-group col-md-3">
																		<label for="region">Región</label>

																		<select class="form-control regiones" id="regionEdit'.$fila->id.'"name="prevision">
																			<option>-- Región --</option>
																			<option value="Arica y Paranoca">Arica y Parinacota</option>
																			<option value="Tarapaca">Tarapacá</option>
																			<option value="Antofagasta">Antofagasta</option>
																			<option value="Atacama">Atacama</option>
																			<option value="coquimbo">Coquimbo</option>
																		 <option value="Valparaiso">Valparaíso</option>
                    													 <option value="Región del Libertador Gral. Bernando O Higgins">Región del Libertador Gral. Bernando O´Higgins</option>
					                    								  <option value="Región de Maule">Región de Maule</option>
                                                                        <option value="Región de Bibio">Región de Biobío</option>
                                 <option value="Región de Auricania">Región de Araucania</option>
                                 <option value="Región de Auricania">Región de los Ríos</option>
                                 <option value="Región de los lagos">Región de los Lagos</option>
                                 <option value="Región de Aisén del Gral. Ibañés del Campo">Región de Aysén del Gral. Ibáñez del Campo</option>
                                  <option value="Región de Magallanes y de la Antár">Región de Magallanes y de la Antártica Chilena</option>
                                 <option value="Región Metropolitana de Santiago">Región Metropolitana de SantiagoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</option>				   


																	    </select>
						
																		
																		
																		<script>
																			$(function() {
																			    var element = document.getElementById("regionEdit'.$fila->id.'");
    																			element.value = "'.$fila->region.'";
																			});
																		</script>
																	</div>
																	<div class="form-group col-md-3">
																		<label for="comuna">Comuna</label>


																<select id="comunaEdit" class="form-control comunas" name="comuna">
																			<option>-- COMUNA --</option>
																			 <option value="La Serena">La Serena</option>
											                                 <option value="Coquimbo">Coquimbo</option>
											                                 <option value="Anda Collo">Anda Collo</option>
											                                 <option value="La Higuera">La Higuera</option>
											                                 <option value="Paiguano">Paiguano</option>
											                                 <option value="Vicuña">Vicuña</option>
											                                 <option value="Illapel">Illapel</option>
											                                 <option value="Canela">Canela</option>
											                                 <option value="Los Vilos">Los Vilos</option>
											                                 <option value="Salamanca">Salamanca</option>
											                                 <option value="Ovalle">Ovalle</option>
											                                 <option value="Combarbala"> Combarbala</option>
											                                 <option value="Monte Patria">Monte Patria</option>
											                                 <option value="Punitaqui">Punitaqui</option>
											                                 <option value="Rio Hurtado">Rio Hurtado</option>
      
																	    </select>

																	
																	</div>
																	<div class="form-group col-md-3">
																		<label for="ciudad">Ciudad</label>
																		<input type="text" class="form-control" id="ciudad" placeholder="Ciudad" value="'.$fila->ciudad.'" name="ciudad">
																	</div>
																	<div class="form-group col-md-3">
																		<label for="provincia">Provincia</label>
																		<input type="text" class="form-control" id="provincia" placeholder="Provincia" value="'.$fila->provincia.'" name="provincia">
																	</div>
																</div>
																
														</div>
														<div class="modal-footer">

														<button type="button" onclick="editarPaciente()" class="btn btn_primary">Guardar cambios</button>

															<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
															</form></div>
												    </div>
												</div>
											</div>';
		}

        echo $modal;
	}


	public function dias_laborales_medico(){
		$id_medico = $_POST['id_medico'];
		$dias_citas = $_POST['fecha'];
		
		$result = $this->db->get_where('horarios', array('id_medico' => $id_medico));

        $data = array('horarios' => $result);

        $semana_laboral = $data['horarios']->result()[0]->descanzo_semana;

        $dias = explode(",", $semana_laboral);
        $disabled='[';
        foreach ($dias as $key) {
	        	if ($key =="Do") {
	        		$disabled = $disabled.'0,';
	        	}elseif ($key =="Lu") {
	        		$disabled = $disabled.'1,';
	        	}elseif ($key =="Ma") {
	        		$disabled = $disabled.'2,';
	        	}elseif ($key =="Mi") {
	        		$disabled = $disabled.'3,';
	        	}elseif ($key =="Ju") {
	        		$disabled = $disabled.'4,';
	        	}elseif ($key =="Vi") {
	        		$disabled = $disabled.'5,';
	        	}elseif ($key =="Sa") {
	        		$disabled = $disabled.'6,';
	        	}
        }
        
        $disabled2 = substr($disabled, 0, -1);
        $disabled3 = $disabled2."]";
        $calendario = "$('#calendarioDia').datepicker('destroy');
						        $('#calendarioDia').datepicker({
								    	language: 'es',
							        todayHighlight: true,
							        daysOfWeekDisabled: ".$disabled3."
							    }).on('changeDate', function(e) {
									select_dia_horario(".$id_medico.", ".$dias_citas.");
								    e.stopImmediatePropagation();
								});";
		echo $calendario;
	}

	public function prestaciones_medico(){

		$prestaciones_medico = $this->carga_prestaciones_por_medico($_POST['id_medico']);

		$data = '';

		foreach ($prestaciones_medico['prestaciones_medico']->result() as $fila) 
			  	{
			  			$data .= '<option value="'.$fila->id.'">'.$fila->nombre.'</option>
			  			';
			  		
				}
		//print_r($prestaciones_medico['prestaciones_medico']->result());

		echo $data;
		

	}
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

	public function carga_horario_por_medico(){
		$result = $this->db->get_where('horarios', array('id_medico' => $_POST['id_medico']));

        $data = array('horarios_medico' => $result);

        if (empty($data['horarios_medico']->result())) {
        	die();
        }

        $inicio = $data['horarios_medico']->result()[0]->hora_inicio;
		$inicio_array = explode(":", $inicio);
		$fin = $data['horarios_medico']->result()[0]->hora_fin;
		$fin_array = explode(":", $fin);

		$citas_dia = $this->carga_citas_por_dia($_POST['id_medico'], $_POST['fecha']);
		$sobrecupos_dia = $this->carga_sobrecupos_por_dia($_POST['id_medico'],$_POST['fecha']);

		function echo_timelist_CALENDAR ($i, $j, $comentario,$status_id,$id_cita)
		{	
			if ((!empty($comentario)) && $status_id ==9) {
				echo '
					<tr>
									<th>'.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</th>
									<td><span class="badge badge-warning">SOBRECUPO&nbsp;&nbsp;&nbsp;<img src="//image.flaticon.com/icons/png/512/212/212433.png" height="28px;" title="Sobrecupo" alt="Sobrecupo"></span></td>
									<td>'.$comentario.'</td>
									<td class="text-center"><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalCancelar'.$id_cita.'">Cancelar</button>
										<div class="modal fade" id="modalCancelar'.$id_cita.'" tabindex="10" role="dialog">
											<div class="modal-dialog" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Cancelar sobrecupo de las: '.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body" style="color:black">
																<div class="form-group col-md-8">
																	<label for="nombre" style="color:black">Motivo de cancelación</label>
																	<input type="textarea" style="color:black" class="form-control" id="motivo_cancelacion'.$id_cita.'" name="motivo_cancelacion'.$id_cita.'" placeholder="Motivo ">
																</div>
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-primary" onclick="cancelar_cita(\''.$id_cita.'\');" data-dismiss="modal">Cancelar sobrecupo</button>
											      </div>
											    </div>
											 </div>
										</div>
									</td>
						    		</tr>';
			}else if ((!empty($comentario)) && $status_id <> 9) {
				echo '
					<tr>
								<th>'.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</th>
								<td><span class="badge badge-danger">RESERVADA</span></td>
								<td>'.$comentario.'</td>
								<td class="text-center">&nbsp;<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalCancelar'.$id_cita.'">Cancelar</button>
									<div class="modal fade" id="modalCancelar'.$id_cita.'" tabindex="10" role="dialog">
										<div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Cancelar cita de las: '.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body" style="color:black">
															<div class="form-group col-md-8">
																<label for="nombre" style="color:black">Motivo de cancelación</label>
																<input type="textarea" style="color:black" class="form-control" id="motivo_cancelacion'.$id_cita.'" name="motivo_cancelacion'.$id_cita.'" placeholder="Motivo ">
															</div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-primary" onclick="cancelar_cita(\''.$id_cita.'\');" data-dismiss="modal">Cancelar cita</button>
										      </div>
										    </div>
										 </div>
									</div>
								</td>
					</tr>';
			}else
			{

				$hora = str_pad($i, 2, '0', STR_PAD_LEFT);
				$minutos = str_pad($j, 2, '0', STR_PAD_LEFT);
				$horaFinal = str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT);
				echo '
						<tr>
						    <th>'.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</th>
						    <td><span class="badge badge-success">DISPONIBLE</span></td>
						    <td></td>
						    <td class="text-center">
						        <button type="button" class="btn btn-outline-secondary" id="agendar_cita_hora" data-toggle="modal" data-target="#modal_agendar_cita'.$i.$j.'">Agendar</button>
						        <div class="modal fade" id="modal_agendar_cita'.$i.$j.'" tabindex="-1" role="dialog">
						            <div class="modal-dialog" role="document">
						                <div class="modal-content">
						                    <div class="modal-header">
						                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agendar cita a las '.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</h5>
						                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                        <span aria-hidden="true">&times;</span>
						                        </button>
						                    </div>
						                    <div class="modal-body" style="color:black">
						                        <div class="form-group col-md-8">
						                            <label for="nombre" style="color:black">Comentario</label>
						                            <input type="textarea" style="color:black" class="form-control" id="comentario'.$hora.$minutos.'" name="comentario'.$hora.$minutos.'" placeholder="Comentario ">
						                        </div>
						                    </div>
						                    <div class="modal-footer">
						                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						                        <button type="button" class="btn btn-primary" onclick="agendar_cita(\''.$hora.'\',\''.$minutos.'\',\''.$_POST['fecha'].'\');" data-dismiss="modal">Agendar</button>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </td>
						</tr>';

			}
		}


		for ($i = $inicio_array[0]; $i <= $fin_array[0]; $i++){
		  for ($j = 0; $j <= 45; $j+=15){
		  	if (!empty($sobrecupos_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($sobrecupos_dia['citas_del_dia']->result() as $fila) 
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			if ($fila->hora === str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT)) 
				  		{	
							echo_timelist_CALENDAR($i, $j,$fila->comentario,$fila->status_id,$fila->id);
							$j+=15;
						}
			  		
				}
		  	}
		    
		  }
		}


		for ($i = $inicio_array[0]; $i <= $fin_array[0]; $i++){
		  for ($j = 0; $j <= 45; $j+=15){
		  	if (!empty($citas_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($citas_dia['citas_del_dia']->result() as $fila) 
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			if ($fila->hora === str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT)) 
				  		{	
							echo_timelist_CALENDAR($i, $j,$fila->comentario,$fila->status_id,$fila->id);
							$j+=15;
						}
			  		
				}
				echo_timelist_CALENDAR($i, $j,"",0,0);
		  	}else
		  	{
		  		echo_timelist_CALENDAR($i, $j,"",0,0);
		  	}
		    
		  }
		}


		echo_timelist_CALENDAR($fin_array[0], $fin_array[1],"","",0);


	}

	

	public function carga_citas_por_dia($id_medico,$fecha){
		if (is_numeric($fecha)) {
			$fecha = date('d-m-Y');
		}
		$result = $this->db->get_where('citas', array('fecha' => $fecha,'id_medico'=>$id_medico, 'status_id <>' => '9','cancelada' =>0));

        $data = array('citas_del_dia' => $result);

        return $data;
	}

	public function carga_sobrecupos_por_dia($id_medico,$fecha){
		if (is_numeric($fecha)) {
			$fecha = date('d-m-Y');
		}
		$result = $this->db->get_where('citas', array('fecha' => $fecha,'id_medico'=>$id_medico, 'status_id' => '9','cancelada' =>0));

        $data = array('citas_del_dia' => $result);

        return $data;
	}


	public function carga_horario_sobrecupo_por_medico(){

		$result = $this->db->get_where('horarios', array('id_medico' => $_POST['id_medico']));

        $data = array('horarios_medico' => $result);

        if (empty($data['horarios_medico']->result())) {
        	die();
        }

        $inicio = $data['horarios_medico']->result()[0]->hora_inicio;
		$inicio_array = explode(":", $inicio);
		$fin = $data['horarios_medico']->result()[0]->hora_fin;
		$fin_array = explode(":", $fin);

		function echo_timelist_sobrecupo ($i, $j, $comentario)
		{	
			
				echo '<option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'">'.str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT).'</option>
								';
		}

		for ($i = $inicio_array[0]; $i <= $fin_array[0]; $i++){
		  for ($j = 0; $j <= 45; $j+=15){
		  		echo_timelist_sobrecupo($i, $j,"");
		  }
		}
		echo_timelist_sobrecupo($fin_array[0], $fin_array[1],"");


	}

	public function guardar_cita($id = 0) {
		$clinicas=$this->session->userdata('clinics');
        	$data = array(
            'id_paciente' => $_POST['id_paciente'],
            'id_medico' => $_POST['id_medico'],
			'fecha' => $_POST['fecha'],
			'hora' => $_POST['hora'],
			'comentario' => $_POST['comentario'],
			'id_prestacion'=> $_POST['id_prestacion'],
			'tipo'=>"normal",
			'pendiente'=>1,
			'finalizada'=>0,
			'espera'=>0,
			'consulta'=>0,
			'id_clinica'=>$clinicas['clinicas']
        );
        
        if (!$id) {
            $this->db->insert('citas', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('citas', $data);
        }
        return redirect('/agenda/', 'refresh');
    }

    public function cancelar_cita($id = 0,$fecha) {
    		$id=$_POST['id'];
    		$fecha=$_POST['fecha'];
        	$data = array(
	        	'id' => $_POST['id'],
	        	'cancelada' => 1,
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
    }

    public function guarda_sobrecupo($id = 0) {
	    $clinicas=$this->session->userdata('clinics');
        	$data = array(
            'id_paciente' => $_POST['id_paciente'],
            'id_medico' => $_POST['id_medico'],
			'fecha' => $_POST['fecha'],
			'hora' => $_POST['hora'],
			'status_id' => 9,
			'comentario' => $_POST['comentario'],
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
        } else {
            $this->db->where('id', $id);
            $this->db->update('citas', $data);
        }
        return redirect('/agenda/', 'refresh');
    }


//----------------------------------------------------------------PINTAR TABLAS STATUSES----------------------------------------
    public function loadPendientesHoyByMedico(){

    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.pendiente_por_espera pendiente_por_espera,
							citas.id_medico id_medico,
							prestaciones.costo costo_prestacion,
							prestaciones.nombre nombre_prestacion,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.id_paciente = pacientes.id');
        $this->db->join('prestaciones','citas.id_prestacion = prestaciones.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_POST['id_medico'],'status_id'=>0, 'cancelada'=>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    	//------------------

    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.pendiente_por_espera pendiente_por_espera,
							citas.id_medico id_medico,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.id_paciente = pacientes.id');
        $queryCustom2 = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),'id_medico'=>$_POST['id_medico'],'status_id'=>9,'cancelada'=>0));

		$result2 = $this->db->get('usuarios');
	 	$sobrecupos_dia = array('citas_del_dia'=>$queryCustom2);

    	//------------------

        $data = '';

        if (!empty($sobrecupos_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($sobrecupos_dia['citas_del_dia']->result() as $fila) 
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			$data .= '<tr style="background-color: #fcf8e3 !important;">
			  				   <td>'.$fila->id.'</td>
	                           <td> <label class="bg-warning text-white"> Sobrecupo </label> </td>
	                           <td>'.$fila->hora.'</td>
	                           <td>'.$fila->comentario.'</td>
	                           <td>'.$fila->rut_otro.'</td>
	                           <td>'.$fila->nombre.' '.$fila->apellido_paterno.'</td>
	                           <td>
	                           		<button type="submit" class="btn btn-primary btn-sm float-left" onclick="actualizar_status(\''.$fila->id.'\',\'1\',\''.$fila->id_medico.'\');">Enviar a espera</button>
	                           		
	                           		<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modalCancelar'.$fila->id.'">X</button>
	                           		<div class="modal fade" id="modalCancelar'.$fila->id.'" tabindex="10" role="dialog">
										<div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Cancelar cita</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body" style="color:black">
															<div class="form-group col-md-8">
																<label for="nombre" style="color:black">Motivo de cancelación</label>
																<input type="textarea" style="color:black" class="form-control" id="motivo_cancelacion'.$fila->id.'" name="motivo_cancelacion'.$fila->id.'" placeholder="Motivo ">
															</div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-primary" onclick="cancelar_cita(\''.$fila->id.'\',\''.$fila->id_medico.'\');" data-dismiss="modal">Cancelar cita</button>
										      </div>
										    </div>
										 </div>
									</div>


									<a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#modalPago'.$fila->id.'">
							      $
							   </a>
<!-- Modal Pagar Consulta -->
	<div class="modal fade" id="modalPago'.$fila->id.'" tabindex="-1" role="dialog" aria-labelledby="modalPago'.$fila->id.'" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
			        <h5 class="modal-title" id="modalPagarConsultaTitle"><i class="material-icons">&#xE227;</i> Pago de consulta</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        </div>
		        <div class="modal-body">
		        	<div class="row">
						<div class="col-md-6">
							<div class="alert alert-info" role="alert">
								<strong>Ojo!</strong> Valor de Consulta Dental. 
								<input type="text" id="valorConsulta" class="form-control" placeholder="$2000" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<label for="pTotal"><strong>Total:</strong> $2000</label><br>
							<label for="pRestante"><strong>Restante:</strong> $0</label>
						</div>
					</div>
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="nCantidad">Cantidad recibida</label>
								<input type="text" class="form-control" id="nCantidad" placeholder="$18.800">
							</div>
						</div>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option selected>Efectivo</option>
									<option>Cheque</option>
									<option>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$500">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
						</div>
						<hr>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option>Efectivo</option>
									<option selected>Cheque</option>
									<option>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$1000">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
							<div class="col-md-12">
								<label for="mAbonado" class="tit_pago">Observaciones</label>
								<input type="text" class="form-control" id="mObservacion" value="Cheque Banco Central" placeholder="Observación">
							</div>
						</div>
						<hr>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option>Efectivo</option>
									<option>Cheque</option>
									<option selected>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$500">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
						</div>
						<hr>
						<button type="button" class="btn btn-info float-right" data-dismiss="modal">Añadir forma de pago</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="javascript:print()">Guardar pago</button>
				</div>
		    </div>
		</div>
	</div>
	                           </td>
	                        </tr>';
			  		
				}
		  	}


        if (!empty($citas_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($citas_dia['citas_del_dia']->result() as $fila) 
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			$data .= '<tr>
			  				   <td>'.$fila->id.'</td>
	                           <td>Normal </td>
	                           <td>'.$fila->hora.'</td>
	                           <td>'.$fila->comentario.'</td>
	                           <td>'.$fila->rut_otro.'</td>
	                           <td>'.$fila->nombre.' '.$fila->apellido_paterno.'</td>
	                           <td>
	                           		<button type="submit" class="btn btn-primary btn-sm float-left" onclick="actualizar_status(\''.$fila->id.'\',\'1\',\''.$fila->id_medico.'\');">Enviar a espera</button>
	                           		
	                           		<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modalCancelar'.$fila->id.'">X</button>
	                           		<div class="modal fade" id="modalCancelar'.$fila->id.'" tabindex="10" role="dialog">
										<div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Cancelar cita</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body" style="color:black">
															<div class="form-group col-md-8">
																<label for="nombre" style="color:black">Motivo de cancelación</label>
																<input type="textarea" style="color:black" class="form-control" id="motivo_cancelacion'.$fila->id.'" name="motivo_cancelacion'.$fila->id.'" placeholder="Motivo ">
															</div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-primary" onclick="cancelar_cita(\''.$fila->id.'\',\''.$fila->id_medico.'\');" data-dismiss="modal">Cancelar cita</button>
										      </div>
										    </div>
										 </div>
									</div>


									<a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#modalPago'.$fila->id.'">
							      $
							   </a>
<!-- Modal Pagar Consulta -->
	<div class="modal fade" id="modalPago'.$fila->id.'" tabindex="-1" role="dialog" aria-labelledby="modalPago'.$fila->id.'" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
			        <h5 class="modal-title" id="modalPagarConsultaTitle"><i class="material-icons">&#xE227;</i> Pago de consulta</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        </div>
		        <div class="modal-body">
		        	<div class="row">
						<div class="col-md-6">
							<div class="alert alert-info" role="alert">
								<strong>Ojo!</strong> Valor de '.$fila->nombre_prestacion.'. 
								<input type="text" id="valorConsulta" class="form-control" placeholder="$'.$fila->costo_prestacion.'" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<label for="pTotal"><strong>Total:</strong> $'.$fila->costo_prestacion.'</label><br>
							<label for="pRestante"><strong>Restante:</strong> $0</label>
						</div>
					</div>
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="nCantidad">Cantidad recibida</label>
								<input type="text" class="form-control" id="nCantidad" placeholder="$18.800">
							</div>
						</div>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option selected>Efectivo</option>
									<option>Cheque</option>
									<option>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$500">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
						</div>
						<hr>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option>Efectivo</option>
									<option selected>Cheque</option>
									<option>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$1000">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
							<div class="col-md-12">
								<label for="mAbonado" class="tit_pago">Observaciones</label>
								<input type="text" class="form-control" id="mObservacion" value="Cheque Banco Central" placeholder="Observación">
							</div>
						</div>
						<hr>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option>Efectivo</option>
									<option>Cheque</option>
									<option selected>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$500">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
						</div>
						<hr>
						<button type="button" class="btn btn-info float-right" data-dismiss="modal">Añadir forma de pago</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="javascript:print()">Guardar pago</button>
				</div>
		    </div>
		</div>
	</div>
	                           </td>
	                        </tr>';
			  		
				}
		  	}
		  	else{
		  		$data .= '<div>
	                           <td colspan="8"><center>No hay citas pendientes para este doctor</center></td>
	                        </div>';
		  	}

        echo $data;

	}

	public function loadEnEsperaHoyByMedico(){

    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.pendiente_por_espera pendiente_por_espera,
							citas.id_medico id_medico,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.id_paciente = pacientes.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),
        													'id_medico'=>$_POST['id_medico'],
        													'status_id'=>1,
        													'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    	//------------------

        $data = '';


        if (!empty($citas_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($citas_dia['citas_del_dia']->result() as $fila) 
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			$data .= '<tr>
			  				   <td>'.$fila->id.'</td>
	                           <td>En espera ';
	                           if ($fila->pendiente_por_espera ==1) {
	                           	$data.='<label class="badge-warning">Pendiente por espera</label>';
	                           }
	                           $data.='</td>
	                           <td>'.$fila->hora.'</td>
	                           <td>'.$fila->comentario.'</td>
	                           <td>'.$fila->rut_otro.'</td>
	                           <td>'.$fila->nombre.' '.$fila->apellido_paterno.'</td>
	                           <td>
	                           <button type="submit" class="btn btn-primary btn-sm float-left" onclick="actualizar_status(\''.$fila->id.'\',\'0\',\''.$fila->id_medico.'\');">Regresar a pendiente</button>&nbsp;&nbsp;
	                           <button type="submit" class="btn btn-primary btn-sm float-left" onclick="actualizar_status(\''.$fila->id.'\',\'2\',\''.$fila->id_medico.'\');">Enviar a consulta</button>

	                           		<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modalCancelar'.$fila->id.'">X</button>
	                           		<div class="modal fade" id="modalCancelar'.$fila->id.'" tabindex="10" role="dialog">
										<div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Cancelar cita</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body" style="color:black">
															<div class="form-group col-md-8">
																<label for="nombre" style="color:black">Motivo de cancelación</label>
																<input type="textarea" style="color:black" class="form-control" id="motivo_cancelacion'.$fila->id.'" name="motivo_cancelacion'.$fila->id.'" placeholder="Motivo ">
															</div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-primary" onclick="cancelar_cita(\''.$fila->id.'\',\''.$fila->id_medico.'\');" data-dismiss="modal">Cancelar cita</button>
										      </div>
										    </div>
										 </div>
									</div>


									<a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#modalPago'.$fila->id.'">
							      $
							   </a>
<!-- Modal Pagar Consulta -->
	<div class="modal fade" id="modalPago'.$fila->id.'" tabindex="-1" role="dialog" aria-labelledby="modalPago'.$fila->id.'" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
			        <h5 class="modal-title" id="modalPagarConsultaTitle"><i class="material-icons">&#xE227;</i> Pago de consulta</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        </div>
		        <div class="modal-body">
		        	<div class="row">
						<div class="col-md-6">
							<div class="alert alert-info" role="alert">
								<strong>Ojo!</strong> Valor de Consulta Dental. 
								<input type="text" id="valorConsulta" class="form-control" placeholder="$2000" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<label for="pTotal"><strong>Total:</strong> $2000</label><br>
							<label for="pRestante"><strong>Restante:</strong> $0</label>
						</div>
					</div>
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="nCantidad">Cantidad recibida</label>
								<input type="text" class="form-control" id="nCantidad" placeholder="$18.800">
							</div>
						</div>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option selected>Efectivo</option>
									<option>Cheque</option>
									<option>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$500">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
						</div>
						<hr>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option>Efectivo</option>
									<option selected>Cheque</option>
									<option>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$1000">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
							<div class="col-md-12">
								<label for="mAbonado" class="tit_pago">Observaciones</label>
								<input type="text" class="form-control" id="mObservacion" value="Cheque Banco Central" placeholder="Observación">
							</div>
						</div>
						<hr>
						<div class="form-group row group_pago">
							<div class="col-md-6">
								<label for="oPago" class="tit_pago">Opción de pago</label>
								<select class="form-control" id="oPago">
									<option>-- Forma de pago --</option>
									<option>Efectivo</option>
									<option>Cheque</option>
									<option selected>Bono</option>
									<option>Otro</option>
							    </select>
							</div>
							<div class="col-md-5">
								<label for="mAbonado" class="tit_pago">Monto abonado</label>
								<input type="text" class="form-control" id="mAbonado" value="$500">
							</div>
							<div class="col-md-1">
								<div class="tit_pago">&nbsp;</div>
								<button type="button" class="btn btn-link"><i class="material-icons">delete</i></button>
							</div>
						</div>
						<hr>
						<button type="button" class="btn btn-info float-right" data-dismiss="modal">Añadir forma de pago</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="javascript:print()">Guardar pago</button>
				</div>
		    </div>
		</div>
	</div>

	                           </td>
	                        </tr>';
			  		
				}
		  	}
		  	else{
		  		$data .= '<div>
	                           <td colspan="8"><center>No hay citas en espera para este doctor</center></td>
	                        </div>';
		  	}

        echo $data;

	}

	public function loadEnConsultaHoyByMedico(){

    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.id_medico id_medico,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.id_paciente = pacientes.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),
        													'id_medico'=>$_POST['id_medico'],
        													'status_id'=>2,
        													'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    	//------------------

        $data = '';


        if (!empty($citas_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($citas_dia['citas_del_dia']->result() as $fila)
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			$data .= '<tr>
			  				   <td>'.$fila->id.'</td>
	                           <td>En Consulta</td>
	                           <td>'.$fila->hora.'</td>
	                           <td>'.$fila->comentario.'</td>
	                           <td>'.$fila->rut_otro.'</td>
	                           <td>'.$fila->nombre.' '.$fila->apellido_paterno.'</td>
	                           <td>
	                           		<button type="submit" class="btn btn-primary btn-sm float-left" onclick="actualizar_status_pendiente_por_espera(\''.$fila->id.'\',\'1\',\''.$fila->id_medico.'\');">Pendiente por Examen</button>&nbsp;&nbsp;
	                           		<button type="submit" class="btn btn-primary btn-sm float-left" onclick="actualizar_status(\''.$fila->id.'\',\'3\',\''.$fila->id_medico.'\');">Terminar Consulta</button>
	                           </td>
	                        </tr>';
			  		
				}
		  	}
		  	else{
		  		$data .= '<div>
	                           <td colspan="8"><center>No hay citas en consulta para este doctor</center></td>
	                        </div>';
		  	}

        echo $data;

	}

	public function loadTerminadasCanceladasHoyByMedico(){

    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.comentario comentario,
							citas.id_medico id_medico,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.id_paciente = pacientes.id');
        $queryCustom = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),
        													'id_medico'=>$_POST['id_medico'],
        													'status_id'=>3,
        													'cancelada' =>0));

		$result = $this->db->get('usuarios');
	 	$citas_dia = array('citas_del_dia'=>$queryCustom);

    	//------------------

    	$this->db->select('citas.id id, 
							citas.hora hora,
							citas.motivo_cancelacion motivo_cancelacion,
							citas.id_medico id_medico,
							pacientes.nombre nombre,
							pacientes.apellido_paterno apellido_paterno,
							pacientes.rut_otro rut_otro');
        $this->db->join('pacientes','citas.id_paciente = pacientes.id');
        $queryCustom2 = $this->db->get_where('citas', array('fecha' => date('d-m-Y'),
        													'id_medico'=>$_POST['id_medico'],
        													'cancelada' =>1));
		
	 	$canceladas_dia = array('citas_canceladas'=>$queryCustom2);

    	//------------------

        $data = '';


        if (!empty($citas_dia['citas_del_dia']->result())) {
		  		
		  		foreach ($citas_dia['citas_del_dia']->result() as $fila)
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			$data .= '<tr>
			  				   <td>'.$fila->id.'</td>
	                           <td><label class="bg-success text-white">Terminada</label></td>
	                           <td>'.$fila->hora.'</td>
	                           <td>'.$fila->comentario.'</td>
	                           <td>'.$fila->rut_otro.'</td>
	                           <td>'.$fila->nombre.' '.$fila->apellido_paterno.'</td>
	                           <td></td>
	                        </tr>';
			  		
				}

				
		  	}
		  	if (!empty($canceladas_dia['citas_canceladas']->result())) {
		  		foreach ($canceladas_dia['citas_canceladas']->result() as $fila)
			  	{
				//echo '<script>console.log("'.$fila->hora.'");</script>';
			  			$data .= '<tr class="warning">
			  				   <td>'.$fila->id.'</td>
	                           <td><label class="bg-danger text-white">CANCELADA</label></td>
	                           <td>'.$fila->hora.'</td>
	                           <td>'.$fila->motivo_cancelacion.'</td>
	                           <td>'.$fila->rut_otro.'</td>
	                           <td>'.$fila->nombre.' '.$fila->apellido_paterno.'</td>
	                           <td></td>
	                        </tr>';
			  		
				}
		  	}
		  	else{
		  		$data .= '<div>
	                           <td colspan="8"><center>No hay citas en canceladas o terminadas para este doctor</center></td>
	                        </div>';
		  	}

        echo $data;

	}

	public function actualizarCitaStatus() {
		if ($_POST['status_id']) {
			# code...
		}
        $data = array(
            'status_id' => $_POST['status_id']
        );
            $this->db->where('id', $_POST['id']);
            $this->db->update('citas', $data);

        return redirect('/agenda/', 'refresh');
    }

    public function actualizarCitaStatusPendientePorEspera() {
		if ($_POST['status_id']) {
			# code...
		}
        $data = array(
            'status_id' => $_POST['status_id'],
            'pendiente_por_espera' => '1'
        );
            $this->db->where('id', $_POST['id']);
            $this->db->update('citas', $data);

        return redirect('/agenda/', 'refresh');
    }

}
