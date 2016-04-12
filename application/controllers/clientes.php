<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Clientes extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clientes_model');
	}

	public function clientes_get($id = null)
	{
		if ($id == null) {
			$clientes = $this->clientes_model->getCliente();			
		}else{
			$clientes = $this->clientes_model->getCliente($id);	
		};

		if ($clientes) {
			$this->response($clientes, REST_Controller::HTTP_OK);
		}else{
	        $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
		}
		

	}

	public function clientes_post()
	{
		$clientes = $this->clientes_model->getCliente($this->post("cedula"));	
		if ($clientes) {
			$message = "Not";
			$this->response($message, REST_Controller::HTTP_OK);
		};
		$datos=array(
			'cedula'    =>$this->post("cedula"),					
			'nombres'   =>$this->post("nombres"),
			'apellidos' =>$this->post("apellidos"),
			'telefono'  =>$this->post("telefono"),
			'direccion' =>$this->post("direccion"),
			'correo'    =>$this->post("correo"),
			'estado'		=> "Activo",
			'tipoDoc'    =>$this->post("tipoDoc"),	
		);

		$guardar= $this->clientes_model->guardar($datos);
		if ($guardar) {
			$message = "Datos Guardados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

	public function clientes_put($id)
	{
		$datos=array(		
			'nombres'   =>$this->put("nombres"),
			'apellidos' =>$this->put("apellidos"),
			'telefono'  =>$this->put("telefono"),
			'direccion' =>$this->put("direccion"),
			'correo'    =>$this->put("correo"),
			'tipoDoc'    =>$this->put("tipoDoc"),	
		);

		$guardar= $this->clientes_model->modificar($datos,$id);
		if ($guardar) {
			$message = "Datos Guardados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

	public function clientes_delete($id)
	{
		$datos = array(
			'estado' => "Inactivo",
		);
		$guardar= $this->clientes_model->eliminar($datos,$id);
		if ($guardar) {
			$message = "Datos Eliminados Correctamente";
			$this->response($message, REST_Controller::HTTP_CREATED);
		}else{
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		};
	}

	public function departamentos_get()
	{
		$departamentos = $this->clientes_model->getDepartamentos();
		if ($departamentos) {
			$this->response($departamentos, REST_Controller::HTTP_OK);
		}else{
	        $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
		}
	}

	public function municipios_get($idDepartamento)
	{
		$municipios = $this->clientes_model->getMunicipios($idDepartamento);
		if ($municipios) {
			$this->response($municipios, REST_Controller::HTTP_OK);
		}else{
	        $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
		}
	}


}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */