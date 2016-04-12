<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Checkin extends REST_Controller { 

	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reservas_model');
		$this->load->model('clientes_model');
	}

	public function checkin_get($id = null)
	{
		
	}

	public function checkin_post()
	{
		$datosCheckIn=array(
			'idReserva' =>$this->post("reserva"),
			'abono' =>$this->post("abono"),
			'restante' =>$this->post("restante"),
			);
		$acompanantes = json_decode($this->post("acompanantes"));
		for ($i=0; $i < count($acompanantes); $i++) { 
			$clientes = $this->clientes_model->getCliente($this->post("cedula"));	
			if ($clientes) {

			}else{
				$datos=array(
					'cedulaCliente'    =>$acompanantes[$i]->documento,					
					'nombresCliente'   =>$acompanantes[$i]->nombres,
					'apellidosCliente' =>$acompanantes[$i]->apellidos,
					'telefonoCliente'  =>$acompanantes[$i]->direccion,
					'direccionCliente' =>$acompanantes[$i]->telefono,
					'correoCliente'    =>"null",
					'estado'		=> "Activo",
					'tipoDoc'    =>"CC",	
				);
				$guardarCliente= $this->clientes_model->guardar($datos);
			};
			
			$datosAcompananates = array(
				'idCliente' => $acompanantes[$i]->documento,
				'idReserva' => $this->post("reserva"),
			);	
			$guardarAcompanante = $this->reservas_model->guardarAcompanante($datosAcompananates);
		}

		$guardar= $this->reservas_model->guardarCheckIn($datosCheckIn);

		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

}

/* End of file checkin.php */
/* Location: ./application/controllers/checkin.php */