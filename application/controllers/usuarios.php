<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Usuarios extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');	
	}

	public function usuarios_get($id = null)
	{
		if ($id == null) {
			$usuarios = $this->usuarios_model->getUsuarios();
		}else{
			$usuarios = $this->usuarios_model->getUsuarios($id);
		}

		if ($usuarios) {
			$this->response($usuarios, REST_Controller::HTTP_OK);
		}else{
			 $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function usuarios_post()
	{
		$datos = array(
			'usuario'    =>$this->post("usuario"),
			'contraseña' =>sha1($this->post("pass")),
			'estado'     =>$this->post("estado"),
			'idPerfil'   =>$this->post("perfil")
		);
		$guardar= $this->usuarios_model->guardar($datos);
				
		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function usuarios_put($id)
	{
		$datos = array(
			'usuario'    =>$this->post("usuario"),
			'contraseña' =>sha1($this->post("pass")),
			'estado'     =>$this->post("estado"),
			'idPerfil'   =>$this->post("perfil")
		);
		$guardar= $this->usuarios_model->modificar($datos,$id);
				
		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function usuarios_delete($id)
	{
		$datos = array(
			'estado'     =>$this->post("estado"),
		);
		$guardar= $this->usuarios_model->eliminar($datos,$id);
				
		if ($guardar == true) {
			$message = "Datos Guardados Correctamente";
			$this->response(array("mensaje"=>$message), REST_Controller::HTTP_CREATED);
		} else {
			$message = "Error";
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	public function login_post()
	{
		$usuario = $this->post("user");
		$contraseña = sha1($this->post("pass"));
		$login = $this->usuarios_model->login($usuario,$contraseña);
		if ($login) {
			$this->response($login, REST_Controller::HTTP_OK);
		}else{
			 $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function menu_get($idPerfil)
	{
		$menu = $this->usuarios_model->getMenu($idPerfil);
		if ($menu) {
			$this->response($menu, REST_Controller::HTTP_OK);
		}else{
			 $this->response([
       			'status' => FALSE,
        		'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}	

}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */