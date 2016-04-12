<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Habitaciones extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('habitaciones_model');
	}

	public function habitaciones_get($id = null)
	{
		if ($id == null) {
			$habitaciones = $this->habitaciones_model->getHabitaciones();
		}else{
			$habitaciones = $this->habitaciones_model->getHabitaciones($id);
		};
		 
		if ($habitaciones) {
			$this->response($habitaciones, REST_Controller::HTTP_OK);
		}else{
	        $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
		};
	}

	public function habitaciones_post()
	{
		$datos= array(
			'numeroHabitacion' =>$this->post("numero"),					
			'estadoHabitacion' =>$this->post("estado"),
			'idCategoria'      =>$this->post("categoria"),
			'camas'            =>$this->post("camas"),
			'piso'             =>$this->post("piso"),
			'precio'           =>$this->post("precio"),
			'estado'           =>"Activo"
		);
		$guardar = $this->habitaciones_model->guardar($datos);
		if ($guardar) {
			$message = "Datos Guardados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

	public function habitaciones_put($id)
	{
		$datos= array(
			'numeroHabitacion' =>$this->put("numero"),					
			'estadoHabitacion' =>$this->put("estado"),
			'idCategoria'      =>$this->put("categoria"),
			'camas'            =>$this->put("camas"),
			'piso'             =>$this->put("piso"),
			'precioDia'        =>$this->put("precio")	
		);
		$guardar = $this->habitaciones_model->modificar($datos,$id);
		if ($guardar) {
			$message = "Datos Guardados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

	public function habitaciones_delete($id)
	{
		$datos= array(
			'numeroHabitacion' =>"Inactivo",
		);
		$guardar = $this->habitaciones_model->eliminar($datos,$id);
		if ($guardar) {
			$message = "Datos Eliminados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

}

/* End of file habitaciones.php */
/* Location: ./application/controllers/habitaciones.php */