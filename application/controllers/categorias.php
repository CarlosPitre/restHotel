<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';


class Categorias extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('habitaciones_model');
	}

	public function categorias_get($id = null)
	{
		if ($id == null) {
			$categorias = $this->habitaciones_model->getCategorias();
		}else{
			$categorias = $this->habitaciones_model->getCategorias($id);
		};
		
		if ($categorias) {
			$this->response($categorias, REST_Controller::HTTP_OK);
		}else{
	        $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
		};
	}

	public function categorias_post()
	{
		$datos= array(
			'descripcionCategoria' =>$this->post("numero"),					
			'precio'               =>$this->post("estado"),
			'estado'               => "Activo"	
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

	public function categorias_put($id)
	{
		$datos= array(
			'descripcionCategoria' =>$this->put("numero"),					
			'precio'               =>$this->put("estado"),
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

	public function categorias_delete($id)
	{
		$datos= array(
			'estado' =>"Inactivo",
		);
		$guardar = $this->habitaciones_model->eliminar($datos,$id);
		if ($guardar) {
			$message = "Datos Guardados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

}

/* End of file categorias.php */
/* Location: ./application/controllers/categorias.php */