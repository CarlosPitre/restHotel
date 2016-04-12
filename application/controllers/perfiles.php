<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Perfiles extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('perfiles_model');	
	}

	public function perfiles_get($id = null ) 
	{
		if ($id == null) {
			$perfiles = $this->perfiles_model->getPerfiles();
		}else{
			$perfiles = $this->perfiles_model->getPerfiles($id);
		}

		if ($perfiles) {
			$this->response($perfiles, REST_Controller::HTTP_OK);
		}else{
			 $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
		}

	}

	public function perfiles_post()
	{
		$datos = array(
			"nombre" => $this->post("nombre"),
			"estado" => "Activo",
		);
		$guardar = $this->perfiles_model->guardar($datos);

		if ($guardar != null) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message,"id"=>$guardar), REST_Controller::HTTP_CREATED);

		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function perfiles_put($id)
	{
		$datos = array(
			"nombre" => $this->post("nombre"),
		);
		$guardar = $this->perfiles_model->modificar($datos,$id);

		if ($guardar) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);

		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function perfiles_delete($id)
	{
		$datos = array(
			"estado" => "Inactivo"
		);
		$eliminar = $this->perfiles_model->eliminar($datos,$id);
		if ($eliminar) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);

		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

}

/* End of file perfiles.php */
/* Location: ./application/controllers/perfiles.php */