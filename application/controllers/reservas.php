<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Reservas extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reservas_model');
	}

	public function reservas_get($id = null)
	{
		
	}
	public function reservas_post()
	{
		$datos=array( 
			'idCliente'    =>$this->post("cedula"),	
			'fechaEntrada' =>$this->post("fechaEntrada"),
			'fechaSalida'  =>$this->post("fechaSalida"),
			'estado'       =>"Espera",
			'valorPago'    =>$this->post("valorPago")
		);
		$habitaciones = json_decode($this->post("habitaciones"));
		$reserva= $this->reservas_model->guardar($datos);
		for ($i=0; $i < count($habitaciones); $i++) { 
			$datos = array(
				"idHabitacion" => $habitaciones[$i]->idHabitacion,
				"idReserva" => $reserva
			);
			$guardar= $this->reservas_model->guardarHabitaciones($datos);
		}
		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}

	}

	public function reservas_put($id)
	{
		$datos=array(
			'idCliente'    =>$this->post("cedula"),	
			'fechaEntrada' =>$this->post("fechaEntrada"),
			'fechaSalida'  =>$this->post("fechaSalida"),
			'estado'       =>"Espera",
			'valorPago'    =>$this->post("valorPago")
		);
		$guardar= $this->reservas_model->modificar($datos,$id);
				
		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function reservas_delete($id)
	{
		$datos=array(
			'estado'       =>"Cancelada",
		);
		$guardar= $this->reservas_model->eliminar($datos,$id);
				
		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function getReservasClientes_get($cedula)
	{
		$reservas = $this->reservas_model->getReservasClientes($cedula);
		if ($reservas != null) {
			$this->response($reservas, REST_Controller::HTTP_OK);
		}else{
			$this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function getHabitacionesReservas_get($id)
	{
		$habitaciones = $this->reservas_model->getReservasHabitaciones($id);
		if ($habitaciones != null) {
			$this->response($habitaciones, REST_Controller::HTTP_OK);
		}else{
			$this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}


}

/* End of file reservas.php */
/* Location: ./application/controllers/reservas.php */